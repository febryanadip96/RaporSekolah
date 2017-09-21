@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atur Kelulusan <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Atur Kelulusan</li>
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
            <h3 class="box-title">Atur Kelulusan</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <!-- /.box-body -->
          <form role="form" class="form-update" action="{{url('guru/walikelas/aturkelulusan/'.$semesterSiswa->id)}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="tanpa_keterangan">Ketidakhadiran Tanpa Keterangan</label>
                <input type="text" class="form-control" id="tanpa_keterangan" value="{{$tanpaKeterangans}} dari {{$batasKetidakhadiran}}" readonly>
              </div>
              <div class="form-group">
                <label for="nilai_pengetahuan">Nilai Pengetahuan di bawah KKM</label>
                <input type="number" class="form-control" id="nilai_pengetahuan" value="{{$nilaiPengetahuanBawahKkm}}" readonly>
              </div>
              <div class="form-group">
                <label for="nilai_ketrampilan">Nilai Ketrampilan di bawah KKM</label>
                <input type="number" class="form-control" id="nilai_ketrampilan" value="{{$nilaiKetrampilanBawahKkm}}" readonly>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan Tambahan</label>
                <textarea class="form-control" rows="3" id="keterangan" readonly>{{$tambahan}}</textarea>
              </div>
              <div class="form-group">
                <label for="status">Status Kelulusan saat ini</label>
                <input type="text" class="form-control" id="status" value="@if($daftarKelas->status_lulus) Lulus @else Belum Lulus @endif" readonly>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Lulus:</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="lulus" class="minimal" value="1" @if($lulus==true) checked @endif> Ya
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="lulus" class="minimal" value="0"  @if($lulus==false) checked @endif> Tidak
                  </label>
              </div>
            </div>

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
