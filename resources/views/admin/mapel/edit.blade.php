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
          <li><a href="{{url('admin/mapel')}}">Mata Pelajaran</a></li>
        <li class="active">Mata Pelajaran (Edit)</li>
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
            <h3 class="box-title">Ubah Data Mata Pelajaran</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/mapel/'.$mapel->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="tingkat" placeholder="Nama mata pelajaran" value="{{$mapel->nama}}" required>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" value="{{$mapel->keterangan}}">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                  @foreach($kelas as $kelas1)
                    <option value="{{$kelas1->id}}" @if($mapel->kelas->id==$kelas1->id) selected @endif>{{$kelas1->tingkat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control">
                    <option value="0" @if($mapel->jenis==0) selected @endif>Umum</option>
                    <option value="1" @if($mapel->jenis==1) selected @endif>Khusus</option>
                </select>
              </div>
              <div class="form-group">
                <label>Kelompok</label>
                <select name="kelompok_id" class="form-control">
                  @foreach($kelompoks as $kelompok)
                    <option value="{{$kelompok->id}}" @if($mapel->kelompok->id==$kelompok->id) selected @endif>{{$kelompok->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" class="form-control" id="urutan" placeholder="Urutan" value="{{$mapel->urutan}}" required>
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
