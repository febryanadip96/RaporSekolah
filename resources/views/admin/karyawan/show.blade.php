@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Karyawan
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li><a href="{{url('admin/karyawan')}}">Karyawan</a></li>
        <li class="active">Karyawan (Show)</li>
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
            <h3 class="box-title">Karyawan Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{$karyawan->user->username}}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Karyawan" value="{{$karyawan->user->name}}" readonly>
              </div>
              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="@if($karyawan->jenis_kelamin===0)Laki-laki @elseif($karyawan->jenis_kelamin===1)Perempuan @endif
                " readonly>
              </div>
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal Lahir:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_lahir" class="form-control pull-right" value="{{date('m/d/Y',strtotime($karyawan->tanggal_lahir))}}" readonly>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
              <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir_id" class="form-control" value="{{$karyawan->asal->nama}}" readonly>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" readonly>{{$karyawan->alamat}}</textarea>
              </div>
              <div class="form-group">
                <label for="no_telp">No Telpon</label>
                <input type="tel" name="no_telp" class="form-control" id="no_telp" placeholder="No Telpon" value="{{$karyawan->no_telp}}" readonly>
              </div>
              <div class="form-group">
                <label>Ijazah Tertinggi</label>
                <input type="text" name="ijazah_tertinggi" class="form-control" value="{{$karyawan->ijazah->nama}}" readonly>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" readonly value="@if($karyawan->agama===1)Islam @elseif($karyawan->agama===2)Kristen Protestan @elseif($karyawan->agama===3)Katolik @elseif($karyawan->agama===4)Hindu @elseif($karyawan->agama===5)Budha @elseif($karyawan->agama===6)Konghucu @endif
                ">
              </div>
              <div class="form-group">
                <label>Hak Akses</label>
                <input type="text" name="role" class="form-control" readonly
                    value="@if($karyawan->user->role===1)Kepala Sekolah @elseif($karyawan->user->role===2)Guru @endif">
                </select>
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
