<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework"> --}}
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('page-title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/adminLTE/plugins/images/favicon.png">
    <link href="/adminLTE/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/adminLTE/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link href="/adminLTE/css/style.min.css" rel="stylesheet">
    {{-- <link href="/adminLTE/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="/adminLTE/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        /** make all button fonts capital*/
        .btn {
         text-transform: uppercase !important; 
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgb(223, 230, 233);
        }
            /** Lower height of cell*/
            .table td, .table th {
            padding: .3rem;
        }
            /**Center table cells*/
            .table td, .table th {
            text-align: center;
        }
            /**Center table header*/
            .table thead tr th {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="/adminLTE/plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="/adminLTE/plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <li>
                            <a class="profile-pic" href="#">
                                <img src="/adminLTE/plugins/images/users/d3.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">ADMIN</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
       
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('database_storage.index') }}"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Databases</span>
                            </a>
                        </li>

                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('database_storage.create') }}"
                                aria-expanded="false">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="hide-menu">Add Database</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('profile.index')  }}"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backup_history_all')  }}"
                                aria-expanded="false">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                <span class="hide-menu">Backup History</span>
                            </a>
                        </li>
                        
                        
                        {{-- <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/ampleadmin/"
                                class="btn d-grid btn-danger text-white" target="_blank">
                               Logout</a>
                        </li> --}}
                        <li class="text-center p-20 upgrade-btn">
                            <a class="btn d-grid btn-danger text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                            </form>
                        </li>
                    </ul>

                </nav>
                
            </div>
            
        </aside>
        
        <div class="page-wrapper">
           
            <div class="container-fluid">
                @yield('main')
            </div>
            
        </div>
        
    </div>
    
    <script src="/adminLTE/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    

    <!-- Bootstrap tether Core JavaScript -->
    <script src="/adminLTE/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/adminLTE/js/app-style-switcher.js"></script>
    <script src="/adminLTE/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="/adminLTE/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/adminLTE/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/adminLTE/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="/adminLTE/plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="/adminLTE/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="/adminLTE/js/pages/dashboards/dashboard1.js"></script>
    <script src="/adminLTE/js/jquery.dataTables.min.js"></script>
    <script src="/adminLTE/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>