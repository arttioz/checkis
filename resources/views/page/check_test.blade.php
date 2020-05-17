@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>
            IS Checking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
             ตรวจสอบข้อมูลผิดพลาด (13 Process by Ann)
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

            <?php
                          foreach ($preNames as $key => $count) { ?>

                    <tr>
                        <td> 1   </td>
                        <td> {{ $key}}  </td>
                        <td> {{ $count}}   </td>
                        <td> 123456  </td>
                        <td> <button> ดาวน์โหลด </button>       </td>
                    </tr>
            <?php     }
                          ?>
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
