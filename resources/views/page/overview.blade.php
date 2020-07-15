@extends('layouts.app')
@section('pagename')
    ภาพรวมข้อมูล
    @endsection
@section('content')

    <style type="text/css">.resp-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .resp-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }</style>


    <div class="page-header">
        <h1>
            IS Checking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
             ภาพรวมข้อมูล
            </small>
        </h1>
    </div><!-- /.page-header -->





        <div class="row " >
            <div class="  text-center">


                <div class="resp-container"><iframe class="resp-iframe" src="http://dip.ddc.moph.go.th/rti_dashboard/view/ischecking/all.php" gesture="media" allow="encrypted-media" allowfullscreen="allowfullscreen"></iframe></div>





            </div>



        </div>

@endsection
