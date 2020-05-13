<?php

namespace App\Http\Controllers;

use App\Models\IS\ISOnline;
use Illuminate\Http\Request;

class ISController extends Controller
{

    public function index(){
        return view("page.home");
    }

    public function testConnection(Request $request){

        $isData = ISOnline::limit("10")->get();
        dd($isData);
    }

    public function checkData(Request $request, $month, $year){
        self::runCheckData($month,$year);
    }

    public static  function runCheckData($month ,$year, $hospCode = ""){
        set_time_limit(1000);


        $preNames = [];
        $isData = ISOnline::whereMonth("lastupdate",$month)->whereYear("lastupdate",$year)->limit(10000)->get();
        foreach ($isData as $row){
            self::checkISData($row);

            $key_name = $row->prename . "_". $row->sex;

            if( array_key_exists($key_name,$preNames) ){
                $preNames[$key_name] ++;
            }else{
                $preNames[$key_name] = 1;
            }
        }

        foreach ($preNames as $key => $count) {
            echo  $key. " : " . $count . "<br>";
        }
    }


    public static  function checkISData(ISOnline $row){


        // ตรวจสอบ คำนำหน้าไม่ตรงกับเพศ
        if (self::checkFrontNameWithSex($row)){
            echo $row->id . " ". $row->prename. " ". $row->sex. " : error  checkFrontNameWithSex <br>";
        }

        //  ตรวจสอบ คำหน้าหน้า อาชีพเป็น หทาย ตำรวจ แต่ อาชีพไม่ใช้หทาย ตำรวจ
        if (self::checkSoldierPolishFrontNameWithJob($row)){
            echo $row->id . " ". $row->prename. " ". $row->sex. " : error คำหน้าหน้า อาชีพเป็น หทาย ตำรวจ แต่ อาชีพไม่ใช้หทาย ตำรวจ <br>";
        }

        //   ตรวจสอบ คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส11
        if (self::checkMonkFrontNameWithJob($row)){
            echo $row->id . " ". $row->prename. " ". $row->sex. " : error  คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส 11 <br>";
        }

    }


    // ตรวจสอบ คำนำหน้าไม่ตรงกับเพศ
    public static function checkFrontNameWithSex(ISOnline $row){

        $maleFrontName = ['นาย','ด.ช.' , 'Mr' , 'พระ'];
        $male_sex = 1;

        $femaleFrontName = [ 'Ms','rs','นาง','น.ส.','ด.ญ.' ,'นส.' , 'ดญ.' ,'หญิง', "แม่"];
        $female_sex = 2;

        $prename = $row->prename;
        $sex = $row->sex;

        if(self::isContainArray($prename,$femaleFrontName)){
            if ($sex != $female_sex){
                //  คำหน้าหน้าหญิง แต่ เพศไม่หญิง
                return true;
            }else{
                return false;
            }

        }else if (self::isContainArray($prename,$maleFrontName))
        {
            if ($sex != $male_sex){
                //  คำนำหน้าชาย แต่ เพศไม่ชาย
                return true;
            }else{
                return false;
            }
        }

        return false;
    }


    // ตรวจสอบ คำหน้าหน้า อาชีพเป็น หทาย ตำรวจ แต่ อาชีพไม่ใช้หทาย ตำรวจ
    public static function checkSoldierPolishFrontNameWithJob(ISOnline $row){

        $check_prename = ['พล','ส.อ.' , 'ร.ท.' , 'เรือ' , 'ตำรวจ', "สิบ","ร้อย" , "พัน"];
        $check_occu = 2;

        $prename = $row->prename;
        $OCCU = (int) $row->OCCU;

        foreach ($check_prename as $checkPrename){
            if (strpos($checkPrename, $prename) !== false) {
                if($OCCU != $check_occu){
                    // คำหน้าหน้า อาชีพเป็น หทาย แต่ อาชีพไม่ใช้ทหาร
                    return true;
                }
            }
        }

        return false;

    }


    // ตรวจสอบ คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส11
    public static function checkMonkFrontNameWithJob(ISOnline $row){

        $check_prename = ['พ.ภ.','พระ' , 'ชี' , 'เณร'];
        $check_occu = 11;

        $prename = $row->prename;
        $OCCU = (int) $row->OCCU;

        foreach ($check_prename as $checkPrename){
            if (strpos($checkPrename, $prename) !== false) {
                if($OCCU != $check_occu){
                    // คำหน้าหน้า อาชีพเป็น หทาย แต่ อาชีพไม่ใช้ทหาร
                    return true;
                }
            }
        }

        return false;

    }



    public static function checkDriverAge(ISOnline $row){

        return false;
    }


    public static function isContainArray($check, $arrayWord){

        foreach ($arrayWord as $word){
            if (strpos(strtolower($word) , strtolower($check) ) !== false) {
                return true;
            }
        }
        return false;
    }

}
