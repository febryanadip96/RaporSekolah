@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Siswa dalam Mata Pelajaran {{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}
        <small>({{$mapelBuka->pengajar->user->name}})</smal>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Mata Pelajaran</li>
        <li><a href="{{url('admin/mapelbuka')}}">Mapel Buka</a></li>
        <li class="active">Daftar Siswa Mapel</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')

      <div class="col-xs-8">
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Siswa Mata Pelajaran Buka</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nomor</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($siswasTerdaftar as $index=>$siswaTerdaftar)
                  <tr>
	                  <td>{{$index+1}}</td>
	                  <td>{{$siswaTerdaftar->nis}}</td>
	                  <td>{{$siswaTerdaftar->nisn}}</td>
	                  <td>{{$siswaTerdaftar->user->name}}</td>
	                  <td>
											<form style="display: inline-block" method="post" class="form-delete" action="{{url('admin/daftarsiswamapel/'.$siswaTerdaftar->id)}}">
			                  {{ method_field('DELETE') }}
												{{ csrf_field() }}
			                  <input type="hidden" name="mapel_buka_id" value="{{$mapelBuka->id}}">
			                  <input type="hidden" name="kelas_buka_id" value="{{$mapelBuka->kelasBuka->id}}">
			                  <a data-toggle="tooltip" title="Hapus" class="update-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a>
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
          <h3 class="box-title">Tambah Siswa</h3>
        </div>
          <form role="form" action="{{url('admin/daftarsiswamapel')}}" method="post">
          <!-- /.box-header -->
          <div class="box-body">
            {{ csrf_field() }}
            <input type="hidden" name="mapel_buka_id" value="{{$mapelBuka->id}}">
            <div class="form-group">
              <label>Tambah Siswa</label>
              <select name="siswa_id" class="form-control select2" style="width: 100%;">
                @foreach($siswasPilihan as $siswaPilihan)
                  <option value="{{$siswaPilihan->id}}">{{$siswaPilihan->user->name}} ({{$siswaPilihan->nis}})</option>
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
