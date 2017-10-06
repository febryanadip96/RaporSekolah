@extends('layouts.appadmin')

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
				@if($semesterAktif!=null)
					@if($semesterAktif->gasal_genap) Gasal @else Genap @endif {{$semesterAktif->tahunAjar->nama}}
				@else
					Tidak Ada
				@endif
			</h4>

			<p>Semester Aktif</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-calendar"></i>
		  </div>
		  <a href="{{url('admin/tahunajar')}}" class="small-box-footer">
			Tahun Ajar <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->
	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
		  <div class="inner">
			<h4>{{$jumlahKaryawan}}</h4>

			<p>Karyawan Aktif</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-male"></i>
		  </div>
		  <a href="{{url('admin/karyawan')}}" class="small-box-footer">
			Karyawan <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->
	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-blue">
		  <div class="inner">
			<h4>{{$jumlahSiswa}}</h4>

			<p>Siswa Aktif</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-users"></i>
		  </div>
		  <a href="{{url('admin/siswa')}}" class="small-box-footer">
			Siswa <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->
	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
		  <div class="inner">
			<h4>{{$jumlahKelasBuka}}</h4>

			<p>Kelas Buka</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-university"></i>
		  </div>
		  <a href="{{url('admin/kelasbuka')}}" class="small-box-footer">
			Kelas Buka <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	  </div>
      <!-- /.col -->
	  <div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple">
		  <div class="inner">
			<h4>{{$jumlahMapelBuka}}</h4>

			<p>Mapel Buka</p>
		  </div>
		  <div class="icon">
			<i class="fa fa-book"></i>
		  </div>
		  <a href="{{url('admin/mapelbuka')}}" class="small-box-footer">
			Mapel Buka <i class="fa fa-arrow-circle-right"></i>
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
