<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href='' class ='brand-link'>
      <img src="dist/img/LOGO.jpg" alt="DeskHelp Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HelpDesk</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Authentication Links -->
  @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                          @else 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"> {{Auth::user()->name}}</a>
        </div>
      </div>
      @endguest

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <li class="nav-item">
            <a href="{{route('profile')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          
  @auth
       <!-- issues -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Issues
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('createIssue')}}" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>New Issue</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('allIssues')}}" class="nav-link">
                  <i class="far fa-flag nav-icon"></i>
                  <p>Reported issues</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('myissues') }}" class="nav-link">
                  <i class="far fa-bookmark nav-icon"></i>
                  <p>My Issues</p>
                </a>
              </li>
  @if(Auth::user()->role === "member" )
  <li class="nav-item">
                <a href="{{ route('assignedIssues') }}" class="nav-link">
                  <i class="far fa-clipboard nav-icon"></i>
                  <p>Assigned Issues</p>
                </a>
              </li>
  @endif
               </ul>
          </li>
  <!-- Teams -->
  @if(Auth::user()->role === "admin")
  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Teams
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('createTeam' )}}" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>New Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('allTeams')}}" class="nav-link">
                  <i class="far fa-address-book nav-icon"></i>
                  <p>All Teams</p>
                </a>
              </li>
            </ul>
          </li>
  @endif 
  @if(Auth::user()->role === "admin" || Auth::user()->role === "team-admin")
  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
    @if(Auth::user()->role === "admin")
              <li class="nav-item">
                <a href="{{ route('createUser' )}}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>  New User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('allUsers')}}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>  All Users</p>
                </a>
              </li>
    @elseif(Auth::user()->role === "team-admin")
    <li class="nav-item">
                <a href="{{ route('allUsers')}}" class="nav-link">
                  <i class="fas fa-address-book nav-icon"></i>
                  <p>Team Members</p>
                </a>
              </li>
    @endif
            </ul>
          </li>
  @endif
  @endauth
         
          <!-- Logout got it from navbar.blade.php -->
          <li class="nav-item">
                 <a class="nav-link" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="fas fa-power-off nav-icon"></i>
                      <p>{{ __('Logout') }}</p>
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @yield('content')
   

</div>
<div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1 A/Z
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions =  {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
          ticks: {
          beginAtZero: true // option pour que l'axe y commence à 0
            }
        }]
      },
      tooltips: { // option pour l'affichage des données en pop-up lors du survol de la souris
    mode: 'index',
    intersect: false,
      },
    }
    var lineChartData = {
      labels: [
          'severity_1',
          'severity_2',
          'severity_3',
          'severity_4',
          'severity_5',
          'severity_6',
          'severity_7',
          'severity_8',
          'severity_9',
          'severity_10',
      ],
      datasets: [
        {
          label               : 'Issues',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : 5,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [{{$sev_don_1}},{{$sev_don_2}},{{$sev_don_3}},{{$sev_don_4}},{{$sev_don_5}},{{$sev_don_6}},{{$sev_don_7}},{{$sev_don_8}},{{$sev_don_9}},{{$sev_don_10}}],
        },
      ]}
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false;

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = {
      labels  : ['Open', 'Closed'],
      datasets: [
        {
          label               : 'Issues',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{$op_data_bar}}, {{$cd_data_bar}}]
        },
      ]
    }
    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
          ticks: {
           beginAtZero: true // option pour que l'axe x commence à 0
           }
        }],
        yAxes: [{
          stacked: true,
          ticks: {
          beginAtZero: true // option pour que l'axe y commence à 0
            }
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
</div>

</body>
</html>
