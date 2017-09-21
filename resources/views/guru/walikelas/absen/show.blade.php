@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ketidakhadiran <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Ketidakhadiran</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-8">
        <!-- /.box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Daftar Ketidakhadiran</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($semesterSiswa->ketidakhadiran as $index => $ketidakhadiran)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$ketidakhadiran->tanggal}}</td>
                  <td>
                      @if($ketidakhadiran->status==0)
                          Sakit
                      @elseif($ketidakhadiran->status==1)
                          Izin
                      @elseif($ketidakhadiran->status==2)
                          Tanpa Keterangan
                      @endif
                  </td>
                  <td>
                      <a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('guru/walikelas/ketidakhadiran/'.$ketidakhadiran->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                      <form  style="display: inline-block" method="post" class="form-delete" action="{{url('guru/walikelas/ketidakhadiran/'.$ketidakhadiran->id)}}">
	                      {{ method_field('DELETE') }}{{ csrf_field() }}
	                      <a data-toggle="tooltip" title="Hapus" class="delete-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a>
											</form>
                  </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xs-4">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Ketidakhadiran</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{url('guru/walikelas/ketidakhadiran')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="semester_siswa_id" value="{{$semesterSiswa->id}}">
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control pull-right" value="{{date('m/d/Y',strtotime('now'))}}" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control select2" style="width: 100%;">
                    <option value="0">Sakit</option>
                    <option value="1">Izin</option>
                    <option value="2">Tanpa Keterangan</option>
                </select>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Tambah</button>
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
