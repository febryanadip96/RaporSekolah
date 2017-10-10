@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Siswa Pindah/Keluar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li><a href="{{url('admin/keluarpindah')}}">Siswa Pindah/Keluar</a></li>
        <li class="active">Siswa Pindah\Keluar (Edit)</li>
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
            <h3 class="box-title">Ubah Data Siswa Pindah\Keluar</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/keluarpindah/'.$keluarPindah->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                  <label for="nis">NIS</label>
                  <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS siswa" value="{{$keluarPindah->siswa->nis}}" readonly>
              </div>
              <div class="form-group">
                  <label for="nisn">NISN</label>
                  <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN siswa" value="{{$keluarPindah->siswa->nisn}}" readonly>
              </div>
              <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama siswa" value="{{$keluarPindah->siswa->user->name}}" readonly>
              </div>
              <div class="form-group">
                <label>Tanggal:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control pull-right datepicker" value="{{date('m/d/Y',strtotime($keluarPindah->tanggal))}}" required>
                </div>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="0" @if($keluarPindah->status==0) selected @endif>Keluar</option>
                    <option value="1" @if($keluarPindah->status==1) selected @endif>Pindah</option>
                </select>
              </div>
              <div class="form-group">
                <label for="alasan">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" id="keterangan" placeholder="Keterangan" required>{{$keluarPindah->keterangan}}</textarea>
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
