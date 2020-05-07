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

        $isData = ISOnline::whereMonth("lastupdate",$month)->whereYear("lastupdate",$year)->limit("10")->get();
        foreach ($isData as $row){
            self::checkISData($row);
        }
    }

    public static  function checkISData(ISOnline $row){

       if (self::checkFrontNameWithSex($row)){
           echo $row->id . " : error  checkFrontNameWithSex <br>";
       }
        if (self::checkDriverAge($row)){
            echo $row->id . " : error  checkDriverAge <br>";
        }

    }

    public static function checkFrontNameWithSex(ISOnline $row){

       return true;
    }

    public static function checkDriverAge(ISOnline $row){

        return true;
    }
}
