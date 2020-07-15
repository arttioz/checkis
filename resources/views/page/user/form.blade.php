@extends('layouts.app')
@section('pagename')
    {{$action}}ข้อมูลผู้ใช้งาน
@endsection
@section('content')

    <div class="page-header">
        <h1>
            {{$action}} User
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Users management
            </small>
        </h1>
    </div><!-- /.page-header -->


    <style>
        .search-row {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .search-button {
            width: 100%;
        }

        th, thead {
            text-align: center;
        }
    </style>


    <div class="container">


        <div class="row table-row">


            <div class="col-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif


                @if($action=='create')
                    <form class="form-horizontal" role="form" method="post" action="{{ route('user.store') }}">
                        @elseif($action=='edit')
                            <form class="form-horizontal" role="form" method="post"
                                  action="{{ route('user.update', $user->id) }}">
                                @method('PATCH')

                                @endif
                                @csrf

                                <h4>ข้อมูล Login</h4>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for=""> username </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="" name="username" class="col-xs-10 col-sm-5"
                                               value="{{$user->username ?? "" }}">
                                    </div>
                                </div>

                                @if($action=='create')

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> password </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="password" class="col-xs-10 col-sm-5"
                                                   value="{{$user->password ?? "" }}">
                                        </div>
                                    </div>
                                @elseif($action=='edit')
                                    {{--                                password edit--}}

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for=""> password </label>
                                            <div class="col-sm-9">
                                                <input type="hidden" id="" name="password_old" class="col-xs-10 col-sm-5"
                                                       value="{{$user->password ?? "" }}">

                                                <input type="text" id="" name="password_new" class="col-xs-10 col-sm-5"
                                                       value="">
                                            </div>


                                        </div>
                                    <div class="alert alert-info"> <span class="red">หากต้องการเปลี่ยนรหัสผ่าน ให้กรอกรหัสผ่านใหม่ หากไม่ต้องการเปลี่ยน ให้ปล่อยว่างไว้</span></div>

                                @endif


                                <Hr>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="">
                                            ชื่อ-นามสกุล </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="name" class="col-xs-10 col-sm-5"
                                                   value="{{$user->name ?? "" }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> ตำแหน่ง </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="position" class="col-xs-10 col-sm-5"
                                                   value="{{$user->position ?? "" }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="">
                                            เบอร์โทรศัพท์ </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="phone" class="col-xs-10 col-sm-5"
                                                   value="{{$user->phone ?? "" }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> อีเมล์ <span
                                                class="red">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="email" class="col-xs-10 col-sm-5"
                                                   value="{{$user->email ?? "" }}">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="">
                                            ประเภทผู้ใช้งาน </label>
                                        <div class="col-sm-9">
                                            <select name="type" class="form-control" id="type" required>
                                                @if ($action === 'edit')
                                                    <option value="">--กรุณาเลือก--</option>
                                                    <option value="1" {{ $user->type === "1" ? "selected" : "" }}>
                                                        1.กองป้องกันการบาดเจ็บ
                                                    </option>
                                                    <option value="2" disabled {{ $user->type === "2" ? "selected" : "" }}>
                                                        2.สคร.
                                                    </option>
                                                    <option value="3" disabled {{ $user->type === "3" ? "selected" : "" }}>
                                                        3.สสจ
                                                    </option>
                                                    <option value="4" {{ $user->type === "4" ? "selected" : "" }}>
                                                        4.โรงพยาบาล
                                                    </option>

                                                @else
                                                    <option value="">--กรุณาเลือก--</option>
                                                    <option value="1">1.กองป้องกันการบาดเจ็บ</option>
                                                    <option value="2" disabled>2.สคร.</option>
                                                    <option value="3" disabled>3.สสจ.</option>
                                                    <option value="4">4.โรงพยาบาล</option>

                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="">
                                            โรงพยาบาล </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="hospcode" class="col-xs-10 col-sm-5"
                                                   value="{{$user->hosp ?? "" }}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> จังหวัด </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="province" class="col-xs-10 col-sm-5"
                                                   value="{{$user->province ?? "" }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> เขต </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" name="area" class="col-xs-10 col-sm-5"
                                                   value="{{$user->area ?? "" }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for=""> หมายเหตุ </label>
                                        <div class="col-sm-9">

                                            <textarea name="note"
                                                      class="col-xs-10 col-sm-5">{{$user->note ?? "" }}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="">
                                            สถานะการใช้งาน </label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control" id="status" required>
                                                @if ($action === 'edit')
                                                    <option value="">--กรุณาเลือก--</option>
                                                    <option value="1" {{ $user->status === "1" ? "selected" : "" }}>
                                                        1.เปิดใช้งาน
                                                    </option>
                                                    <option value="0" {{ $user->status === "0" ? "selected" : "" }}>
                                                        0.ระงับการใช้งาน
                                                    </option>

                                                @else
                                                    <option value="">--กรุณาเลือก--</option>
                                                    <option value="1">1.เปิดใช้งาน</option>
                                                    <option value="0">0.ระงับการใช้งาน</option>

                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-info" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn" type="reset">
                                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                                Reset
                                            </button>
                                        </div>
                                    </div>

                            </form>
            </div>
        </div>


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
        jQuery(function ($) {
            //initiate dataTables plugin
            var myTable =
                $('#dynamic-table')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable({
                        bAutoWidth: false,
                        aaSorting: [],
                        "paging": false


                        //"bProcessing": true,
                        //"bServerSide": true,
                        //"sAjaxSource": "http://127.0.0.1/table.php"	,

                        //,
                        //"sScrollY": "200px",
                        //"bPaginate": false,

                        //"sScrollX": "100%",
                        //"sScrollXInner": "120%",
                        //"bScrollCollapse": true,
                        //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                        //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                        //"iDisplayLength": 50


                    });


            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons(myTable, {
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
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    }
                ]
            });
            myTable.buttons().container().appendTo($('.tableTools-container'));

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            ////

            setTimeout(function () {
                $($('.tableTools-container')).find('a.dt-button').each(function () {
                    var div = $(this).find(' > div').first();
                    if (div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);


            myTable.on('select', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
                }
            });
            myTable.on('deselect', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
                }
            });


            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) myTable.row(row).select();
                    else myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
                var row = $(this).closest('tr').get(0);
                if (this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });


            $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });


            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#simple-table').on('click', 'td input[type=checkbox]', function () {
                var $row = $(this).closest('tr');
                if ($row.is('.detail-row ')) return;
                if (this.checked) $row.addClass(active_class);
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

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }


        })
    </script>


@endsection
