@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Siswa dalam Kelas {{$kelasBuka->nama}} <small>(Wali Kelas : {{$kelasBuka->waliKelas->user->name}})</smal>
      </h1>
      <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Kelas</li>
            <li>Kelas</li>
            <li><a href="{{url('admin/kelasbuka')}}">Kelas Buka</a></li>
            <li class="active">Daftar Siswa</li>
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
            <h3 class="box-title">Tabel Daftar Siswa</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Status Lulus</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($kelasBuka->daftarKelas as $index => $daftarKelas)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$daftarKelas->siswa->nis}}</td>
                  <td>{{$daftarKelas->siswa->user->name}}</td>
                  <td>@if($daftarKelas->status_lulus==1) Lulus @else Belum Lulus @endif</td>
                  <td><form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/aturkelas/'.$daftarKelas->id)}}">
                  {{ method_field('DELETE') }}{{ csrf_field() }}
                  <a class="delete-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a></form></span></a></td>
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
            <h3 class="box-title">Tambah Siswa</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{url('admin/aturkelas')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="kelas_buka_id" value="{{$kelasBuka->id}}">
              <div class="form-group">
                <label>Tambah Siswa</label>
                <select name="siswa_id" class="form-control select2" style="width: 100%;">
                  @foreach($siswas as $siswa)
                    <option value="{{$siswa->id}}">{{$siswa->user->name}} ({{$siswa->nis}})</option>
                  @endforeach
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
