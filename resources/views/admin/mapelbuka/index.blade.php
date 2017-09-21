@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mapel Buka
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Mata Pelajaran</li>
        <li class="active">Mapel Buka</li>
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
              <h3 class="box-title">Tabel Mata Pelajaran Buka</h3>
              <a class="btn btn-success pull-right" href="{{url('admin/mapelbuka/create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pelajaran</th>
                  <th>Kelas</th>
                  <th>Pengajar</th>
                  <th>KKM</th>
                  <th>Umum/Khusus</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($mapelbukas as $index => $mapelbuka)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$mapelbuka->mataPelajaran->nama}}</td>
                    <td>{{$mapelbuka->kelasBuka->nama}} ({{$mapelbuka->kelasBuka->tahunAjar->nama}})</td>
                    <td>{{$mapelbuka->pengajar->user->name}}</td>
                    <td>{{$mapelbuka->kkm}}</td>
                    <td>@if($mapelbuka->mataPelajaran->jenis==0) Umum @else Khusus @endif</td>
                    <td><a data-toggle="tooltip" title="Daftar Siswa" class="btn btn-default btn-xs" href="{{url('admin/daftarsiswamapel/'.$mapelbuka->id)}}"><span class="fa fa-user-plus"></span></a> <a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/mapelbuka/'.$mapelbuka->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
