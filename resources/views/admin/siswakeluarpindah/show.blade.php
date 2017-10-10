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
        <li class="active">Siswa Pindah/Keluar (Show)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Data Siswa Pindah/Keluar</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
              {{ csrf_field() }}
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
                    <label for="tanggal">Tanggal</label>
                    <input type="text" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal" value="{{date('m/d/Y',strtotime($keluarPindah->tanggal))}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control" id="status" placeholder="Status" value="@if($keluarPindah->status==0) Keluar @elseif($keluarPindah->status==1) Pindah @endif" readonly>
                  </div>
                  <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea class="form-control" name="alasan" rows="3" id="alasan" placeholder="Alasan" readonly>{{$keluarPindah->alasan}}</textarea>
                  </div>
              </div>
            <!-- /.box-body -->

            <div class="box-footer">
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
