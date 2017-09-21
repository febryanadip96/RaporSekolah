@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Ekstrakulikuler <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Ekstrakulikuler</li>
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
            <h3 class="box-title">Tabel Daftar Ekstrakulikuler</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nilai</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($semesterSiswa->nilaiEkstrakulikuler as $index => $nilaiEkstrakulikuler)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$nilaiEkstrakulikuler->ekstrakulikuler->nama}}</td>
                  <td>{{$nilaiEkstrakulikuler->nilai}}</td>
                  <td>
                      <a class="btn btn-warning btn-xs" href="{{url('guru/walikelas/ekstrakulikuler/'.$nilaiEkstrakulikuler->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                      <form  style="display: inline-block" method="post" class="form-delete" action="{{url('guru/walikelas/ekstrakulikuler/'.$nilaiEkstrakulikuler->id)}}">
                      {{ method_field('DELETE') }}{{ csrf_field() }}
                      <a class="delete-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a></form></span></a>
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
            <h3 class="box-title">Tambah Nilai Ekstrakulikuler</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{url('guru/walikelas/ekstrakulikuler')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="semester_siswa_id" value="{{$semesterSiswa->id}}">
              <div class="form-group">
                <label>Ekstrakulikuler</label>
                <select name="ekstrakulikuler_id" class="form-control select2" style="width: 100%;">
                  @foreach($ekskulPilihans as $ekskulPilihan)
                    <option value="{{$ekskulPilihan->id}}">{{$ekskulPilihan->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" class="form-control" id="nilai" placeholder="Nilai" required>
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
