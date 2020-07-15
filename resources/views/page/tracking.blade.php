@extends('layouts.app')
@section('pagename','ติดตามข้อมูล')
@section('content')
    <style>
        th {
            text-align: center;
        }
    </style>
    <div class="page-header">
        <h1>
            IS tracking
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                ติดตามข้อมูล
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">



                {{-- start Process
                --}}
                <div class="row table-row">
                    <div class="col-12">
                        <div class="clearfix">
                            <div style="float: left;"><h5>โรงพยาบาลที่ส่งข้อมูลล่าสุด (IS WIN -> IS สป.)
                                </h5>
                                <small> เรียงจาก โรงพยาบาลที่ส่งข้อมูลล่าสุดอยู่ด้านบน</small></div>
                            <div class="pull-right tableTools-container"></div>
                        </div>

                        <table class="table table-main table-bordered dynamic-table" id="dynamic-table">
                            <thead>

                            <tr>
                                <th> #</th>
                                <th> รหัสสถานพยาบาล</th>
                                <th> โรงพยาบาล</th>
                                <th> จังหวัด</th>
                                <th> ส่งข้อมูลล่าสุดเมื่อ</th>
                                <th> วัน</th>
                            </tr>
                            </thead>
                            <tbody class="table-striped">

                            @foreach($hospData as $item )
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>{{ $item->hosp ?? "" }}</td>
                                    <td>{{ $item->hospname ?? "" }}</td>
{{--                                    <td> {{ $item->inp_src ?? "" }} | {{ $item->inp_id ?? "" }}--}}
{{--                                        | {{ $item->prename ?? "" }}  </td>--}}
                                    <td> {{ $item->changwat ?? "" }}   </td>
                                    <td> {{ $item->hosp_last_update ?? "" }}   </td>
                                    <td>
                                        {{ $item->dif ?? "" }}
{{--                                        @auth()--}}
{{--                                            <a href="{{url('tracking_detail/'.$item->hosp.'/'.date('Y'))}}"--}}
{{--                                               target="_blank">--}}
{{--                                                <button class="btn btn-white btn-info btn-bold">--}}
{{--                                                    <i class="ace-icon fa fa-search bigger-120 blue"></i>--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endauth--}}

                                    </td>
                                </tr>
                            @endforeach
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






        })
    </script>


@endsection
