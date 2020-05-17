@extends('layouts.app')

@section('content')

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

                <div class="alert-info">
                    ระบบตรวจเช็คข้อมูล IS ....
                </div>












 <h2>ในระบบมีการตรวจสอบข้อมูลผิดพลาดทั้งหมด 21 + xx ขั้นตอน ดังนี้</h2>
                <OL style="font-size: 18px;">
                    <li>ตัวแปร SEX (เพศ) ไม่ตรงกับ PRENAME (คำนำหน้า)</li>

                </OL>


{{--                <embed src="{{ URL::asset('assets/files/total_ref1.pdf')}}" width="800px" height="2100px" />--}}







            </div>




        </div>
    </div>



@endsection
