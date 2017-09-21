@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelompok Mapel
      </h1>
      <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Kelas</li>
          <li>Mata Pelajaran</li>
        <li><a href="{{url('admin/kelompok')}}">Kelompok Mapel</a></li>
        <li class="active">Kelompok Mapel (Edit)</li>
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
            <h3 class="box-title">Ubah Data Kelompok Mapel</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/kelompok/'.$kelompok->id)}}" method="post">
            {{ csrf_field() }}
              {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="tingkat" placeholder="Nama kelompok mata pelajaran" value="{{$kelompok->nama}}" required>
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
