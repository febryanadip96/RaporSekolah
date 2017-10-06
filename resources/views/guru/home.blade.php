@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard active"></i> Dashboard</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
		  <div class="inner">
			<h4>
				@if($kelasWaliKelas!=null)
					{{$kelasWaliKelas->nama}} ({{$kelasWaliKelas->tahunAjar->nama}})
				@else
					Tidak Ada
				@endif
			</h4>

			<p>Wali Kelas</p>
		  </div>
		  <div class="icon">
			<i class="fa  fa-graduation-cap"></i>
		  </div>
		  <a href="{{url('guru/walikelas')}}" class="small-box-footer">
			Wali Kelas <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->

	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
		  <div class="inner">
			<h4>
				{{$jumlahMapelBuka}}
			</h4>

			<p>Mata Pelajaran</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-book"></i>
		  </div>
		  <a href="{{url('guru/matapelajaran')}}" class="small-box-footer">
			Mata Pelajaran <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
