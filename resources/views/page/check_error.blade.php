@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>
            IS Checking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
             ตรวจสอบข้อมูลผิดพลาด (21 Plus)
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
            <div class="col-12">
                <form  >
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">เดือน</label>
                            <select class="form-control" name="month" id="month">
                                @for($m = 1; $m <=12 ; $m++)
                                    <option value="{{$m}}">{{$m}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">ปี</label>
                            <select class="form-control" name="month" id="month">
                                @for($y = 2562; $y <= 2563 ; $y++)
                                    <option value="{{$y}}">{{$y}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="">โรงพยาบาล</label>
                            <select class="form-control" name="hosp" id="hosp">
                               <option value="">---กรุณาเลือก---</option>
                            </select>
                        </div>

                    </div>
                    <button type="button" class="btn btn-primary search-button"> ตรวจข้อมูล </button>
                </form>
            </div>
        </div>


        <h1 class="text-center">**Discuss ในเรื่องรูปแบบการแสดงผล**</h1>

        <div class="row table-row">
            <div class="col-12">
<h5>1 ตัวแปร SEX (เพศ) และ PRENAME (คำนำหน้า)</h5>
                <table class="table table-main table-bordered" id="main_table">
                    <thead>

                    <tr>
                        <th> # </th>
                        <th> รหัสสถานพยาบาล </th>
                        <th> โรงพยาบาล </th>
                        <th> HN </th>
                        <th> ดูข้อมูล </th>
                    </tr>
                    </thead>
                    <tbody class="table-striped">
                    <tr>
                        <td> 1           </td>
                        <td> 11147           </td>
                        <td> รพช. เกาะตา      </td>
                        <td> 123456  </td>
                        <td> <button> ดาวน์โหลด </button>       </td>
                    </tr>
                    <tr>
                        <td> 2           </td>
                        <td> 11147           </td>
                        <td> รพช. เกาะตา    </td>
                        <td> 789876  </td>
                        <td> <button> ดาวน์โหลด </button>       </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#main_table').DataTable();
        } );
    </script>

@endsection
