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
          <li><a href="{{url('admin/mapelbuka')}}">Mapel Buka</a></li>
        <li class="active">Mapel Buka (Create)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Data Mata Pelajaran Buka Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/mapelbuka')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label>Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="form-control select2" style="width: 100%;">
                  @foreach($mapels as $mapel)
                    <option value="{{$mapel->id}}">{{$mapel->nama}} {{$mapel->keterangan}} kelas {{$mapel->kelas->tingkat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_buka_id" class="form-control">
                  @foreach($kelasBukas as $kelasBuka)
                    <option value="{{$kelasBuka->id}}">{{$kelasBuka->nama}} ({{$kelasBuka->tahunAjar->nama}})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Pengajar</label>
                <select name="pengajar_id" class="form-control select2" style="width: 100%;">
                  @foreach($karyawans as $karyawan)
                    <option value="{{$karyawan->id}}">{{$karyawan->user->name}} ({{$karyawan->nik}})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kkm">KKM</label>
                <input type="number" name="kkm" class="form-control" value="80" id="kkm" placeholder="Nilai KKM">
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
