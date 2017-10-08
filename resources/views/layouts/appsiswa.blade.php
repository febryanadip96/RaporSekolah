<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rapor</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/skin-red.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- jQuery 3 -->
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- DataTables -->
	<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('js/adminlte.min.js') }}"></script>
	<!-- page script -->

</head>
<body class="sidebar-mini skin-red layout-top-nav">
	<div id="app">
		<div class="wrapper">
			<header class="main-header">
		      <nav class="navbar navbar-static-top">
		        <div class="container">
		          <div class="navbar-header">
					  <a class="navbar-brand">SMP KARTIKA NASIONAL PLUS</a>

		          </div>

		          <!-- Navbar Right Menu -->
				  <div class="navbar-custom-menu">
			        <ul class="nav navbar-nav">
			          <!-- User Account: style can be found in dropdown.less -->
			          <!-- Authentication Links -->
			            @if (Auth::guest())
			                <li><a href="{{ route('login') }}">Login</a></li>
			            @else
			                <li class="dropdown">
			                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			                        {{ Auth::user()->name }} <span class="caret"></span>
			                    </a>

			                    <ul class="dropdown-menu" role="menu">
			                        <li>
			                            <a href="{{ route('logout') }}"
			                                onclick="event.preventDefault();
			                                         document.getElementById('logout-form').submit();">
			                                Logout
			                            </a>

			                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                                {{ csrf_field() }}
			                            </form>
			                        </li>
			                    </ul>
			                </li>
			            @endif
			        </ul>
			      </div>
		          <!-- /.navbar-custom-menu -->
		        </div>
		        <!-- /.container-fluid -->
		      </nav>
		    </header>

		  @yield('content')


		  <footer class="main-footer">
		    <div class="pull-right hidden-xs">
		      RAPOR SMP KARTIKA NASIONAL
		    </div>
		  </footer>
		</div>
		<!-- ./wrapper -->
	</div>
	<script>
	  $(function () {
	    $('.table').DataTable({
	      "aoColumnDefs": [
	          { 'bSortable': false, 'aTargets': ['no-sort'] }
	      ]
	    });
	  });
	</script>
</body>
</html>
