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
        <li class="active">Karyawan (Edit)</li>
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
            <h3 class="box-title">Ubah Data Karyawan</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/karyawan/'.$karyawan->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{$karyawan->user->username}}" readonly>
              </div>
              <div class="form-group">
                <label>
                  Super <input type="checkbox" name="super" class="minimal" value="1" @if($karyawan->super==1) checked @endif>
                </label>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Hak Akses</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="role" class="minimal" value="2"  @if($karyawan->user->role==2) checked @endif> Kepala Sekolah
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="role" class="minimal" value="3" @if($karyawan->user->role==3) checked @endif> Guru
                  </label>
              </div>
              <div class="form-group">
                <label for="password">Password Baru (Diisi apabila akan mengganti password)</label>
                <input type="text" name="password" class="form-control" id="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Karyawan" value="{{$karyawan->user->name}}" required>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Jenis Kelamin</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="jenis_kelamin" class="minimal" value="0" @if($karyawan->jenis_kelamin==0) checked @endif> Laki-laki
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="jenis_kelamin" class="minimal" value="1" @if($karyawan->jenis_kelamin==1) checked @endif> Perempuan
                  </label>
              </div>
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal Lahir:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_lahir" class="form-control pull-right datepicker" value="{{date('m/d/Y',strtotime($karyawan->tanggal_lahir))}}" required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <select name="tempat_lahir_id" class="form-control">
                  @foreach($kotas as $kota)
                    <option value="{{$kota->id}}" @if($karyawan->tempat_lahir_id===$kota->id) selected @endif>{{$kota->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required>{{$karyawan->alamat}}</textarea>
              </div>
              <div class="form-group">
                <label for="no_telp">No Telpon</label>
                <input type="tel" name="no_telp" class="form-control" id="no_telp" placeholder="No Telpon" value="{{$karyawan->no_telp}}" required>
              </div>
              <div class="form-group">
                <label>Ijazah Tertinggi</label>
                <select name="ijazah_id" class="form-control">
                  @foreach($ijazahs as $ijazah)
                    <option value="{{$ijazah->id}}" @if($karyawan->ijazah->id==$ijazah->id) selected @endif>{{$ijazah->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <select name="agama" class="form-control">
                    <option value="1" @if($karyawan->agama==1) selected @endif>Islam</option>
                    <option value="2" @if($karyawan->agama==2) selected @endif>Kristen Protestan</option>
                    <option value="3" @if($karyawan->agama==3) selected @endif>Katolik</option>
                    <option value="4"@if($karyawan->agama==4) selected @endif>Hindu</option>
                    <option value="5"@if($karyawan->agama==5) selected @endif>Budha</option>
                    <option value="6"@if($karyawan->agama==6) selected @endif>Konghucu</option>
                </select>
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
