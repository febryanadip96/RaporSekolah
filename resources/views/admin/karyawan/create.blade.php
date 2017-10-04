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
        <li class="active">Karyawan (Create)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Karyawan Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/karyawan')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name" placeholder="Nama Karyawan" required>
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" class="form-control" value="{{old('nik')}}" id="nik" placeholder="NIK Karyawan" required>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="{{old('username')}}" id="username" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" value="{{old('password')}}" id="password" placeholder="Password" required>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Hak Akses</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="role" class="minimal" value="2" > Kepala Sekolah
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="role" class="minimal" value="3" checked> Guru
                  </label>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Jenis Kelamin</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="jenis_kelamin" class="minimal" value="0" checked> Laki-laki
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="jenis_kelamin" class="minimal" value="1"> Perempuan
                  </label>
              </div>
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal Lahir:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_lahir" value="{{old('tanggal_lahir')}}" class="form-control pull-right datepicker" required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <select name="tempat_lahir_id" class="form-control">
                  @foreach($kotas as $kota)
                    <option value="{{$kota->id}}" @if(old('tempat_lahir_id')==$kota->id) selected @endif>{{$kota->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required>{{old('alamat')}}</textarea>
              </div>
              <div class="form-group">
                <label for="no_telp">No Telpon</label>
                <input type="tel" name="no_telp" class="form-control" value="{{old('no_telp')}}" id="no_telp" placeholder="No Telpon" required>
              </div>
              <div class="form-group">
                <label>Ijazah Tertinggi</label>
                <select name="ijazah_id" class="form-control">
                  @foreach($ijazahs as $ijazah)
                    <option value="{{$ijazah->id}}" @if(old('ijazah_id')==$ijazah->id) selected @endif>{{$ijazah->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <select name="agama" class="form-control">
                    <option value="1" @if(old('agama')==1) selected @endif>Islam</option>
                    <option value="2" @if(old('agama')==2) selected @endif>Kristen Protestan</option>
                    <option value="3" @if(old('agama')==3) selected @endif>Katolik</option>
                    <option value="4" @if(old('agama')==4) selected @endif>Hindu</option>
                    <option value="5" @if(old('agama')==5) selected @endif>Budha</option>
                    <option value="6" @if(old('agama')==6) selected @endif>Konghucu</option>
                </select>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
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
