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

        $isData = ISOnline::whereMonth("lastupdate",$month)->whereYear("lastupdate",$year)->get();
        foreach ($isData as $row){
            self::checkISData($row);
        }
    }

    public static  function checkISData(ISOnline $row){

       if (self::checkFrontNameWithSex($row)){
           echo $row->id . " ". $row->prename. " ". $row->sex. " : error  checkFrontNameWithSex <br>";
       }
        if (self::checkDriverAge($row)){
            echo $row->id . " : error  checkDriverAge <br>";
        }

    }

    public static function checkFrontNameWithSex(ISOnline $row){

        $maleFrontName = ['นาย','ด.ช.' , 'Mr.' , 'พระ'];
        $male_sex = 1;

        $femaleFrontName = ['นาง','น.ส.','ด.ญ.' ,'นส.' , 'ดญ.' ,'พันตรีหญิง'];
        $female_sex = 2;

        $prename = $row->prename;
        $sex = $row->sex;

        if($sex == $female_sex){
            if (!in_array($prename,$femaleFrontName)){
                return true;
            }else{
                return false;
            }

        }else{
            if (!in_array($prename,$maleFrontName)){
                return true;
            }else{
                return false;
            }
        }

    }

    public static function checkDriverAge(ISOnline $row){

        return false;
    }
}
