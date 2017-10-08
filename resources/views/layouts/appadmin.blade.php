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
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/skin-blue.min.css') }}">

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
    <!-- Select2 -->
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- page script -->
	
</head>
<body class="sidebar-mini skin-blue">
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
		                            <a href="{{ url('admin/profile/'.Auth::user()->id).'/edit' }}">Profile</a>
		                        </li>
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
		        <li class="{{active(['admin/home'])}}">
		          <a href="{{url('admin/home')}}">
		            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
		          </a>
		        </li>
		        <li class="{{active(['admin/identitas'])}}">
		          <a href="{{url('admin/identitas')}}">
		            <i class="fa fa-bank"></i> <span>Identitas Sekolah</span>
		          </a>
		        </li>
		        <li class="treeview {{active(['admin/tahunajar','admin/tahunajar/*','admin/semester','admin/semester/*'])}}">
		          <a href="#">
		            <i class="fa fa-calendar"></i>
		            <span>Tahun Ajar</span>
		            <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="{{active(['admin/tahunajar','admin/tahunajar/*'])}}"><a href="{{url('admin/tahunajar')}}"><i class="fa fa-circle-o"></i> Tahun Ajar</a></li>
		            <li class="{{active(['admin/semester','admin/semester/*'])}}"><a href="{{url('admin/semester')}}"><i class="fa fa-circle-o"></i> Semester</a></li>
		          </ul>
		        </li>
		        <li class="treeview {{active(['admin/karyawan','admin/karyawan/*','admin/gurukeluar','admin/gurukeluar/*','admin/siswa','admin/siswa/*','admin/keluarpindah','admin/keluarpindah/*'])}}">
		          <a href="#">
		            <i class="fa fa-users"></i>
		            <span>Anggota</span>
		            <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="{{active(['admin/karyawan','admin/karyawan/*'])}}"><a href="{{url('admin/karyawan')}}"><i class="fa fa-circle-o"></i> Karyawan</a></li>
		            <li class="{{active(['admin/siswa','admin/siswa/*'])}}"><a href="{{url('admin/siswa')}}"><i class="fa fa-circle-o"></i> Siswa</a></li>
		            <li class="{{active(['admin/keluarpindah','admin/keluarpindah/*'])}}"><a href="{{url('admin/keluarpindah')}}"><i class="fa fa-circle-o"></i> Siswa Keluar/Pindah</a></li>
		            <li class="{{active(['admin/gurukeluar','admin/gurukeluar/*'])}}"><a href="{{url('admin/gurukeluar')}}"><i class="fa fa-circle-o"></i> Karyawan Keluar</a></li>
		          </ul>
		        </li>
		        <li class="treeview {{active(['admin/kelas','admin/kelas/*','admin/kelasbuka','admin/kelasbuka/*','admin/aturkelulusan','admin/aturkelulusan/*','admin/kelompok','admin/kelompok/*','admin/mapel','admin/mapel/*','admin/kelompok/*','admin/mapelbuka','admin/mapelbuka/*','admin/pengajar','admin/pengajar/*','admin/aturkelas','admin/aturkelas/*','admin/kd','admin/kd/*','admin/daftarsiswamapel','admin/daftarsiswamapel/*'])}}">
		          <a href="#">
		            <i class="fa fa-book"></i>
		            <span>Kelas</span>
		            <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="treeview {{active(['admin/kelas','admin/kelas/*','admin/kelasbuka','admin/kelasbuka/*','admin/aturkelas','admin/aturkelas/*','admin/aturkelulusan','admin/aturkelulusan/*'])}}">
		              <a href="#"><i class="fa fa-circle-o"></i> Kelas
		                <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		              </a>
		              <ul class="treeview-menu">
		                <li class="{{active(['admin/kelas','admin/kelas/*'])}}"><a href="{{url('admin/kelas')}}"><i class="fa fa-circle-o"></i> Kelas</a></li>
		                <li  class="{{active(['admin/kelasbuka','admin/kelasbuka/*','admin/aturkelas','admin/aturkelas/*'])}}"><a href="{{url('admin/kelasbuka')}}"><i class="fa fa-circle-o"></i> Kelas Buka</a></li>
		                <li  class="{{active(['admin/aturkelulusan','admin/aturkelulusan/*'])}}"><a href="{{url('admin/aturkelulusan')}}"><i class="fa fa-circle-o"></i> Atur Kelulusan</a></li>
		              </ul>
		            </li>
		            <li class="treeview {{active(['admin/kelompok','admin/kelompok/*','admin/mapel','admin/mapel/*','admin/kd','admin/kd/*','admin/mapelbuka','admin/mapelbuka/*','admin/daftarsiswamapel','admin/daftarsiswamapel/*'])}}">
		              <a href="#"><i class="fa fa-circle-o"></i> Mata Pelajaran
		                <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		              </a>
		              <ul class="treeview-menu">
		                <li class="{{active(['admin/kelompok','admin/kelompok/*'])}}"><a href="{{url('admin/kelompok')}}"><i class="fa fa-circle-o"></i> Kelompok Mapel</a></li>
		                <li class="{{active(['admin/mapel','admin/mapel/*'])}}"><a href="{{url('admin/mapel')}}"><i class="fa fa-circle-o"></i> Mapel</a></li>
		                <li class="{{active(['admin/kd','admin/kd/*'])}}"><a href="{{url('admin/kd')}}"><i class="fa fa-circle-o"></i> Kompetensi Dasar</a></li>
		                <li class="{{active(['admin/mapelbuka','admin/mapelbuka/*','admin/daftarsiswamapel','admin/daftarsiswamapel/*'])}}"><a href="{{url('admin/mapelbuka')}}"><i class="fa fa-circle-o"></i> Mapel Buka</a></li>
		              </ul>
		            </li>
		          </ul>
		        </li>
		        <li class="treeview {{active(['admin/predikat','admin/predikat/*','admin/ekskul','admin/ekskul/*','admin/peringkat','admin/peringkat/*','admin/pekerjaan','admin/pekerjaan/*','admin/ijazah','admin/ijazah/*','admin/kota','admin/kota/*','admin/sekolah','admin/sekolah/*'])}}">
		          <a href="#">
		            <i class="fa fa-hdd-o"></i>
		            <span>Data lain</span>
		            <span class="pull-right-container">
		                  <i class="fa fa-angle-left pull-right"></i>
		                </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="{{active(['admin/pekerjaan','admin/pekerjaan/*'])}}"><a href="{{url('admin/pekerjaan')}}"><i class="fa fa-circle-o"></i> Pekerjaan</a></li>
		            <li class="{{active(['admin/kota','admin/kota/*'])}}"><a href="{{url('admin/kota')}}"><i class="fa fa-circle-o"></i> Kota</a></li>
		            <li class="{{active(['admin/sekolah','admin/sekolah/*'])}}"><a href="{{url('admin/sekolah')}}"><i class="fa fa-circle-o"></i> Sekolah</a></li>
		            <li class="{{active(['admin/predikat','admin/predikat/*'])}}"><a href="{{url('admin/predikat')}}"><i class="fa fa-circle-o"></i> Predikat</a></li>
		            <li class="{{active(['admin/ekskul','admin/ekskul/*'])}}"><a href="{{url('admin/ekskul')}}"><i class="fa fa-circle-o"></i> Ekstrakulikuler</a></li>
		            <li class="{{active(['admin/peringkat','admin/peringkat/*'])}}"><a href="{{url('admin/peringkat')}}"><i class="fa fa-circle-o"></i> Peringkat</a></li>
		            <li class="{{active(['admin/ijazah','admin/ijazah/*'])}}"><a href="{{url('admin/ijazah')}}"><i class="fa fa-circle-o"></i> Ijazah</a></li>

		          </ul>
		        </li>
		      </ul>
		    </section>
		    <!-- /.sidebar -->
		  </aside>

		    <!-- content -->
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
    //Initialize Select2 Elements
    $('.select2').select2();

    $('.table-hover').DataTable({
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': ['no-sort'] }
      ]
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });

    $('.alert').slideDown(500, function(){
          setTimeout(function(){
              $(".alert").slideUp(500);
          },5000);
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
    //Date range picker with time picker
    $('.daterange').daterangepicker({timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
      });
    //Date range as a button
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });
		$('[data-toggle="tooltip"]').tooltip();
  });
</script>
</body>
</html>
