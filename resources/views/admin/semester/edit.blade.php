@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semester
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-calendar"></i> Tahun Ajar</li>
        <li><a href="{{url('admin/semester')}}">Semester</a></li>
        <li class="active">Semester (Edit)</li>
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
            <h3 class="box-title">Ubah Data Semester</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form"  class="form-update" action="{{url('admin/semester/'.$semester->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Tahun Ajar" value="{{ $semester->gasal_genap === 1? 'Gasal' : 'Genap' }} {{$semester->tahunAjar->nama}}" disabled required>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Status</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="status" class="minimal" value="1"  @if($semester->status===1) checked @endif> Aktif
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="status" class="minimal" value="0" @if($semester->status===0) checked @endif> Tidak Aktif
                  </label>
              </div>
              <!-- Date and time range -->
              <div class="form-group">
                <label>Tutup Tengah Semester</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" name="tutup_tengah_semester" class="form-control pull-right daterange" value="{{$semester->awal_tutup_tengah_semester==null && $semester->akhir_tutup_tengah_semester==null? '':date('m/d/Y h:i A',strtotime($semester->awal_tutup_tengah_semester)).' - '.date('m/d/Y h:i A',strtotime($semester->akhir_tutup_tengah_semester))}}">
                </div>
                <!-- /.input group -->
              </div>
              <!-- Date and time range -->
              <div class="form-group">
                <label>Tutup Akhir Semester</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" name="tutup_akhir_semester" class="form-control pull-right daterange" value="{{$semester->awal_tutup_akhir_semester==null && $semester->akhir_tutup_akhir_semester==null? '':date('m/d/Y h:i A',strtotime($semester->awal_tutup_akhir_semester)).' - '.date('m/d/Y h:i A',strtotime($semester->akhir_tutup_akhir_semester))}}">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
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
