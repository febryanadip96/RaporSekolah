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
        <li class="active">Mapel Buka (Edit)</li>
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
            <h3 class="box-title">Ubah Data Mapel Buka</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/mapelbuka/'.$mapelBuka->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="box-body">
              <div class="form-group">
                <label for="mata_pelajaran_id">Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran_id" class="form-control" id="mata_pelajaran_id" placeholder="Mata Pelajaran" value="{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}}" readonly>
              </div>
              <div class="form-group">
                <label for="kelas_buka_id">Kelas</label>
                <input type="text" name="kelas_buka_id" class="form-control" id="kelas_buka_id" placeholder="Kelas" value="{{$mapelBuka->kelasBuka->nama}}" readonly>
              </div>
              <div class="form-group">
                <label>Pengajar</label>
                <select name="pengajar_id" class="form-control">
                  @foreach($karyawans as $karyawan)
                    <option value="{{$karyawan->id}}" @if($mapelBuka->pengajar->id==$karyawan->id) selected @endif>{{$karyawan->user->name}} ({{$karyawan->nik}})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kkm">KKM</label>
                <input type="number" name="kkm" class="form-control" id="kkm" placeholder="Nilai KKM" value="{{$mapelBuka->kkm}}">
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
