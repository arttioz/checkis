@extends('layouts.app')
@section('pagename')
Import ไฟล์ IS เข้าถัง IS DIP
@endsection
@section('content')

    <div class="page-header">
        <h1>
            Import ไฟล์ IS เข้าถัง IS DIP เพื่อเช็คข้อมูล
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
              IS WIN to IS DIP
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

        <div class="alert alert-info">
             <h3>***สำคัญ***</h3>
            *ก่อนจะนำข้อมูลเข้าระบบ ให้แน่ใจว่าคุณทำการแปลงไฟล์ที่ Export จาก IS WIN มาอยู่ในรูปแบบ .csv แล้ว <br>
            **การ Export ข้อมูลจาก ISWIN ให้เลือกตั้งแต่เดือน มกราคม จนถึงปัจจุบัน <br>
            *** การอัพโหลดเข้าระบบ IS Checking หากเลือกปีที่เคยอัพโหลดแล้ว ข้อมูลจะทับปีนั้นๆอัตโนมัติ <br>
        <ul>
            <li>- Template ตัวอย่างไฟล์ .CSV   >>Click<< </li>
            <li>- วิธีการแปลงจากไฟล์ .mdb ที่ได้จาก ISWIN เป็น .csv   >>Click<< </li>

            <li>- VDO สอนการใช้งานการ Import ไฟล์ภายใน 1 นาที   >>Click<<  </li>
        </ul>
        </div>

        <hr>

        <div>
            <ul class="steps" style="margin-left: 0">
                <li data-step="1" class="active">
                    <span class="step">1</span>
                    <span class="title">Upload ไฟล์ .csvเข้าระบบ</span>
                </li>

                <li data-step="2">
                    <span class="step">2</span>
                    <span class="title">ตรวจสอบความถูกต้องของข้อมูลที่จะนำเข้า แล้วกด import </span>
                </li>

                <li data-step="3">
                    <span class="step">3</span>
                    <span class="title">ข้อมูลเข้าถัง IS DIP เรียบร้อย สามารถดูข้อมูลได้ที่หัวข้อ Raw Data
                    </span>
                </li>

            </ul>
        </div>

        <hr>

        <div class="page-header">
            <h1>
               แบบฟอร์มอัพโหลดไฟล์
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                  กรุณา เลือกไฟล์ที่ต้องการ / ปีของชุดข้อมูล / ชื่อโรงพยาบาล และหมายเหตุ
                </small>
            </h1>
        </div>

        <div class="row search-row" >
            <div class="col-12">
                <form  name="frm1" method="POST" action="{{ url('/is_import/upload') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">ไฟล์ข้อมูล (.CSV เท่านั้น)</label>
                            <input type="file" name="fileupload" id="fileupload" class="form-control" accept=".csv" >

                        </div>
                        <div class="form-group col-md-4">
                            <label for="">ปี</label>
                            <select class="form-control" name="yy" id="yy" required>
                                <option value="">---กรุณาเลือก---</option>
                                @for($y = 2563; $y >= 2560 ; $y--)

                                    <option value="{{$y}}"  {{ $y == @$yy ? "selected" : "" }}>{{$y}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="">โรงพยาบาล</label>
                            <select class="chosen form-control" name="hosp" id="hosp" required >
                                <option value="">---กรุณาเลือก---</option>

                                @foreach($hospData as $hosp)
                                    <option value="{{$hosp->off_id ?? ""}}"   {{ $hosp->off_id == @$hosp_id ? "selected" : "" }}>
                                        {{$hosp->off_id ?? ""}} {{$hosp->name ?? ""}}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group col-md-12">
                            <textarea class="form-control" id="form-field-8" placeholder="หมายเหตุ" name="note"></textarea>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary search-button"> <i class='fa fa-download bigger-110 '></i>  Upload </button>
                </form>
            </div>
        </div>


        <HR>


            <div class="row table-row">


                <div class="col-12">


                    <div class="clearfix">
                        <div style="float: left;" > <h5>ข้อมูลที่ import มา ถ้าถูกต้อง กดถัดไป </h5></div>

                        <div class="pull-right tableTools-container"></div>
                    </div>


                    <table class="table table-main table-bordered" id="dynamic-table" >
                        <thead>

                        <tr>
                            <th> # </th>
                            <th> รหัสสถานพยาบาล </th>
                            <th> โรงพยาบาล </th>
                            <th> HN </th>
                            <th> PID </th>

                            <th> Note </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody class="table-striped">



                        </tbody>
                    </table>
                </div>
            </div>







        <hr>
{{--Url ทดสอบการดึงข้อมูล IS และเงื่อนไข :  <a href="{{url('checkData/01/2020')}}" target="_blank">Here</a>  |--}}
{{--                Url ทดสอบการดึงข้อมูล IS รายชื่อ :  <a href="{{url('checkData/01/2020')}}" target="_blank">Here</a>--}}






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
                $('#dynamic-table')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable( {
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
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                var row = $(this).closest('tr').get(0);
                if(this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });



            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
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

            $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                no_file:'No File ...',
                btn_choose:'Choose',
                btn_change:'Change',
                droppable:false,
                onchange:null,
                thumbnail:false ,
                whitelist:'csv' ,
                blacklist:'exe|php'
                //onchange:''
                //
            });





        })
    </script>


@endsection
