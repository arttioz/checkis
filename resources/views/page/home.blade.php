@extends('layouts.app')

@section('content')

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
                <form >
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">เดือน</label>
                            <select class="form-control" name="month" id="month">
                                @for($m = 1; $m <=12 ; $m++)
                                    <option value="{{$m}}">{{$m}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">ปี</label>
                            <select class="form-control" name="month" id="month">
                                @for($y = 2562; $y <= 2563 ; $y++)
                                    <option value="{{$y}}">{{$y}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary search-button"> ตรวจข้อมูล </button>
                </form>
            </div>
        </div>


        <div class="row table-row">
            <div class="col-12">
                <table class="table table-main" id="main_table">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> รหัสสถานพยาบาล </th>
                        <th> โรงพยาบาล </th>
                        <th> จำนวนข้อมูลที่ผิด </th>
                        <th> ดูข้อมูล </th>
                    </tr>
                    </thead>
                    <tbody class="table-striped">
                    <tr>
                        <td> 1           </td>
                        <td> 11147           </td>
                        <td> รพช. เกาะตา      </td>
                        <td> 10000  </td>
                        <td> <button> ดาวน์โหลด </button>       </td>
                    </tr>
                    <tr>
                        <td> 2           </td>
                        <td> 11148           </td>
                        <td> รพช. เกาะโฮ้    </td>
                        <td> 10  </td>
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
