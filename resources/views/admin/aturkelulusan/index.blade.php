@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atur Kelulusan
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Kelas</li>
        <li class="active">Atur Kelulusan</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tabel Kelas Buka Semester Ini</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Tahun Ajar</th>
                  <th>Wali Kelas</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($kelasBukas as $index => $kelasBuka)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$kelasBuka->nama}}</td>
                    <td>{{$kelasBuka->kelas->tingkat}}</td>
                    <td>{{$kelasBuka->tahunAjar->nama}}</td>
                    <td>{{$kelasBuka->waliKelas->user->name}} ({{$kelasBuka->waliKelas->nik}})</td>
                    <td><a data-toggle="tooltip" title="Atur Kelulusan" class="btn btn-default btn-xs" href="{{url('admin/aturkelulusan/'.$kelasBuka->id)}}"><span class="fa fa-gear"></span></a>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
