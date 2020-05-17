<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="fa fa-edit"></i>
                    IS Checking (อยู่ในระหว่างการพัฒนา)
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">


            <ul class="nav ace-nav">


                    <li class=" dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo"
                                 src="https://dv.lnwfile.com/_/dv/_raw/l6/as/cc.png"
                                 alt="" />

                            <span class="user-info">
                                <small>ยินดีต้อนรับ, </small>
Guest
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                    </li>
            </ul>


        </div>



    </div><!-- /.navbar-container -->
</div>

<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
      <img src="https://dv.lnwfile.com/_/dv/_raw/l6/as/cc.png" width="50">
    </div>



    <ul class="nav nav-list">

{{--        <li class="active open hover">--}}
        <li class="hover {{ Request::is('home') ? 'active open' : '' }}">
            <a href="{{url('home')}}">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> เกี่ยวกับระบบ </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="hover {{ Request::is('check_error') ? 'active open' : '' }}">
            <a href="{{url('check_error')}}">
                <i class="menu-icon fa fa-database"></i>
                <span class="menu-text"> ตรวจสอบข้อมูลผิดพลาด </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('check_duplicate') ? 'active open' : '' }}">
            <a href="{{url('check_duplicate')}}">
                <i class="menu-icon fa fa-database"><i class="menu-icon fa fa-database"></i></i>
                <span class="menu-text"> ตรวจสอบข้อมูลซ้ำ </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="hover {{ Request::is('contact') ? 'active open' : '' }}">
            <a href="{{url('contact')}}">
                <i class="menu-icon fa fa-info-circle"></i>
                <span class="menu-text"> สอบถามข้อมูลเพิ่มเติม </span>
            </a>

            <b class="arrow"></b>
        </li>



</ul><!-- /.nav-list -->
</div>
