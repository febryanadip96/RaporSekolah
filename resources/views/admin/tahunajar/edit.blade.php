@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tahun Ajar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-calendar"></i> Tahun Ajar</li>
        <li><a href="{{url('admin/tahunajar')}}">Tahun Ajar</a></li>
        <li class="active">Tahun Ajar (Edit)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Data Tahun Ajar</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/tahunajar/'.$tahunAjar->id)}}" method="post">
            {{ csrf_field() }}
              {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Tahun Ajar" value="{{$tahunAjar->nama}}" required>
              </div>
              <div class="form-group">
                <label for="total_hari_efektif">Total Hari Efektif</label>
                <input type="number" name="total_hari_efektif" class="form-control" id="total_hari_efektif" placeholder="Total Hari Efektif" value="{{$tahunAjar->total_hari_efektif}}" required>
              </div>
			  <!-- Date -->
			  <div class="form-group">
				<label>Tanggal Tutup:</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="tutup" class="form-control pull-right datepicker" value="{{date('m/d/Y',strtotime($tahunAjar->tutup))}}" required>
				</div>
				<!-- /.input group -->
			  </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <a class="update-modal btn btn-warning">Simpan</a>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
