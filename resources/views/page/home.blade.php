@extends('layouts.app')
@section('pagename','Home')
@section('content')
    <style>
        th { text-align: center;}
    </style>
    <div class="page-header">
        <h1>
            IS Checking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
              เกี่ยวกับระบบ
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">

                <div class="alert alert-success">
                @if(isset($chk_is))
                   <h3>IS Database already</h3>

                @else
                        <h3 class="red">   IS Database can't already</h3>
                    @endif
                </div>



            </div>






            <div class="row">
{{-- start wiget 1--}}
                <div class="col-sm-6">
                    <h3 class="row header smaller lighter blue">
                        <span class="col-xs-12"> 1.คู่มือการติดตั้ง </span><!-- /.col -->
                    </h3>

                    <div id="accordion" class="accordion-style1 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">


                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#1-1" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 1.1 โปรแกรม ISWIN Online Version 3.0 การนำเข้าข้อมูล สำหรับติดตั้งครั้งแรก (15 มี.ค. 2562)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="1-1" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">

                                 <a href="{{url('download/ISWINOnlineV3__201903.rar')}}">Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#1-2" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;1.2 Update Program ISWIN Online Version3.0 (15 มี.ค. 2562)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="1-2" aria-expanded="false" style="">
                                <div class="panel-body">
                                  Download
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#1-3" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;1.3 วิธีการติดตั้งโปรแกรม ISWIN
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="1-3" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    Download
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End wiget 1--}}



                {{-- start wiget 2--}}
                <div class="col-sm-6">
                    <h3 class="row header smaller lighter blue">
                        <span class="col-xs-12"> 2.การนำเข้าข้อมูล </span><!-- /.col -->
                    </h3>

                    <div id="accordion" class="accordion-style1 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#2-1" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 2.1 วิธีนำเข้าข้อมูลจากโปรแกรม ISWIN Version 1 มา Version 3  (ISWIN V1  to ISWIN V3)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="2-1" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                   VDO <br>
                                    File
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#2-2" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 2.2 วิธีนำเข้าข้อมูลจากโปรแกรม ISWIN Version 2 มา Version 3  (ISWIN V2  to ISWIN V3)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="2-2" aria-expanded="false" style="">
                                <div class="panel-body">
                                    VDO <br>
                                    File
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#2-3" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 2.3 ขั้นตอนการติดตั้งโปรแกรม
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="2-3" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    VDO <br>
                                    File
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End wiget 2--}}
            </div>

                <div class="row">
                {{-- start wiget3--}}
                <div class="col-sm-6">
                    <h3 class="row header smaller lighter blue">
                        <span class="col-xs-12"> 3.คู่มือการลงรหัส (ฉบับปรับปรุง 2563) </span><!-- /.col -->
                    </h3>

                    <div id="accordion" class="accordion-style1 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">


                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-1" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 3.1 คู่มือการใช้แบบบันทึกข้อมูลเฝ้าระวังการบาดเจ็บแห่งชาติ(ฉบับปรับปรุง พ.ศ. 2560)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="3-1" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                   Download
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-2" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 3.2 คู่มือการลงรหัสแบบบันทึกระบบเฝ้าระวังการบาดเจ็บ(ฉบับปรับปรุง พ.ศ. 2560)
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="3-2" aria-expanded="true" style="">
                                <div class="panel-body">
                                    Download
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#3-3" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;  3.3 แบบฟอร์ม IS_18 Sep 2017
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="3-3" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                  download
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End wiget3--}}



                {{-- start wiget4--}}
                <div class="col-sm-6">
                    <h3 class="row header smaller lighter blue">
                        <span class="col-xs-12"> 4. VDOสอนการใช้งาน </span><!-- /.col -->
                    </h3>

                    <div id="accordion" class="accordion-style1 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">


                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#4-1" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;4.1 การใช้งานโปรแกรมเบื้องต้น
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="4-1" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                   - VDO การใช้งานโปรแกรมเบื้องต้น เพื่อดูว่าใช้งานได้มั้ย
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#4-2" aria-expanded="false">

                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 4.2 การนำข้อมูลออกมาใช้งาน
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="4-2" aria-expanded="false" style="">
                                <div class="panel-body">
                                    VDO การนำข้อมูลออกมาใช้งาน / วิเคราะห์ - นำเสนอผู้บริหาร - เผยแพร่ให้ความรู้ประชาชน
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#4-3" aria-expanded="false">
                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp; 4.3 การส่งข้อมูลเข้าสู่ฐานข้อมูลกลาง
                                    </a>
                                </h4>
                            </div>

                            <div class="panel-collapse collapse" id="4-3" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                 VDO การส่งข้อมูลเข้าฐานข้อมูลกลาง (สป.)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End wiget4--}}





                {{--                <embed src="{{ URL::asset('assets/files/total_ref1.pdf')}}" width="800px" height="2100px" />--}}











            </div>

            <div class="alert  alert-info text-center">
                <h5>  ความร่วมมือระหว่าง</h5>
                <h3> กองระบาดวิทยา x กองสาธารณสุขฉุกเฉิน x กองป้องกันการบาดเจ็บ</h3>

            </div>


        </div>
    </div>




@endsection
