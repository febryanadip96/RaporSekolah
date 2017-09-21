@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kota
      </h1>
      <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Kelas</li>
          <li>Kelas</li>
          <li><a href="{{url('admin/kelasbuka')}}">Kelas Buka</a></li>
        <li class="active">Kelas Buka (Edit)</li>
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
            <h3 class="box-title">Ubah Data Kelas Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/kelasbuka/'.$kelasBuka->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Tingkat kelas" value="{{$kelasBuka->nama}}" required>
              </div>
              <div class="form-group">
                <label>Tingkat Kelas</label>
                <select name="kelas_id" class="form-control">
                  @foreach($kelas as $kelas1)
                    <option value="{{$kelas1->id}}" @if($kelas1->id==$kelasBuka->kelas_id) selected @endif >{{$kelas1->tingkat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tahun_ajar_id">Tahun Ajar</label>
                <input type="hidden" name="tahun_ajar_id" class="form-control" id="tahun_ajar_id" value="{{$kelasBuka->tahun_ajar_id}}" readonly>
                <input type="text" name="tahun_ajar" class="form-control" id="tahun_ajar_id" placeholder="Tahun Ajar" value="{{$kelasBuka->tahunAjar->nama}}" readonly>
              </div>
              <div class="form-group">
                <label>Wali Kelas</label>
                <select name="wali_kelas_id" class="form-control">
                  @foreach($karyawans as $karyawan)
                    <option value="{{$karyawan->id}}"  @if($karyawan->id==$kelasBuka->wali_kelas_id) selected @endif>{{$karyawan->user->name}}</option>
                  @endforeach
                </select>
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
