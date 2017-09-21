@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pekerjaan
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-hdd-o"></i> Data Lain</li>
        <li class="active">Pekerjaan</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-8">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Tabel Pekerjaan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($pekerjaans as $index => $pekerjaan)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$pekerjaan->nama}}</td>
                  <td><a class="btn btn-warning btn-xs" href="{{url('admin/pekerjaan/'.$pekerjaan->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-4">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Pekerjaan Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/pekerjaan')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
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
