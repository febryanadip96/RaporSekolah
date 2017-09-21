@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nilai Sikap <small>{{$nilaiSikap->semesterSiswa->siswa->user->name}} ({{$nilaiSikap->semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Nilai Sikap</li>
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
            <h3 class="box-title">Nilai Sikap</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('guru/walikelas/nilaisikap/'.$nilaiSikap->id)}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nilai_spiritual">Nilai Spiritual</label>
                <input type="number" name="nilai_spiritual" class="form-control" id="nilai_spiritual" placeholder="Nilai Spiritual" value="{{$nilaiSikap->nilai_spiritual}}" required>
              </div>
              <div class="form-group">
                <label for="deskripsi_spiritual">Deskripsi Nilai Spiritual</label>
                <textarea class="form-control" name="deskripsi_spiritual" rows="3" id="deskripsi_spiritual" placeholder="Deskripsi Nilai Spiritual" required>{{$nilaiSikap->deskripsi_spiritual}}</textarea>
              </div>
              <div class="form-group">
                <label for="nilai_sosial">Nilai Sosial</label>
                <input type="number" name="nilai_sosial" class="form-control" id="nilai_sosial" placeholder="Nilai Sosial" value="{{$nilaiSikap->nilai_sosial}}" required>
              </div>
              <div class="form-group">
                <label for="deskripsi_sosial">Deskripsi Nilai Sosial</label>
                <textarea class="form-control" name="deskripsi_sosial" rows="3" id="deskripsi_sosial" placeholder="Deskripsi Nilai Sosial" required>{{$nilaiSikap->deskripsi_sosial}}</textarea>
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
