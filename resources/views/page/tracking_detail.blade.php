@extends('layouts.app')
@section('pagename')
    ติดตามข้อมูลโรงพยาบาล {{$hospData->name}}
@endsection
@section('content')
    <style>
        th { text-align: center;}
    </style>
    <div class="page-header">
        <h1>
            IS tracking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                 {{$hospData->name}}
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">


{{--

                <div class="alert alert-info">
                    <h3>

                    </h3>

                </div>
--}}



                {{-- start Process 4--}}
                <div class="row table-row">
                    <div class="col-12">
                        <div class="clearfix">
                            <div style="float: left;" > <h5> {{$hospData->name}} : {{$year ?? ""}}
                                </h5>
                                <small> </small></div>
                            <div class="pull-right tableTools-container"></div>
                        </div>

                        <table class="table table-main table-bordered dynamic-table" id="dynamic-table2" >
                            <thead>

                            <tr>
                                <th> เดือน </th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>รวม</th>

                            </tr>
                            </thead>
                            <tbody class="table-striped">
 <tr>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>
     <td>NNN</td>

 </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                {{-- end Process 4--}}

{{--                <embed src="{{ URL::asset('assets/files/total_ref1.pdf')}}" width="800px" height="2100px" />--}}







            </div>




        </div>
    </div>



@endsection
