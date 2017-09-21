@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Prestasi <small>{{$prestasi->semesterSiswa->siswa->user->name}} ({{$prestasi->semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li><a href="{{url('guru/walikelas/prestasi/'.$prestasi->semesterSiswa->id)}}">Prestasi</a></li>
        <li class="active"> Prestasi (Edit)</li>
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
            <h3 class="box-title">Edit Nilai Ekstrakulikuler</h3>

          </div>
        <form role="form" class="form-update" action="{{url('guru/walikelas/prestasi/'.$prestasi->id)}}" method="post">
          <!-- /.box-header -->
          <div class="box-body">
              {{ csrf_field() }}
              {{method_field("PUT")}}
              <div class="form-group">
                <label>Peringkat</label>
                <select name="peringkat_id" class="form-control select2" style="width: 100%;">
                  @foreach($peringkats as $peringkat)
                    <option value="{{$peringkat->id}}" @if($peringkat->id==$prestasi->peringkat_id) selected @endif >{{$peringkat->juara}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="nama_lomba">Nama Lomba</label>
                <input type="text" name="nama_lomba" class="form-control" id="nama_lomba" placeholder="Nama Lomba" value="{{$prestasi->nama_lomba}}" required>
              </div>
              <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" class="form-control select2" style="width: 100%;">
                    <option value="0" @if($prestasi->tingkat==0) selected @endif >Sekolah</option>
                    <option value="1" @if($prestasi->tingkat==1) selected @endif >Kecamatan</option>
                    <option value="2" @if($prestasi->tingkat==2) selected @endif >Kabupaten</option>
                    <option value="3" @if($prestasi->tingkat==3) selected @endif >Provinsi</option>
                    <option value="4" @if($prestasi->tingkat==4) selected @endif >Nasional</option>
                    <option value="5" @if($prestasi->tingkat==5) selected @endif >Internasional</option>
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
