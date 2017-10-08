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
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/skin-green.min.css') }}">

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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- page script -->
	
</head>
<body class="sidebar-mini skin-green">
	<div id="app">
		<div class="wrapper">

		  <header class="main-header">
		    <!-- Logo -->
		    <a class="logo">
		      <!-- mini logo for sidebar mini 50x50 pixels -->
		      <span class="logo-mini"><b>SKN</b></span>
		      <!-- logo for regular state and mobile devices -->
		      <span class="logo-lg">SMP Kartika Nasional</span>
		    </a>
		    <!-- Header Navbar: style can be found in header.less -->
		    <nav class="navbar navbar-static-top">
		      <!-- Sidebar toggle button-->
		      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>

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
		    </nav>
		  </header>
		  <!-- Left side column. contains the logo and sidebar -->
		  <aside class="main-sidebar">
		    <!-- sidebar: style can be found in sidebar.less -->
		    <section class="sidebar">
		      <!-- Sidebar user panel -->

		      <!-- sidebar menu: : style can be found in sidebar.less -->
		      <ul class="sidebar-menu" data-widget="tree">
		        <li class="header">NAVIGASI</li>
		        <li class="{{active(['guru/home'])}}">
		          <a href="{{url('guru/home')}}">
		            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
		          </a>
		        </li>
		        <li class="{{active(['guru/walikelas','guru/walikelas/*'])}}">
		          <a href="{{url('guru/walikelas')}}">
		            <i class="fa fa-mortar-board"></i> <span>Wali Kelas</span>
		          </a>
		        </li>
		        <li class="{{active(['guru/matapelajaran','guru/matapelajaran/*'])}}">
		          <a href="{{url('guru/matapelajaran')}}">
		            <i class="fa fa-book"></i> <span>Mata Pelajaran</span>
		          </a>
		        </li>
		      </ul>
		    </section>
		    <!-- /.sidebar -->
		  </aside>

		  @yield('content')

		  <div class="modal modal-warning fade" id="update-confirm">
		      <div class="modal-dialog">
		          <div class="modal-content">
		              <div class="modal-header">
		                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                  <h4 class="modal-title">Konfirmasi Perubahan</h4>
		              </div>
		              <div class="modal-body">
		                  <p>Anda yakin ingin mengubah data ini?</p>
		              </div>
		              <div class="modal-footer">
		                  <button type="button" class="btn btn-outline pull-left" id="update-btn">Ya</button>
		                  <button type="button" class="btn btn-outline" data-dismiss="modal">Batal</button>
		              </div>
		          </div>
		      </div>
		  </div>

		  <div class="modal modal-danger fade" id="delete-confirm">
		      <div class="modal-dialog">
		          <div class="modal-content">
		              <div class="modal-header">
		                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                  <h4 class="modal-title">Konfirmasi Penghapusan</h4>
		              </div>
		              <div class="modal-body">
		                  <p>Anda yakin ingin menghapus data ini?</p>
		              </div>
		              <div class="modal-footer">
		                  <button type="button" class="btn btn-outline pull-left" id="delete-btn">Ya</button>
		                  <button type="button" class="btn btn-outline" data-dismiss="modal">Batal</button>
		              </div>
		          </div>
		      </div>
		  </div>

		  <footer class="main-footer">
		    <div class="pull-right hidden-xs">

		    </div>
		    <strong>@RAPOR SMP KARTIKA NASIONAL</strong>
		  </footer>
		</div>
		<!-- ./wrapper -->
	</div>
	<script>
	  $(function () {
	    $('.table-hover').DataTable({
	      "aoColumnDefs": [
	          { 'bSortable': false, 'aTargets': ['no-sort'] }
	      ]
	    });
	    $('.alert').slideDown(500, function(){
	          setTimeout(function(){
	              $(".alert").slideUp(500);
	          },5000);
	    });
	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass   : 'iradio_minimal-blue'
	    });

	    $('.update-modal').on('click', function(e){
	        var $form=$(this).parents('form:first');
	        $('#update-confirm').modal({ backdrop: 'static', keyboard: false })
	            .on('click', '#update-btn', function(){
	                $form.submit();
	            });
	    });
	    $('.delete-modal').on('click', function(e){
	        var $form=$(this).parents('form:first');
	        $('#delete-confirm').modal({ backdrop: 'static', keyboard: false })
	            .on('click', '#delete-btn', function(){
	                $form.submit();
	            });
	    });
	    //Date picker
	    $('#datepicker').datepicker({
	      autoclose: true
	    });
	    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
	    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	        // save the latest tab; use cookies if you like 'em better:
	        localStorage.setItem('lastTab', $(this).attr('href'));
	    });
			$('[data-toggle="tooltip"]').tooltip();
	    // go to the latest tab, if it exists:
	    var lastTab = localStorage.getItem('lastTab');
	    if (lastTab) {
	        $('[href="' + lastTab + '"]').tab('show');
	    }
	  });
	</script>
</body>
</html>
