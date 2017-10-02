@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prestasi <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Prestasi</li>
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
            <h3 class="box-title">Tabel Daftar Prestasi</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama Lomba</th>
                <th>Tingkat</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($semesterSiswa->prestasi as $index => $prestasi)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$prestasi->peringkat->juara}} {{$prestasi->nama_lomba}}</td>
                  <td>
                      @if($prestasi->tingkat==0)
                          Sekolah
                      @elseif($prestasi->tingkat==1)
                          Kecamatan
                      @elseif($prestasi->tingkat==2)
                          Kabupaten
                      @elseif($prestasi->tingkat==3)
                          Provinsi
                      @elseif($prestasi->tingkat==4)
                          Nasional
                      @elseif($prestasi->tingkat==5)
                          Internasional
                      @endif
                  </td>
                  <td>
                      	<a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('guru/walikelas/prestasi/'.$prestasi->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                      	<form  style="display: inline-block" method="post" class="form-delete" action="{{url('guru/walikelas/prestasi/'.$prestasi->id)}}">
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
            <h3 class="box-title">Tambah Prestasi</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{url('guru/walikelas/prestasi')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="semester_siswa_id" value="{{$semesterSiswa->id}}">
              <div class="form-group">
                <label>Peringkat</label>
                <select name="peringkat_id" class="form-control select2" style="width: 100%;">
                  @foreach($peringkats as $peringkat)
                    <option value="{{$peringkat->id}}">{{$peringkat->juara}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="nama_lomba">Nama Lomba</label>
                <input type="text" name="nama_lomba" class="form-control" id="nama_lomba" placeholder="Nama Lomba" required>
              </div>
              <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" class="form-control select2" style="width: 100%;">
                    <option value="0">Sekolah</option>
                    <option value="1">Kecamatan</option>
                    <option value="2">Kabupaten</option>
                    <option value="3">Provinsi</option>
                    <option value="4">Nasional</option>
                    <option value="5">Internasional</option>
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
