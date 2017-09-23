@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelas Buka
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Kelas</li>
        <li class="active">Kelas Buka</li>
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
              <h3 class="box-title">Tabel Kelas Buka</h3>
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
                    <td>{{$kelasBuka->waliKelas->user->name}}</td>
                    <td><a data-toggle="tooltip" title="Daftar Siswa" class="btn btn-default btn-xs" href="{{url('admin/aturkelas/'.$kelasBuka->id)}}"><span class="fa fa-user-plus"></span></a> <a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/kelasbuka/'.$kelasBuka->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
            <h3 class="box-title">Data Kelas Buka Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/kelasbuka')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama kelas" required>
              </div>
              <div class="form-group">
                <label>Tingkat Kelas</label>
                <select name="kelas_id" class="form-control">
                  @foreach($kelas as $kelas1)
                    <option value="{{$kelas1->id}}">{{$kelas1->tingkat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tahun_ajar_id">Tahun Ajar</label>
                <input type="hidden" name="tahun_ajar_id" class="form-control" id="tahun_ajar_id" value="{{$tahunAjarAktif->id}}" readonly>
                <input type="text" name="tahun_ajar" class="form-control" id="tahun_ajar_id" placeholder="Tahun Ajar" value="{{$tahunAjarAktif->nama}}" readonly>
              </div>
              <div class="form-group">
                <label>Wali Kelas</label>
                <select name="wali_kelas_id" class="form-control select2" style="width: 100%;">
                  @foreach($karyawans as $karyawan)
                    <option value="{{$karyawan->id}}">{{$karyawan->user->name}}</option>
                  @endforeach
                </select>
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
