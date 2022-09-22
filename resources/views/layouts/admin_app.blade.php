<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Panel</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/fav.png')}}">
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')}}" rel="stylesheet" type="text/css">
        <!-- DataTables css -->
    <link href="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="{{asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- apex css -->
    {{-- <link href="{{asset('admin/assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
    <!-- jvectormap css -->
    <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"> --}}
    {{-- <!-- Slick css -->
    <link href="{{asset('admin/assets/plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/slick/slick-theme.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">


     <style>
        .dataTables_info, .dataTables_length,.dataTables_paginate{
            display: none;
        }

        .logout-mobile{
            display: none;
        }


        @media (max-width: 600px) {
        .logobar ,.logout{
            display: none;
        }
        .logout-mobile{
            display: block;
        }
    }
    </style>
    <!-- End css -->
</head>
<body class="horizontal-layout">
    <!-- Start Infobar Setting Sidebar -->
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="{{asset('admin/assets/images/svg-icon/close.svg')}}" class="img-fluid menu-hamburger-close" alt="close"></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Payment Reminders</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Stock Updates</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Open for New Products</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Enable SMS</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Newsletter Subscription</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Show Map</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">e-Statement</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8"><h6 class="mb-0">Monthly Report</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar" class="">
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="/" class="mobile-logo"><img src="{{asset('assets/img/biport-logo.png')}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="{{asset('admin/assets/images/svg-icon/horizontal.svg')}}" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="{{asset('admin/assets/images/svg-icon/verticle.svg')}}" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                            <img src="{{asset('admin/assets/images/svg-icon/collapse.svg')}}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="{{asset('admin/assets/images/svg-icon/close.svg')}}" class="img-fluid menu-hamburger-close" alt="close">
                                        </a>
                                     </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            {{-- <div class="topbar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12 align-self-center">
                            <div class="togglebar">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="logobar">
                                            <a href="{{route('admin.home')}}" class="logo logo-large"><img src="{{asset('admin/assets/images/biport-logo1.svg')}}" class="img-fluid" alt="logo"></a>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">

                                    </li>
                                </ul>
                            </div>
                            <div class="infobar">
                                <ul class="list-inline mb-0">

                                    <li class="list-inline-item">
                                        <div class="profilebar">
                                            <div class="dropdown">
                                              <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('admin/assets/images/users/profile.svg')}}" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                    <div class="dropdown-item">
                                                        <div class="profilename">
                                                            @if(Auth::check())
                                                          <h5>{{Auth::user()->FullName}}</h5>
                                                          @endif
                                                        </div>
                                                    </div>
                                                    <div class="userbox">
                                                        <ul class="list-unstyled mb-0">
                                                            @if (Auth::check())


                                                            <li class="media dropdown-item">
                                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="profile-icon"><img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid" alt="logout"
                                                                    >Logout</a>
                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item menubar-toggle">
                                        <div class="menubar">
                                            <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                                <img src="{{asset('admin/assets/images/svg-icon/collapse.svg')}}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                                <img src="{{asset('admin/assets/images/svg-icon/close.svg')}}" class="img-fluid menu-hamburger-close" alt="close">
                                            </a>
                                         </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}
            <!-- End Topbar -->
            <!-- Start Navigationbar -->
            <div class="navigationbar" style="top:0;z-index:999">

                <!-- Start container-fluid -->
                <div class="">
                    <!-- Start Horizontal Nav -->
                    <nav class="horizontal-nav mobile-navbar fixed-navbar">
                        <div class="collapse navbar-collapse" id="navbar-menu">
                            <ul class="horizontal-menu">
                                @if(Auth::check())
                                @if(Auth::user()->is_admin == 1)
                              <li class="list-inline-item mr-3">
                                  <div class="logobar">
                                      <a href="{{route('admin.home')}}" class="logo logo-large"><img src="{{asset('assets/img/biport-logo1.png')}}" class="img-fluid" alt="logo"></a>
                                  </div>
                              </li>
                            <!-- <li class="scroll">
                                <a href="{{route('admin.home')}}" class="{{ request()->is('admin/home') ? 'active' : '' }}" ><img src="{{asset('admin/assets/images/svg-icon/dashboard.svg')}}" class="img-fluid" alt="dashboard"><span>Dashboard</span></a>
                            </li> -->
                            <li class="{{ request()->is('admin/home') ||  request()->is('admin/profile')   ? ' dropdown active' : 'dropdown' }}">
                                <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/images/svg-icon/dashboard.svg')}}" class="img-fluid" alt="users"><span>Dashboard</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.home')}}">Dashboard</a></li>
                                    <li><a href="{{route('admin.profile')}}">Admin Profile</a></li>
                                </ul>
                            </li>


                            <li class="{{ request()->is('admin/users')   ? ' dropdown active' : 'dropdown' }}">
                                <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/images/svg-icon/user.svg')}}" class="img-fluid" alt="users"><span>Users</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.users')}}">All Users</a></li>
                                    <li><a href="{{route('admin.paidUsers')}}">Paid Users</a></li>
                                </ul>
                            </li>
                            <li class="scroll">
                                <a href="{{route('admin.investments')}}" class="{{ request()->is('admin/investments') ? 'active' : '' }}" ><img src="{{asset('admin/assets/images/svg-icon/widgets.svg')}}" class="img-fluid" alt="dashboard"><span>Users Investments</span></a>
                            </li>

                            <li class="{{ request()->is('admin/wallet') || request()->is('admin/walletDetails')  ? ' dropdown active' : 'dropdown' }}" >
                                <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/images/svg-icon/apps.svg')}}" class="img-fluid" alt="apps"><span>E Wallet</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.wallet')}}">E Send</a></li>
                                    <li><a href="{{route('admin.walletDetails')}}">E Details</a></li>
                                </ul>
                            </li>

                            <li class="{{ request()->is('admin/packages') ? ' dropdown active' : 'dropdown' }}" >
                                <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-inbox"></i><span>Package</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.packages')}}"> Activation Package</a></li>
                                    <li><a href="{{route('admin.investPackages')}}">Investment Packages</a></li>
                                </ul>
                            </li>
                            <li class="{{ request()->is('admin/pendingWithdraw') ||   request()->is('admin/confirmedWithdraw') ? 'dropdown active' : 'dropdown' }}" >
                                <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/images/svg-icon/basic.svg')}}" class="img-fluid" alt="apps"><span>Withdraw</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.pendingWithdraw')}}"> Pending Withdraw</a></li>
                                    <li><a href="{{route('admin.confirmWithdraw')}}">Confirmed Withdraw</a></li>
                                </ul>
                            </li>
                            <li class="scroll">
                                <a href="{{route('admin.transactions')}}" class="{{ request()->is('admin/transactions') ? 'active' : '' }}" ><i class="fa fa-stack-exchange"></i><span>Transactions</span></a>
                            </li>
                            <li class="{{ request()->is('admin/pending_queries') || request()->is('admin/resolved_queries')  ? ' dropdown active' : 'dropdown' }}" >
                                <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wechat"></i><span>Support</span></a>
                                <ul class="dropdown-menu " style="display: none; opacity: 1;">
                                    <li><a href="{{route('admin.queries')}}">Pending Queries</a></li>
                                    <li><a href="{{route('admin.resolved')}}">Resolved Queries</a></li>
                                </ul>
                            </li>

                            <li class="scroll logout-mobile">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="profile-icon"><img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid" alt="logout"
                                    >Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                            <li class="scroll logout " style="position: absolute;top:0;right:0;">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="profile-icon"><img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid" alt="logout"
                                    ></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>

                            @endif
                            @endif
                            {{-- <li class="list-inline-item logout " style="position: absolute;top:0;right:0;">
                                <div class="profilebar">
                                    <div class="dropdown">
                                      <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('admin/assets/images/users/profile.svg')}}" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="profilelink">
                                            <div class="userbox">
                                                <ul class="list-unstyled mb-0">
                                                    @if (Auth::check())


                                                    <li class="media dropdown-item">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="profile-icon"><img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid" alt="logout"
                                                            >Logout</a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                        </ul>

                        </div>
                    </nav>
                    <!-- End Horizontal Nav -->
                </div>
                <!-- End container-fluid -->
            </div>

            <main >
                @yield('content')
            </main>
            <div class="footerbar">
                <footer class="footer">
                    <p class="mb-0">© 2022 - All Rights Reserved.</p>
                </footer>
            </div>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-lang-js/3.0.0/jquery-lang.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-lang-js/3.0.0/langpack/nonDynamic.js"></script>
    <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/horizontal-menu.js')}}"></script>
    <!-- Switchery js -->
    <script src="{{asset('admin/assets/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/custom-form-select.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
    <!-- Datatable js -->
   <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/jszip.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/pdfmake.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/vfs_fonts.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/buttons.print.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
   <script src="{{asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/custom/custom-table-datatable.js')}}"></script>
    <!-- Apex js -->
    {{-- <script src="{{asset('admin/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
    <!-- Vector Maps js -->
    <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- Slick js -->
    <script src="{{asset('admin/assets/plugins/slick/slick.min.js')}}"></script>
    <!-- Dashboard js -->
    <script src="{{asset('admin/assets/js/custom/custom-dashboard-crypto.js')}}"></script> --}}
    <!-- Core js -->
    <script src="{{asset('admin/assets/js/core.js')}}"></script>

    <!-- End js -->
    <!-- Core js -->
</body>
</html>
