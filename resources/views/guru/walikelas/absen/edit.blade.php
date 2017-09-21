@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Ketidahadiran <small>{{$ketidakhadiran->semesterSiswa->siswa->user->name}} ({{$ketidakhadiran->semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li><a href="{{url('guru/walikelas/ketidakhadiran/'.$ketidakhadiran->semesterSiswa->id)}}">Ketidahadiran</a></li>
        <li class="active"> Ketidahadiran (Edit)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <div class="box box-warning">
          <div class="box-header">
            <h3 class="box-title">Edit Ketidakhadiran</h3>

          </div>
        <form role="form" class="form-update" action="{{url('guru/walikelas/ketidakhadiran/'.$ketidakhadiran->id)}}" method="post">
          <!-- /.box-header -->
          <div class="box-body">
              {{ csrf_field() }}
              {{method_field("PUT")}}
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control pull-right" value="{{date('m/d/Y',strtotime($ketidakhadiran->tanggal))}}" id="datepicker" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control select2" style="width: 100%;">
                    <option value="0" @if($ketidakhadiran->status==0) selected @endif>Sakit</option>
                    <option value="1" @if($ketidakhadiran->status==1) selected @endif>Izin</option>
                    <option value="2" @if($ketidakhadiran->status==2) selected @endif>Tanpa Keterangan</option>
                </select>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a class="update-modal btn btn-warning">Simpan</a>
          </div>
        </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
