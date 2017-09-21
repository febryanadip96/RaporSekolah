@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mata Pelajaran
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Mata Pelajaran</li>
        <li class="active">Mata Pelajaran</li>
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
              <h3 class="box-title">Mata Pelajaran</h3>
              <a class="btn btn-success pull-right" href="{{url('admin/mapel/create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Keterangan</th>
                  <th>Kelas</th>
                  <th>Jenis</th>
                  <th>Kelompok</th>
                  <th>Urutan</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($mapels as $index => $mapel)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$mapel->nama}}</td>
                    <td>{{$mapel->keterangan}}</td>
                    <td>{{$mapel->kelas->tingkat}}</td>
                    <td>@if($mapel->jenis==0) Umum @else Khusus @endif</td>
                    <td>{{$mapel->kelompok->nama}}</td>
                    <td>{{$mapel->urutan}}</td>
                    <td><a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/mapel/'.$mapel->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
