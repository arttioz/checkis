@extends('layouts.app')
@section('pagename')
ผลการตรวจสอบคุณภาพข้อมูล {{-- {{ @$hosp_id ?? '' }}--}} {{ $hosp_name->name ?? "ทั้งหมด" }} | เดือน : <?php
$m_w = sprintf("%02d",@$mm) ;
if ($m_w=='01') {echo 'มกราคม';}
elseif ($m_w=='02') {echo 'กุมภาพันธ์';}
elseif ($m_w=='03') {echo 'มีนาคม';}
elseif ($m_w=='04') {echo 'เมษายน';}
elseif ($m_w=='05') {echo 'พฤษภาคม';}
elseif ($m_w=='06') {echo 'มิถุนายน';}
elseif ($m_w=='07') {echo 'กรกฎาคม';}
elseif ($m_w=='08') {echo 'สิงหาคม';}
elseif ($m_w=='09') {echo 'กันยายน';}
elseif ($m_w=='10') {echo 'ตุลาคม';}
elseif ($m_w=='11') {echo 'พฤศจิกายน';}
elseif ($m_w=='12') {echo 'ธันวาคม';}
elseif (@$mm=='ALL') {echo 'ทุกเดือน';}
?> | ปี : {{ @$yy+543 ?? '' }}
@endsection

@section('content')

    @php
        @$act=$_GET['act'];
    if($act=='excel'){
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    }
    @endphp

    <div class="page-header">
        <h1>
            ตรวจสอบข้อมูลผิดพลาด
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                (27 List &  13 Process)
            </small>
        </h1>
    </div><!-- /.page-header -->


    <style>
        .search-row{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .search-button{
            width: 100%;
        }

        .table-row{

        }
    </style>

    <div class="container">


        <div class="row search-row" >
            <div class="col-12 col-lg-12 col-sm-12">
                <form  name="frm1" method="POST" action="{{ url('/check_error/process') }}">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">เดือน</label>
                            <select class="form-control" name="mm" id="mm" required>
                                <option value="">---กรุณาเลือก---</option>
                                @for($m = 01; $m <=12 ; $m++)
                                    <option value="{{$m}}"  {{ $m == @$mm ? "selected" : "" }}>{{sprintf("%02d",$m)}}</option>
                                @endfor
                                <option value="ALL"  {{ @$mm == 'ALL' ? "selected" : "" }}>ทุกเดือน</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">ปี</label>
                            <select class="form-control" name="yy" id="yy" required>
                                <option value="">---กรุณาเลือก---</option>
                                @for($y = 2020; $y >= 2015 ; $y--)

                                    <option value="{{$y}}"  {{ $y == @$yy ? "selected" : "" }}>{{$y+543}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="">โรงพยาบาล</label>
                            <select class="chosen form-control" name="hosp" id="hosp" required >
                               <option value="">---กรุณาเลือก---</option>
{{--                                <option value="ALL" {{ @$hosp_id == 'ALL' ? "selected" : "" }}>ทุกโรงพยาบาล(Admin)</option>--}}
                                @foreach($hospData as $hosp)
                                    <option value="{{$hosp->off_id ?? ""}}"   {{ $hosp->off_id == @$hosp_id ? "selected" : "" }}>
                                       {{$hosp->off_id ?? ""}} {{$hosp->name ?? ""}}</option>


                                @endforeach




                            </select>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary search-button"> ตรวจข้อมูล </button>
                </form>
            </div>
        </div>


        @if(isset($isData) )
        <h3 class="text-center">ผลการตรวจสอบคุณภาพข้อมูล  {{-- {{ @$hosp_id ?? '' }}--}}  {{ $hosp_name->name ?? "" }} {{ $hosp_id == 'ALL' ? "ทั้งหมด" : "" }} | เดือน : <?php

            if ($m_w=='01') {echo 'มกราคม';}
            elseif ($m_w=='02') {echo 'กุมภาพันธ์';}
            elseif ($m_w=='03') {echo 'มีนาคม';}
            elseif ($m_w=='04') {echo 'เมษายน';}
            elseif ($m_w=='05') {echo 'พฤษภาคม';}
            elseif ($m_w=='06') {echo 'มิถุนายน';}
            elseif ($m_w=='07') {echo 'กรกฎาคม';}
            elseif ($m_w=='08') {echo 'สิงหาคม';}
            elseif ($m_w=='09') {echo 'กันยายน';}
            elseif ($m_w=='10') {echo 'ตุลาคม';}
            elseif ($m_w=='11') {echo 'พฤศจิกายน';}
            elseif ($m_w=='12') {echo 'ธันวาคม';}
            elseif (@$mm=='ALL') {echo 'ทุกเดือน';}
            ?> | ปี : {{ @$yy+543 ?? '' }}
        </h3>
            <div class="col-sm-6">
                <div class="alert alert-success center"> ข้อมูลทั้งหมด {{ $ISCount }} รายการ </div>
            </div>

            <div class="col-sm-6">
                <div class="alert alert-danger center"> ข้อมูลเข้าเงื่อนไข Error  xx รายการ
                    <a href="#" class="blue">
                        <i class="ace-icon fa fa-download">Export</i>
                    </a>
                </div>
            </div>


        <hr>
            {{--Start Error 27 list--}}
{{--            <div class="col-sm-12">--}}
{{--                <h3 class="row header   lighter blue">--}}
{{--                    <span class="col-xs-12">   27 List (From IS Checking MS Access) <small>เมื่อทุกรายการ ok จะนำมาใส่ส่วนนี้</small> </span><!-- /.col -->--}}
{{--                </h3>--}}

{{--                <div id="accordion" class="accordion-style1">--}}
{{--                    <div class="panel panel-default">--}}
{{--                        <div class="panel-heading">--}}
{{--                            <h4 class="panel-title">--}}


{{--                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-1" aria-expanded="false">--}}
{{--                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>--}}
{{--                                    &nbsp; 01-บันทึก เวลาที่เกิดเหตุ (Atime) และ เวลาที่มาถึง รพ. (Htime) ทุกราย--}}


{{--                                </a>--}}
{{--                                <span class="badge badge-danger" style="float: right;background-color: red;">{{count($is_List1)}}</span>--}}
{{--                            </h4>--}}


{{--                        </div>--}}

{{--                        <div class="panel-collapse collapse" id="3-1" aria-expanded="false" style="height: 0px;">--}}
{{--                            <div class="panel-body">--}}
{{--                                --}}{{-- List 1--}}
{{--                                <div class="row table-row">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="clearfix">--}}


{{--                                            <div class="pull-right tableTools-container"></div>--}}
{{--                                        </div>--}}

{{--                                        <table class="table table-main table-bordered display" id="dynamic-table" >--}}
{{--                                            <thead>--}}

{{--                                            <tr>--}}
{{--                                                <th> # </th>--}}
{{--                                                <th> รหัสสถานพยาบาล </th>--}}
{{--                                                <th> โรงพยาบาล </th>--}}
{{--                                                <th> HN </th>--}}
{{--                                                <th> ชื่อ-สกุล </th>--}}
{{--                                                <th>วันที่เกิดเหตุ</th>--}}
{{--                                                <th>เวลาที่เกิดเหตุ</th>--}}
{{--                                                <th>วันที่มาถึง</th>--}}
{{--                                                <th>เวลาที่มาถึง</th>--}}
{{--                                                <th> lastupdate </th>--}}
{{--                                                <th> Action </th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody class="table-striped">--}}

{{--                                            @foreach($is_List1 as $item)--}}
{{--                                                <tr>--}}
{{--                                                    <td> {{ $loop->iteration }}</td>--}}
{{--                                                    <td>{{ $item->hosp ?? "" }}</td>--}}
{{--                                                    <td> {{ $hosp_name->name ?? "" }}   </td>--}}
{{--                                                    <td> {{ $item->hn ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->adate ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->atime ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->hdate ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->htime ?? "" }}  </td>--}}
{{--                                                    <td> {{ $item->lastupdate ?? "" }}  </td>--}}
{{--                                                    <td> </td>--}}


{{--                                                </tr>--}}

{{--                                            @endforeach--}}


{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <hr>--}}

{{--                                --}}{{-- List 1--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="panel panel-default">--}}
{{--                        <div class="panel-heading">--}}
{{--                            <h4 class="panel-title">--}}
{{--                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-2" aria-expanded="false">--}}
{{--                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>--}}
{{--                                    02-อุบัติเหตุขนส่ง  การบาดเจ็บ (Injby) ต้องไม่มีรหัส  2 - ทำร้ายตนเอง  3 – ผู้อื่นทำร้าย--}}
{{--                                </a>--}}
{{--                                <span class="badge badge-danger" style="float: right;background-color: red;">{{count($is_List2)}}</span>--}}
{{--                            </h4>--}}
{{--                        </div>--}}

{{--                        <div class="panel-collapse collapse" id="3-2" aria-expanded="true" style="">--}}
{{--                            <div class="panel-body">--}}
{{--                               NA--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="panel panel-default">--}}
{{--                        <div class="panel-heading">--}}
{{--                            <h4 class="panel-title">--}}
{{--                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-3" aria-expanded="false">--}}
{{--                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>--}}
{{--                                    03-เด็กอายุ < 5 ปี ไม่ควรทำร้ายตนเอง (Injby = 2)--}}
{{--                                </a>--}}
{{--                                <span class="badge badge-danger" style="float: right;background-color: red;">{{count($is_List3)}}</span>--}}
{{--                            </h4>--}}
{{--                        </div>--}}

{{--                        <div class="panel-collapse collapse" id="3-3" aria-expanded="false" style="height: 0px;">--}}
{{--                            <div class="panel-body">--}}
{{--                               NA--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}{{--End Error 27 list--}}


{{--<br><br><br>--}}

<hr>

        
{{--            <h3 class="center">--- 27 List--- <small>เมื่อเสร็จแล้วจะนำไปใส่ใน bullet ด้านบน</small> </h3>--}}

            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>01-บันทึก เวลาที่เกิดเหตุ (Atime) และ เวลาที่มาถึง รพ. (Htime) ทุกราย
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th>วันที่เกิดเหตุ</th>
                            <th>เวลาที่เกิดเหตุ</th>
                            <th>วันที่มาถึง</th>
                            <th>เวลาที่มาถึง</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                    @foreach($is_List1 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->adate ?? "" }}  </td>
                                <td> {{ $item->atime ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->htime ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>


                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>02-อุบัติเหตุขนส่ง  การบาดเจ็บ (Injby) ต้องไม่มีรหัส  2 - ทำร้ายตนเอง  3 – ผู้อื่นทำร้าย
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                       @foreach($is_List2 as $item)
                           <tr>
                               <td> {{ $loop->iteration }}</td>
                               <td>{{ $item->hosp ?? "" }}</td>
                               <td> {{ $hosp_name->name ?? "" }}   </td>
                               <td> {{ $item->hn ?? "" }}  </td>
                               <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                               <td> {{ $item->hdate ?? "" }}  </td>
                               <td> {{ $item->lastupdate ?? "" }}  </td>
                               <td> </td>
                           </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>03-เด็กอายุ < 5 ปี ไม่ควรทำร้ายตนเอง (Injby = 2)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List3 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>04-* บันทึกพฤติกรรมเสี่ยงโทรศัพท์มือถือ (Risk 5)ทุกราย
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List4 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>05-* บันทึก ICDcause ทุกรายยกเว้น อุบัติเหตุขนส่งที่ไม่ต้องบันทึกเพราะใช้ช่อง(cause =1)แทน
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List5 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>06-* บันทึกการมาจากที่เกิดเหตุทุกราย( Atohosp)โดยถ้าเป็นการมาด้วย หน่วยบริการการแพทย์ฉุกเฉิน (EMS)ให้ระบุระดับ ALS,BLS,หรือFR
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>atohosp</th>
                            <th>htohosp</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List6 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td>{{ $item->atohosp ?? "" }}</td>
                                <td>{{ $item->htohosp ?? "" }}</td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>07-เด็กอายุต่ำกว่า 5 ปี ไม่ควรดื่มแอลกอฮอล์ ( Risk1<>0)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>อายุ</th>
                            <th>risk1</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List7 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td>{{ $item->age ?? "" }}</td>
                                <td>{{ $item->risk1 ?? "" }}</td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>08-ไม่ควรมีบาดเจ็บในอาชีพจากการทำร้ายตนเอง  (Injby = 2)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List8 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>09-* DBA ไม่ควรมาโรงพยาบาลโดยไม่มีผู้นำส่ง ( Atohosp =0 )
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">
                        @foreach($is_List9 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>10-อุบัติเหตุตกน้ำ จมน้ำ(ICDcause=W65-W74) จุดเกิดเหตุไม่ควรเป็นถนน ( Apoint = 5)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> icdcause </th>
                            <th> apoint </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List10 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->icdcause ?? "" }}  </td>
                                <td> {{ $item->apoint ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>11-บาดเจ็บจากอุบัติเหตุ (Injby = 1) แต่สาเหตุเป็นเจตนา icdcause = X60-Y09
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>injby</th>
                            <th>icdcause</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List11 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->injby ?? "" }}  </td>
                                <td> {{ $item->icdcause ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>12-บาดเจ็บจากการทำร้ายตนเอง (Injby = 2) แต่สาเหตุไม่ทำร้ายตนเองด้วยวิธีต่าง ๆ  ( ICD cause<> X60-X84)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>injby</th>
                            <th>icdcause</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List12 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->injby ?? "" }}  </td>
                                <td> {{ $item->icdcause ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>13-บาดเจ็บจากผู้อื่นทำร้าย (Injby =3) แต่สาเหตุไม่ถูกทำร้ายด้วยวิธีต่าง ๆ (ICDcause =X85-Y09)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>injby</th>
                            <th>icdcause</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List13 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->injby ?? "" }}  </td>
                                <td> {{ $item->icdcause ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>14-* ถ้าบาดเจ็บจากอาชีพ (injoccu)ต้องมีการบันทึกอาชีพ (occu) ทุกราย

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th>injoccu</th>
                            <th>occu</th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List14 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->injoccu ?? "" }}  </td>
                                <td> {{ $item->occu ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 15--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>15-ผู้บาดเจ็บ ที่มี  br = 6  ais = 1 ไม่สมควรตาย หากตายควรมีเหตุผลแนบ จำหน่ายผู้ป่วยออกจาก er (staer=1 – เสียชีวิตก่อนถึง รพ., 6-ถึงแก่กรรม) จำหน่ายผู้ป่วยจากward (staward=5 ถึงแก่กรรม) (ใช้กับ is ของ รพท/รพศ)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> staer </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List15 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->staer ?? "" }}  </td>

                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>




            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>16-* ต้องมีข้อมูลเพศทุกคน (sex= 1 ชาย  2- หญิง)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> sex </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List16 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->sex ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>17-bp, rr, p ไม่ควรเกินกว่ากำหนด (bp1 ไม่เกิน 300 bp2 ไม่เกิน 300 pr ไม่เกิน 200 rr ไม่เกิน 60 )(ใช้กับ is ของ   รพท/รพศ)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List17 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>18-จำหน่ายผู้ป่วยออกแล้ว (staward) แต่ไม่มีวันที่จำหน่าย (rdate)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> staward </th>
                            <th> rdate </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List18 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->staward ?? "" }}  </td>
                                <td> {{ $item->rdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>19-* ต้องมีข้อมูลอายุเป็น ปี (age) หรือเดือน (month) หรือวัน (year) ทุกคน

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> วันเกิด </th>
                            <th> อายุปี </th>
                            <th> อายุเดือน </th>
                            <th> อายุวัน </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List19 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ date('Y-m-d', strtotime($item->birth))  ?? "" }}  </td>
                                <td> {{ $item->year ?? "" }}  </td>
                                <td> {{ $item->month ?? "" }}  </td>
                                <td> {{ $item->day ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>



            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>20-ถ้าผู้ป่วยมีการ admit ทุกรายต้องแสดงสถานภาพการจำหน่ายจาก  ward ( หาก staer=7 <รับไว้รักษา> การ staward ต้องมีสถานภาพการจำหน่ายอย่างใดอย่างหนึ่ง)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> staer </th>
                            <th> staward </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List20 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->staer ?? "" }}  </td>
                                <td> {{ $item->staward ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>



            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>21-* ต้องมีการบันทึกสถานที่เกิดเหตุ (aplace)ทุกรายให้ครบถึงหมู่บ้าน

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List21 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>22-* บันทึกจุดเกิดเหตุทุกราย ( apoint)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List22 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <hr>



            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>24-* บันทึกพฤติกรรมเสี่ยงแอลกอฮอล์ (risk 1)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List24 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>25-hn/name/fname ว่าง

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List25 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>26-* บันทึกพฤติกรรมเสี่ยงเข็มขัดนิรภัยทุกราย (risk 3) ในกรณีอุบัติเหตุขนส่ง (cause=1) ของรถยนต์ทุกชนิด (v40-79)

                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List26 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            {{-- List 14--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>27-* บันทึกพฤติกรรมเสี่ยงหมวกนิรภัยทุกราย (risk 4) ในกรณีอุบัติเหตุขนส่ง (cause=1) ของรถจักรยานยนต์ทุกชนิด (v20-29)
                                <span class="red"></span> </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> ชื่อ-สกุล </th>
                            <th> วันที่มาถึง </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($is_List27 as $item)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>
                                <td> {{ $item->hdate ?? "" }}  </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>







            <h3 class="center">--- 13 Process // Ann ---</h3>


       {{-- Process 1--}}
        <div class="row table-row">
            <div class="col-12">
                <div class="clearfix">
                    <div style="float: left;" > <h5>1 ตัวแปร SEX (เพศ) และ PRENAME (คำนำหน้า)
                            <span class="red"></span> </h5></div>

                    <div class="pull-right tableTools-container"></div>
                </div>

                <table class="table table-main table-bordered display" id="dynamic-table" >
                    <thead>

                    <tr>
                        <th> # </th>
                        <th> รหัสสถานพยาบาล </th>
                        <th> โรงพยาบาล </th>
                        <th> HN </th>
                        <th> คำนำหน้า </th>
                        <th> เพศ </th>
                        <th> lastupdate </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody class="table-striped">

                    @foreach($isProcess1 as $item1)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td>{{ $item1->hosp ?? "" }}</td>
                        <td> {{ $hosp_name->name ?? "" }}   </td>
                        <td> {{ $item1->hn ?? "" }}  </td>
                        <td> {{ $item1->prename ?? "" }}  </td>
                        <td> {{ $item1->sex ?? "" }}  </td>
                        <td> {{ $item1->lastupdate ?? "" }}  </td>
                        <td> <input name="note" class=""> </td>


                    </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <hr>

            {{-- start Process 2.1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>2. ตัวแปร AGE (อายุ) จะต้องไม่มีค่าว่าง  ยกเว้น เคส DBA DER</h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> อายุ </th>
                            <th> DIAG1 </th>
                            <th> DIAG2 </th>

                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess2_1 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->age ?? "" }}  </td>
                                <td>  {{ $item->diag1 ?? "" }}   </td>
                                <td>  {{ $item->diag2 ?? "" }}   </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <input name="note" class=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         <hr>
            {{-- end Process 2.1--}}
            {{-- start Process 2.2--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>2.2 เด็กอายุต่ำกว่า 5 ปี ไม่ควรขับขี่อย่างอื่นที่ไม่ใช่ จยย </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> อายุ </th>
                            <th> ผู้ขับขี่(INJP) </th>
                            <th> ยานพาหนะ(INJT) </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess2_2 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->age ?? "" }}  </td>
                                <td>  {{ $item->injp ?? "" }}   </td>
                                <td>  {{ $item->injt ?? "" }}   </td>

                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <input name="note" class=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            {{-- end Process 2.2--}}

            {{-- start Process 3.1--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>3.1 ตัวแปร คำนำหน้า(PRENAME) และ อาชีพ (OCCU)  (ทหาร / ตำรวจ) </h5> <small> ทหาร ตำรวจทุกหมู่เหล่า หรือราชการบำนาญ จะต้องมีรหัสอาชีพเป็น 02 แต่ถ้าไม่ได้ใช้สิทธิเบิก ให้ใช้อาชีะที่ผู้บาดเจ็บบอกอาชีพปัจจุบันิ </small></div>



                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> Prename </th>
                            <th> OCCU </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess3_1 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }}  </td>
                                <td>  {{ $item->occu ?? "" }}   </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <input name="note" class=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            {{-- end Process 3.1--}}

            {{-- start Process 3.2--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>3.2 ตัวแปร คำนำหน้า(PRENAME) และ อาชีพ (OCCU)  (พระ) </h5>
                            <small> พระ Occu ต้องเป็น 09 เท่านั้น </small></div>
                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> Prename </th>
                            <th> OCCU </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess3_2 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }}  </td>
                                <td>  {{ $item->occu ?? "" }}   </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <input name="note" class=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            {{-- end Process 3.2--}}


            {{-- start Process 3.3--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>3.3 ตัวแปร คำนำหน้า(PRENAME) และ อาชีพ (OCCU)  (เด็ก) </h5>
                            <small> เด็กอายุต่ำกว่า 3 ปี อาชีพต้องเป็น  17 เท่านั้น </small></div>
                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> Prename </th>
                            <th> อายุ </th>
                            <th> OCCU </th>
                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess3_3 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }}  </td>
                                <td> {{ $item->age ?? "" }}  </td>
                                <td>  {{ $item->occu ?? "" }}   </td>
                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <input name="note" class=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            {{-- end Process 3.3--}}



            {{-- start Process 4--}}
            <div class="row table-row">
                <div class="col-12">
                    <div class="clearfix">
                        <div style="float: left;" > <h5>4. ตัวแปรอาชีพ (OCCU) ต้องไม่มีค่ำว่ำง
                            </h5>
                            <small> </small></div>
                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <table class="table table-main table-bordered display" id="dynamic-table2" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> Prename </th>
                            <th> OCCU </th>

                            <th> lastupdate </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">

                        @foreach($isProcess4 as $item )
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $item->hosp ?? "" }}</td>
                                <td> {{ $hosp_name->name ?? "" }}   </td>
                                <td> {{ $item->hn ?? "" }}  </td>
                                <td> {{ $item->prename ?? "" }}  </td>
                                <td>  {{ $item->occu ?? "" }}   </td>

                                <td> {{ $item->lastupdate ?? "" }}  </td>
                                <td> <button class="btn btn-white btn-info btn-bold disabled">
                                        <i class="ace-icon fa fa-search bigger-120 blue"></i>

                                    </button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            {{-- end Process 4--}}



        @endif





        <hr>
{{--        *การดึงข้อมูลถูกจำกัดอยู่ที่ 999 Record เพื่อป้องกันการทำงานที่ผิดพลาดของระบบ--}}
<br><br>
    </div>



    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <!-- page specific plugin scripts -->
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.select.min.js')}}"></script>


    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable =
                $('table.display')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable( {
                        bAutoWidth: false,
                        aaSorting: [],
                        "paging": true
                    } );



            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons( myTable, {
                buttons: [
                 {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: true,
                        message: 'IS Checking'
                    }
                ]
            } );
            myTable.buttons().container().appendTo( $('.tableTools-container') );

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            ////

            setTimeout(function() {
                $($('.tableTools-container')).find('a.dt-button').each(function() {
                    var div = $(this).find(' > div').first();
                    if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);





            myTable.on( 'select', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                }
            } );
            myTable.on( 'deselect', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                }
            } );




            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('table.display > thead > tr > th input[type=checkbox], table.display_wrapper input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('table.display').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('table.display').on('click', 'td input[type=checkbox]' , function(){
                var row = $(this).closest('tr').get(0);
                if(this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });



            $(document).on('click', 'table.display .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });



            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                var $row = $(this).closest('tr');
                if($row.is('.detail-row ')) return;
                if(this.checked) $row.addClass(active_class);
                else $row.removeClass(active_class);
            });



            /********************************/
            //add tooltip for small view action buttons in dropdown menu
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }






        })
    </script>

@endsection
