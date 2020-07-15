<!doctype html>
<html>
<head>

    @include('includes.head')

</head>
<body class="no-skin" onload="myHide();">

    @include('includes.header')

{{--    <div class="main-container ace-save-state" id="main-container">

<div class="main-content">--}}

    <div class="main-content">
        <div class="main-content-inner">


    <div class="page-content">

        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('assets/images/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>

        <div id="hidepage" style="display:none;">
            <table>
                <tr><td></td></tr>
            </table>
        </div>



        @yield('content')

        <footer>
            @include('includes.footer')
        </footer>

    </div><!-- /.page-content -->

</div><!-- /.main-content -->





    </div>

    </div>


    @yield('js_low')



    <!--[if !IE]> -->
    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js')}}"></script>

    <!-- <![endif]-->

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{ URL::asset('assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
    </script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- page specific plugin scripts -->
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.select.min.js')}}"></script>



    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{ URL::asset('assets/js/jquery-ui.custom.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/chosen.jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/spinbox.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/moment.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/daterangepicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.knob.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/autosize.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.inputlimiter.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-tag.min.js')}}"></script>



    <!-- ace scripts -->
    <script src="{{ URL::asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/ace.min.js')}}"></script>

    <script>
        $('.chosen').chosen();

    </script>

</body>
</html>
