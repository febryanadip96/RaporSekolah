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
        <li class="active">Mata Pelajaran (Create)</li>
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
            <h3 class="box-title">Data Mata Pelajaran Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/mapel')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="tingkat" placeholder="Nama mata pelajaran" required>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                  @foreach($kelas as $kelas1)
                    <option value="{{$kelas1->id}}">{{$kelas1->tingkat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control">
                    <option value="0" selected>Umum</option>
                    <option value="1">Khusus</option>
                </select>
              </div>
              <div class="form-group">
                <label>Kelompok</label>
                <select name="kelompok_id" class="form-control">
                  @foreach($kelompoks as $kelompok)
                    <option value="{{$kelompok->id}}">{{$kelompok->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" class="form-control" id="urutan" placeholder="Urutan" required>
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
