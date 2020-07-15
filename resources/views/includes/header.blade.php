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
                @guest


                    <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ace-icon fa fa-info-circle bigger-110"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-light-blue dropdown-caret">


                                    <li>
                                        <a href="#">
                                            Username : รหัสโรงพยาบาล <Br>
                                                Password : รหัสจังหวัดภาษาอังกฤษ 3หลัก ตามด้วยรหัสโรงพยาบาล
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <a href="https://th.wikipedia.org/wiki/รายชื่ออักษรย่อของจังหวัดในประเทศไทย"
                                               target="_blank"> รหัสจังหวัดภาษาอังกฤษ 3หลัก (wiki) </a>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                        <form class="navbar-form navbar-left form-search" method="POST" action="{{ route('login') }}"
                              role="search">
                            @csrf
                            @error('username')
                            <span class="invalid-feedback white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            <div class="form-group">
                                <input id="username" type="text"
                                       class="form-control  @error('name')   @enderror" name="username"
                                       value="{{ old('username') }}" required  autofocus placeholder="username">

                            </div>

                            <div class="form-group">
                                <input id="password" type="password"
                                       class="form-control @error('password')   @enderror" name="password"
                                       required  placeholder="password">

                            </div>


                            <button type="submit" class="btn btn-mini btn-info2">
                                <i class="ace-icon 	fa fa-check icon-only bigger-110"></i>
                            </button>
                        </form>
                    </nav>


                    <li class=" dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo"
                                 src="https://dv.lnwfile.com/_/dv/_raw/l6/as/cc.png"
                                 alt=""/>

                            <span class="user-info">
                                <small>ยินดีต้อนรับ, </small>
                            Guest
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                @endguest

                @auth


                    <li class="dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle"  >
                            <img class="nav-user-photo"
                                 src="https://dv.lnwfile.com/_/dv/_raw/l6/as/cc.png"
                                 alt=""/>

                            <span class="user-info">
                                <small>ยินดีต้อนรับ, </small>
{{Auth::user()->name}}
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                <li class="divider"></li>


                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-hospital-o"></i>
                                        @if(Auth::user()->type=='1')
                                            กองป้องกันการบาดเจ็บ
                                        @elseif(Auth::user()->type=='2')
                                            สคร. {{Auth::user()->province}}
                                        @elseif(Auth::user()->type=='3')
                                            สสจ. {{Auth::user()->province}}
                                        @elseif(Auth::user()->type=='4')
                                            โรงพยาบาล  {{Auth::user()->hospcode}}
                                        @endif

                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('')}}">
                                        <i class="ace-icon fa fa-exchange"></i>
                                        ไปถัง IS ส่วนกลาง (สป.)
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('')}}">
                                        <i class="ace-icon fa fa-exchange"></i>
                                         ไปถัง IS DIP
                                    </a>
                                </li>


                                <li>
                                    <a href="{{url('/logout')}}">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        ออกจากระบบ
                                    </a>
                                </li>
                            </ul>

                        </a>

                @endauth
            </ul>


        </div>


    </div><!-- /.navbar-container -->
</div>




{{--<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">--}}

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <img src="https://dv.lnwfile.com/_/dv/_raw/l6/as/cc.png" width="70%">
    </div>


    <ul class="nav nav-list">

        {{--        <li class="active open hover">--}}
        <li class="hover {{ Request::is('home','/') ? 'active open' : '' }}">
            <a href="{{url('home')}}">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> เกี่ยวกับระบบ </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li >
            <br>
        </li>

        <li class="center">
            <a > <span class="menu-text bolder">----IS ส่วนกลาง (สป.)----</span>
            </a>
        </li>


        <li class="hover {{ Request::is('overview*') ? 'active open' : '' }}">
            <a href="{{url('overview')}}">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text"> ภาพรวมข้อมูล </span>
            </a>

            <b class="arrow"></b>
        </li>




        <li class="hover {{ Request::is('tracking*') ? 'active open' : '' }}">
            <a href="{{url('tracking')}}">
                <i class="menu-icon fa fa-exchange"></i>
                <span class="menu-text"> ติดตามข้อมูล </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('check_error*') ? 'active open' : '' }}">
            <a href="{{url('check_error')}}">
                <i class="menu-icon fa fa-database"></i>
                <span class="menu-text"> ตรวจสอบข้อมูลผิดพลาด </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('check_duplicate*') ? 'active open' : '' }}">
            <a href="{{url('check_duplicate')}}">
                <i class="menu-icon fa fa-database"><i class="menu-icon fa fa-database"></i></i>
                <span class="menu-text"> ตรวจสอบข้อมูลซ้ำ </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li >
            <br>
        </li>

        <li class=" center">
            <a > <span class="menu-text bolder">----IS DIP----</span>
            </a>
        </li>

        <li class="hover {{ Request::is('is_import') ? 'active open' : '' }}">
            <a href="{{url('is_import')}}">
                <i class="menu-icon fa fa-download"></i>
                <span class="menu-text">Import ข้อมูล </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('is_rawdata') ? 'active open' : '' }}">
            <a href="{{url('is_rawdata')}}">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> ข้อมูลดิบที่ Import  </span>
            </a>

            <b class="arrow"></b>
        </li>





        <li class="hover {{ Request::is('overview*') ? 'active open' : '' }}">
            <a href="{{url('overview')}}">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text"> ภาพรวมข้อมูล </span>
            </a>

            <b class="arrow"></b>
        </li>




        <li class="hover {{ Request::is('tracking*') ? 'active open' : '' }}">
            <a href="{{url('tracking')}}">
                <i class="menu-icon fa fa-exchange"></i>
                <span class="menu-text"> ติดตามข้อมูล </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('check_error*') ? 'active open' : '' }}">
            <a href="{{url('check_error')}}">
                <i class="menu-icon fa fa-database"></i>
                <span class="menu-text"> ตรวจสอบข้อมูลผิดพลาด </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="hover {{ Request::is('check_duplicate*') ? 'active open' : '' }}">
            <a href="{{url('check_duplicate')}}">
                <i class="menu-icon fa fa-database"><i class="menu-icon fa fa-database"></i></i>
                <span class="menu-text"> ตรวจสอบข้อมูลซ้ำ </span>
            </a>

            <b class="arrow"></b>
        </li>



        <li >
            <br>
        </li>

        @auth()

            @if(Auth::user()->type=='1')

                <li class="hover {{ Request::is('user') ? 'active open' : '' }}">
                    <a href="{{url('user')}}">
                        <i class="menu-icon fa fa-user"></i>
                        <span class="menu-text"> จัดการข้อมูลผู้ใช้งาน </span>
                    </a>

                    <b class="arrow"></b>
                </li>
            @endif

        @endauth




        <li class="hover {{ Request::is('contact') ? 'active open' : '' }}">
            <a href="{{url('contact')}}">
                <i class="menu-icon fa fa-info-circle"></i>
                <span class="menu-text"> สอบถามข้อมูลเพิ่มเติม </span>
            </a>

            <b class="arrow"></b>
        </li>

        @guest()
            <li class="hover {{ Request::is('login') ? 'active open' : '' }}">
                <a href="{{url('login')}}">
                    <i class="menu-icon fa fa-key"></i>
                    <span class="menu-text"> เข้าสู่ระบบ </span>
                </a>

                <b class="arrow"></b>
            </li>
        @endguest





    </ul><!-- /.nav-list -->




        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

</div>


