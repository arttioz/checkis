<?php

namespace App\Http\Controllers;

use App\Models\IS\ISOnline;
use App\Models\IS\Lib_hospcode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ISController extends Controller
{
    public static $ERROR_PRENAME_SEX = 1;
    public static $ERROR_PRENAME_POLIS_TAHAN = 2;
    public static $ERROR_PRENAME_MONK = 3;
    public static $ERROR_DEK_OCCU = 4;



    public function index(){
        $chk_is = ISOnline::limit(1)->get();

        return view("page.home",compact('chk_is'));
    }


    public function contact(){
        return view("page.contact");
    }

    public function overview(){
        return view("page.overview");
    }

    public function tracking(){


        $hospUseIS = [10660,10661,10662,10663];
        // รายชื่อโรงพยาบาล

        $hospData = ISOnline::
        orderBy('hosp_last_update', 'desc')
            ->groupBy('hosp','inp_src')
            ->where('inp_src','ISWIN_V3')
            ->whereYear('lastupdate',2020)
            ->get(['hosp','inp_src', ISOnline::raw('MAX(lastupdate) as hosp_last_update')]);


        $hospsData = $this->getHospNameArr();
        $now = Carbon::now();
        foreach ($hospData as $row){
            $row->hospname = $hospsData[$row->hosp]->name;
            $row->changwat = $hospsData[$row->hosp]->changwat;
            $dateReport = Carbon::parse($row->hosp_last_update);
            $row->dif =  $dateReport->diffInDays($now);
        }


//
//        dd($hospData);
        return view("page.tracking",compact('hospData'));
    }

    public function getHospNameArr(){
        $hosps = Lib_hospcode::get();
        $hospsData = [];
        foreach ($hosps as $row){
            $hospsData[$row->off_id] = $row;

        }
        return $hospsData;
    }

    public function tracking_detail($hospcode,$year){
// GET  HOSP DETAIL
        $hospData = Lib_hospcode::where('off_id', '=', $hospcode)->first();

        //ดึงข้อมูล IS count รายเดือน  ISOnline::raw("COUNT(id) as count_id")
        $isData = ISOnline::select("id", "adate" )
        ->where('hosp', '=', $hospcode)->whereYear("lastupdate",$year)->get();

//dd( $isData);

        return view("page.tracking_detail",compact('hospData','isData','year'));

    }


    public function check_error(){


        $level = ["A","S","M1"];
        $hospData = Lib_hospcode::whereIn('level_performance', $level)->get();

        return view("page.check_error",compact('hospData'));
    }


    public function check_error_process(Request $request) {

        set_time_limit(0);


        $mm = $request->input('mm');
        $yy = $request->input('yy');
        $hosp_id =  $request->input('hosp');

        $month = $mm;
        $year = $yy  ;
        $hospCode = $hosp_id ;




        $hosp_name = Lib_hospcode::where('off_id', '=', $hosp_id)->first();
        $hospData = Lib_hospcode::where('off_id', 'like', '1%')->get();

    /// ดึงข้อมูล
        if($hosp_id=='ALL') {
            // query IS ALL HOSP
            $isData = ISOnline::whereMonth("hdate",$mm)->whereYear("hdate",$yy)->get();
        }else {

            if($request->input('mm')=='ALL')
            {  // query IS
                $isData = ISOnline::where('hosp', '=', $hosp_id)->whereYear("hdate",$yy)->get();
            } else {
                // query IS
                $isData = ISOnline::where('hosp', '=', $hosp_id)->whereMonth("hdate",$mm)->whereYear("hdate",$yy)->get();
            }


        }

        $ISCount = $isData->count();


        // ขั้นตอนการตรวจเช็ค 27 ขั้นตอน  (SQL by Access กองระบาด)

        //    //01-บันทึก เวลาที่เกิดเหตุ (Atime) และ เวลาที่มาถึง รพ. (Htime) ทุกราย
        $is_List1 = [];
        foreach ($isData as $row) {
                if ( ($row->htime=='') || ($row->atime==''))
                { $is_List1[] = $row ; }
        }
        $countList1 = count($is_List1);



        //02-อุบัติเหตุขนส่ง  การบาดเจ็บ (Injby) ต้องไม่มีรหัส  2 - ทำร้ายตนเอง  3 – ผู้อื่นทำร้าย
        $is_List2 = [];
        foreach ($isData as $row) {
            if ((($row->cause)=="1") && (($row->injby)=="2" || ($row->injby)=="3"))
            { $is_List2[] = $row ; }
        }


        //03-เด็กอายุ < 5 ปี ไม่ควรทำร้ายตนเอง (Injby = 2)
        $is_List3 = [];
        foreach ($isData as $row) {
            if ((($row->age)<5) && (($row->injby)=="2"))
            { $is_List3[] = $row ; }
        }


        // 04-* บันทึกพฤติกรรมเสี่ยงโทรศัพท์มือถือ (risk 5)ทุกราย
        $is_List4 = [];
        foreach ($isData as $row) {
            if ((($row->risk5)==null))
            { $is_List4[] = $row ; }
        }


        //05-* บันทึก icdcause ทุกรายยกเว้น อุบัติเหตุขนส่งที่ไม่ต้องบันทึกเพราะใช้ช่อง(cause =1)แทน
        $is_List5 = [];
        foreach ($isData as $row) {
            if ((($row->cause)<>"1") && (($row->icdcause)==null))
            { $is_List5[] = $row ; }
        }



        //06-* บันทึกการมาจากที่เกิดเหตุทุกราย( atohosp)โดยถ้าเป็นการมาด้วย หน่วยบริการการแพทย์ฉุกเฉิน (ems)ให้ระบุระดับ als,bls,หรือfr
        $is_List6 = [];
        foreach ($isData as $row) {
            if ((($row->atohosp)=="3" || ($row->atohosp)==null) && (($row->htohosp) == null))
            { $is_List6[] = $row ; }
        }



        //07-เด็กอายุต่ำกว่า 5 ปี ไม่ควรดื่มแอลกอฮอล์ ( risk1<>0)
        $is_List7 = [];
        foreach ($isData as $row) {
            if ((($row->age)<5) && (($row->risk1)!="0"))
            { $is_List7[] = $row ; }
        }



        //08-ไม่ควรมีบาดเจ็บในอาชีพจากการทำร้ายตนเอง  (injby = 2)
        $is_List8 = [];
        foreach ($isData as $row) {
            if  ((($row->injoccu)=="1") && (($row->injby)=="2"))
            { $is_List8[] = $row ; }
        }


        //09-* dba ไม่ควรมาโรงพยาบาลโดยไม่มีผู้นำส่ง ( atohosp =0 )
        $is_List9 = [];
        foreach ($isData as $row) {
            if ((($row->pmi)=="1") && (($row->atohosp)=="0"))
            { $is_List9[] = $row ; }
        }

        //10-อุบัติเหตุตกน้ำ จมน้ำ(icdcause=w65-w74) จุดเกิดเหตุไม่ควรเป็นถนน ( apoint = 5)
        $is_List10 = [];
        foreach ($isData as $row) {
            if ((substr($row->icdcause,0,1) =="W") && (substr($row->icdcause,1,2) >="65") && (substr($row->icdcause,1,2) <="74")  && ($row->apoint =="5")  )
            { $is_List10[] = $row ; }
        }


        //11-บาดเจ็บจากอุบัติเหตุ (injby = 1) แต่สาเหตุเป็นเจตนา icdcause = x60-y09
        $is_List11 = [];
        foreach ($isData as $row) {
            if ( ((substr($row->icdcause,0,1) =="X") && (substr($row->icdcause,1,2) >="60") && (substr($row->icdcause,1,2) <="99")  && ($row->injby =="1")  ) || ((substr($row->icdcause,0,1) =="Y") && (substr($row->icdcause,1,2) >="00") && (substr($row->icdcause,1,2) <="09")  && ($row->injby =="1")  )  )
            { $is_List11[] = $row ; }
        }



//12-บาดเจ็บจากการทำร้ายตนเอง (injby = 2) แต่สาเหตุไม่ทำร้ายตนเองด้วยวิธีต่าง ๆ  ( icd cause<> x60-x84)
        // ((($row->injby)="2") and (($row->icdcause)<"x60" or ($row->icdcause)>"x84"))
        $is_List12 = [];
        foreach ($isData as $row) {
            if  ((substr($row->icdcause,0,1) =="X") && ( (substr($row->icdcause,1,2) <"60") || (substr($row->icdcause,1,2) >"84") ) && ($row->injby =="2")  )
            { $is_List12[] = $row ; }
        }



        //13-บาดเจ็บจากผู้อื่นทำร้าย (injby =3) แต่สาเหตุไม่ถูกทำร้ายด้วยวิธีต่าง ๆ (icdcause =x85-y09)
        $is_List13 = [];
        foreach ($isData as $row) {
            if ( ((substr($row->icdcause,0,1) =="X") && (substr($row->icdcause,1,2) >="85") && (substr($row->icdcause,1,2) <="99")  && ($row->injby =="3")  ) || ((substr($row->icdcause,0,1) =="Y") && (substr($row->icdcause,1,2) >="00") && (substr($row->icdcause,1,2) <="09")  && ($row->injby =="3")  )  )
            { $is_List13[] = $row ; }
        }

        //14-* ถ้าบาดเจ็บจากอาชีพ (injoccu)ต้องมีการบันทึกอาชีพ (occu) ทุกราย
        $is_List14 = [];
        foreach ($isData as $row) {
            if ((($row->injoccu)=="1") && (($row->occu)==null))
            { $is_List14[] = $row ; }
        }

        //15-ผู้บาดเจ็บ ที่มี  br = 6  ais = 1 ไม่สมควรตาย หากตายควรมีเหตุผลแนบ จำหน่ายผู้ป่วยออกจาก er (staer=1 – เสียชีวิตก่อนถึง รพ., 6-ถึงแก่กรรม) จำหน่ายผู้ป่วยจากward (staward=5 ถึงแก่กรรม) (ใช้กับ is ของ รพท/รพศ)
        $is_List15 = [];
        foreach ($isData as $row) {
            if(((($row->bp1)==6) && (($row->ais1)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->bp2)==6) && (($row->ais2)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->br3)==6) && (($row->ais3)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->br4)==6) && (($row->ais4)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->br5)==6) && (($row->ais5)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->br6)==6) && (($row->ais6)==1) && (($row->staer)=="1" || ($row->staer)=="6")) || ((($row->bp1)==6) || (($row->ais1)==1) && (($row->staward)=="5")) || ((($row->bp2)==6) && (($row->ais2)==1) && (($row->staward)=="5")) || ((($row->br3)==6) && (($row->ais3)==1) && (($row->staward)=="5")) || ((($row->br4)==6) && (($row->ais4)==1) && (($row->staward)=="5")) || ((($row->br5)==6) && (($row->ais5)==1) && (($row->staward)=="5")) || ((($row->br6)==6) && (($row->ais6)==1) && (($row->staward)=="5")))
            { $is_List15[] = $row ; }
        }


        //16-* ต้องมีข้อมูลเพศทุกคน (sex= 1 ชาย  2- หญิง)
        $is_List16 = [];
        foreach ($isData as $row) {
            if ((($row->sex)==null))
            { $is_List16[] = $row ; }
        }


        //17-bp, rr, p ไม่ควรเกินกว่ากำหนด (bp1 ไม่เกิน 300 bp2 ไม่เกิน 300 pr ไม่เกิน 200 rr ไม่เกิน 60 )(ใช้กับ is ของ   รพท/รพศ)
        $is_List17 = [];

        //18-จำหน่ายผู้ป่วยออกแล้ว (staward) แต่ไม่มีวันที่จำหน่าย (rdate)
        $is_List18 = [];
        foreach ($isData as $row) {
            if ((($row->staward)!=null) && (($row->rdate)==null))
            { $is_List18[] = $row ; }
        }

        // 19-* ต้องมีข้อมูลอายุเป็น ปี (age) หรือเดือน (month) หรือวัน (year) ทุกคน
        $is_List19 = [];
        foreach ($isData as $row) {
            if ((($row->day) == null || ($row->day)==0) && (($row->age) == null || ($row->age)==0) && (($row->month) == null || ($row->month)==0))
            { $is_List19[] = $row ; }
        }

        // 20-ถ้าผู้ป่วยมีการ admit ทุกรายต้องแสดงสถานภาพการจำหน่ายจาก  ward ( หาก staer=7 <รับไว้รักษา> การ staward ต้องมีสถานภาพการจำหน่ายอย่างใดอย่างหนึ่ง)
        $is_List20 = [];
        foreach ($isData as $row) {
            if ((($row->staer)=="7") && (($row->staward) == null))
            { $is_List20[] = $row ; }
        }







        $is_List21 = [];
        $is_List22 = [];
        $is_List23 = [];
        $is_List24 = [];
        $is_List25 = [];
        $is_List26 = [];
        $is_List27 = [];










        // ขั้นตอนการตรวจเช็ค 13 ขั้นตอน  (by Ann)
        $errorList = self::runCheckData($month,$year,$hospCode);
        try {
            $isProcess1 = $errorList[self::$ERROR_PRENAME_SEX];
        }catch (\Exception $e){
            $isProcess1 = [];
        }





        //$isProcess1 =   self::runCheckData($month,$year,$hospCode);
        //P2.1 อายุห้ามว่าง ยกเว้นเคส DBA
        $isProcess2_1 = ISOnline::where('hosp', '=', $hosp_id)
            ->where(function ($isProcess2_1) {
                $isProcess2_1->whereNull('age')
                    ->orWhere('age', '<', 0);
            })
            ->where('staer', '<>', '1')
            ->whereMonth("lastupdate",$mm)
            ->whereYear("lastupdate",$yy)
            ->limit(999)->get();



        //P2.2  อำยุ ต่ ำกว่ำ 5 ปี ขับขี่รถที่ไม่ใช่รถจักรยำน
        $isProcess2_2 = ISOnline::where('hosp', '=', $hosp_id)
            ->where('age', '<=', 5)
            ->where('injp', '=', '2')
            ->where('injt', '<>', '01')
            ->whereMonth("lastupdate",$mm)
            ->whereYear("lastupdate",$yy)
            ->limit(999)->get();
        //P3.1 ถ้ามียศ แต่ รหัสอาชีพไม่ใช้ 02 ถือว่าไม่ถูกต้อง
        $words = ['พล','ส.อ.' , 'ร.ท.' , 'เรือ' , 'ตำรวจ', "สิบ","ร้อย" , "พัน"];

        try {
            $isProcess3_1 = $errorList[self::$ERROR_PRENAME_POLIS_TAHAN];
        }catch (\Exception $e){
            $isProcess3_1 = [];
        }


        //P3.2 ถ้าเป็นพระ แต่ รหัสอาชีพไม่ใช้ 09 ถือว่าไม่ถูกต้อง
        try {
            $isProcess3_2 = $errorList[self::$ERROR_PRENAME_MONK];
        }catch (\Exception $e){
            $isProcess3_2 = [];
        }



//P3.3 เด็กอายุต่ำว่า 3 ปี occu  ต้องเป็น 17 เท่านั้น\
        try {
            $isProcess3_3 = $errorList[self::$ERROR_DEK_OCCU];

        }catch (\Exception $e){
            $isProcess3_3 = [];
        }

//        $isProcess3_3 = ISOnline::where('hosp', '=', $hosp_id)
//            ->where('age', '<=', 3)
//            ->where('occu', '<>', '17')
//            ->whereMonth("lastupdate",$mm)
//            ->whereYear("lastupdate",$yy)
//            ->limit(999)->get();

        //P4. ตัวแปรอาชีพ (OCCU) ต้องไม่มีค่ำว่ำง
        $isProcess4 = ISOnline::where('hosp', '=', $hosp_id)
            ->whereNull('occu')
            ->whereMonth("lastupdate",$mm)
            ->whereYear("lastupdate",$yy)
            ->limit(999)->get();






        return view("page.check_error",compact('hospData','hosp_name','hosp_id','mm','yy','isData','ISCount','isProcess1','isProcess2_1','isProcess2_2','isProcess3_1','isProcess3_2','isProcess3_3','isProcess4','is_List1','countList1','is_List2','is_List3','is_List4','is_List5','is_List6','is_List7','is_List8','is_List9','is_List10','is_List11','is_List12','is_List13','is_List14','is_List15','is_List16','is_List17','is_List18','is_List19','is_List20','is_List21','is_List22','is_List23','is_List24','is_List25','is_List26','is_List27'));
    }




    public function check_duplicate(){
        // query Hosp
        $level = ["A","S","M1"];
        $hospData = Lib_hospcode::whereIn('level_performance', $level)->get();

        return view("page.check_duplicate",compact('hospData'));
    }

    public function check_duplicate_process(Request $request) {
        $mm = $request->input('mm');
        $yy = $request->input('yy');
        $hosp_id =  $request->input('hosp');
        $hosp_name = Lib_hospcode::where('off_id', '=', $hosp_id)->first();



        if($hosp_id=='ALL')
        {
            // เช็คซ้ำ
            $isData = ISOnline::select('pid', 'hn', 'hosp','name'  )
                ->whereMonth("lastupdate",$mm)
                ->whereYear("lastupdate",$yy)
                ->groupBy('pid', 'hn','hosp','name' )
                ->havingRaw('COUNT(*) > 1')
                ->get();
        }
        else
        {
            // เช็คซ้ำ
            $isData = ISOnline::select('pid', 'hn', 'hosp','name'  )
                ->where('hosp', '=', $hosp_id)
                ->whereMonth("lastupdate",$mm)
                ->whereYear("lastupdate",$yy)
                ->groupBy('pid', 'hn','hosp','name' )
                ->havingRaw('COUNT(*) > 1')
                ->get();
        }


        $hospData = Lib_hospcode::where('off_id', 'like', '1%')->get();
        return view("page.check_duplicate",compact('hospData','hosp_name','hosp_id','mm','yy','isData'));
    }



    public function testConnection(Request $request){

        // $isData = ISOnline::limit("100")->get();
        //  dd($isData);

        $isData = ISOnline::limit("100")->get();

        foreach ($isData as $row) {
            echo $row->name;
            echo '<br>';
        }
    }

    public function checkData(Request $request, $month, $year){
        self::runCheckData($month,$year);
    }

    public static  function runCheckData($month ,$year , $hospcode = null ){
        set_time_limit(1000);

        $errorList = [];
        $isData = ISOnline::whereMonth("lastupdate", "=",$month)->whereYear("lastupdate", "=",$year);
        if ($hospcode){
            $isData->where('hosp', '=', $hospcode);
        }
        $isData = $isData->get();

        foreach ($isData as $row){

            $errorList = self::checkISData($row, $errorList);

        }


        return $errorList;
    }


    public static function checkISData(ISOnline $row, $errorList){
        // ตรวจสอบ คำนำหน้าไม่ตรงกับเพศ
        $processName = self::$ERROR_PRENAME_SEX;
        if (!array_key_exists($processName,$errorList)){
            $errorList[$processName] = [];
        }
        if (self::checkFrontNameWithSex($row)){
            $errorList[$processName][] = $row;
        }
        ///////////////////////

        //  ตรวจสอบ คำหน้าหน้า อาชีพเป็น หทาย ตำรวจ แต่ อาชีพไม่ใช้หทาย ตำรวจ
        $processName = self::$ERROR_PRENAME_POLIS_TAHAN;
        if (!array_key_exists($processName,$errorList)){
            $errorList[$processName] = [];
        }
        if (self::checkSoldierPolishFrontNameWithJob($row)){
            //   echo $row->id . " ". $row->prename. " ". $row->sex. " : error คำหน้าหน้า อาชีพเป็น หทาย ตำรวจ แต่ อาชีพไม่ใช้ทหาร ตำรวจ <br>";
            $errorList[$processName][] = $row;
        }

        //   ตรวจสอบ คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส11
        $processName = self::$ERROR_PRENAME_MONK;
        if (!array_key_exists($processName,$errorList)){
            $errorList[$processName] = [];
        }
        if (self::checkMonkFrontNameWithJob($row)){
//            echo $row->id . " ". $row->prename. " ". $row->sex. " : error  คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส 11 <br>";
            $errorList[$processName][] = $row;
        }


        //   ตรวจสอบ คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส11
        $processName = self::$ERROR_DEK_OCCU;
        if (!array_key_exists($processName,$errorList)){
            $errorList[$processName] = [];
        }
        if (self::checkDekWithOccu($row)){
//            echo $row->id . " ". $row->prename. " ". $row->sex. " : error  คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส 11 <br>";
            $errorList[$processName][] = $row;

        }


        return $errorList;
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


    // ตรวจสอบ คำหน้าหน้า อาชีพเป็น ทหาร ตำรวจ แต่ อาชีพไม่ใช้ทหาร ตำรวจ
    public static function checkSoldierPolishFrontNameWithJob(ISOnline $row){



        $check_prename = [ 'ดต.', 'พ.จ', 'ท.', 'ต.', 'อ.' , 'ว่าที่ ' , 'ร.ต', 'ร.ท' , 'เรือ' , 'ตำรวจ', "สิบ","ร้อย" , "พัน" , 'พล'];
        $check_occu = 2;

        $prename = $row->prename;
        $occu = (int) $row->occu;


        foreach ($check_prename as $checkPrename){
            if (strpos($prename , $checkPrename) !== false) {
                if ($occu != $check_occu){
                    return true;
                }
            }
        }

        return false;

    }


    // ตรวจสอบ คำหน้าหน้า พระภิกษุ สามเณร แม่ชี อาชีพรหัส11
    public static function checkMonkFrontNameWithJob(ISOnline $row){

        $check_prename = ['พ.ภ','พระ' , 'ชี' , 'เณร' ];
        $check_occu = 9;


        $prename = $row->prename;
        $OCCU = (int) $row->OCCU;

        foreach ($check_prename as $checkPrename){
            if (strpos($checkPrename, $prename) !== false) {
                if($OCCU != $check_occu){
                    // คำหน้าหน้า อาชีพเป็น ทหาร แต่ อาชีพไม่ใช้ทหาร
                    return true;
                }
            }
        }

        return false;

    }

    //  ตัวแปร คำนำหน้า(PRENAME) และ อาชีพ (OCCU) (เด็ก)
    // เด็กอายุต่ำกว่า 3 ปี อาชีพต้องเป็น 17 เท่านั้น

    // 74 row
    public static function checkDekWithOccu(ISOnline $row){


        $age = (int) $row->age ;
        $occu = (int) $row->occu ;

        if ($occu != 17  ){
            if ($age <= 3  ){
                return true;
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

    public function is_import(){
        $hospData = Lib_hospcode::where('off_id', 'like', '1%')->get();
        return view("page.is_import",compact('hospData'));
    }

    public function is_rawdata(){
        return view("page.is_rawdata");
    }

}
