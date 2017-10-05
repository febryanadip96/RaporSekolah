@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Siswa
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li><a href="{{url('admin/siswa')}}">Siswa</a></li>
        <li class="active">Siswa (Show)</li>
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
            <h3 class="box-title">Data Siswa</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
				<div class="col-xs-4">
					<div class="form-group">
	                  <label for="username">Username</label>
	                  <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{$siswa->user->username}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="nis">NIS</label>
	                  <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS siswa" value="{{$siswa->nis}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="nisn">NISN</label>
	                  <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN siswa" value="{{$siswa->nisn}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="name">Nama</label>
	                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama siswa" value="{{$siswa->user->name}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Jenis Kelamin</label>
	                  <input type="text" name="jenis_kelamin" class="form-control" value="@if($siswa->jenis_kelamin===0)Laki-laki @elseif($siswa->jenis_kelamin===1)Perempuan @endif">
	                </div>
	                <!-- Date -->
	                <div class="form-group">
	                  <label>Tanggal Lahir:</label>

	                  <div class="input-group date">
	                    <div class="input-group-addon">
	                      <i class="fa fa-calendar"></i>
	                    </div>
	                    <input type="text" name="tanggal_lahir" class="form-control pull-right" value="{{date('m/d/Y',strtotime($siswa->tanggal_lahir))}}" readonly="">
	                  </div>
	                  <!-- /.input group -->
	                </div>
	                <div class="form-group">
	                  <label>Tempat Lahir</label>
	                  <input type="text" name="tempat_lahir_id" class="form-control" value="{{$siswa->asal->nama}}">
	                </div>
	                <div class="form-group">
	                  <label for="alamat">Alamat</label>
	                  <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" readonly>{{$siswa->alamat}}</textarea>
	                </div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
	                  <label for="telpon_rumah">Telpon Rumah</label>
	                  <input type="text" name="telpon_rumah" class="form-control" id="telpon_rumah" placeholder="Telpon rumah" value="{{$siswa->telpon_rumah}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Agama</label>
	                  <input type="text" name="agama" class="form-control" readonly value="@if($siswa->agama===1)Islam @elseif($siswa->agama===2)Kristen Protestan @elseif($siswa->agama===3)Katolik @elseif($siswa->agama===4)Hindu @elseif($siswa->agama===5)Budha @elseif($siswa->agama===6)Konghucu @endif
	                  ">
	                </div>

	                <div class="form-group">
	                  <label>Sekolah Asal</label>
	                  <input type="text" name="sekolah_asal_id" class="form-control" value="{{$siswa->sekolahAsal->nama}}" readonly>
	                </div>
	                <!-- Date -->
	                <div class="form-group">
	                  <label>Tanggal Masuk:</label>

	                  <div class="input-group date">
	                    <div class="input-group-addon">
	                      <i class="fa fa-calendar"></i>
	                    </div>
	                    <input type="text" name="tanggal_masuk" class="form-control pull-right" value="{{$siswa->tanggal_masuk}}" readonly>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label>Tahun Ajar Masuk</label>
	                  <input type="text" name="tahun_ajar_id" class="form-control" value="{{$siswa->masukTahunAjar->nama}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Kelas Awal</label>
	                  <input type="text" name="kelas_awal_id" class="form-control" value="{{date('m/d/Y',strtotime($siswa->masukKelasAwal->tingkat))}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="anak_ke">Anak ke</label>
	                  <input type="text" name="anak_ke" class="form-control" id="anak_ke" placeholder="Anak ke" value="{{$siswa->anak_ke}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="ayah">Ayah</label>
	                  <input type="text" name="ayah" class="form-control" id="ayah" placeholder="Nama Ayah" value="{{$siswa->ayah}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Pekerjaan Ayah</label>
	                  <input type="text" name="pekerjaan_ayah_id" class="form-control" value="{{$siswa->pekerjaanAyah->nama}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="ibu">Ibu</label>
	                  <input type="text" name="ibu" class="form-control" id="ibu" placeholder="Nama Ibu" value="{{$siswa->ibu}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Pekerjaan Ibu</label>
	                  <input type="text" name="pekerjaan_ayah_id" class="form-control" value="{{$siswa->pekerjaanIbu->nama}}" readonly>
	                </div>
				</div>
				<div class="col-xs-4">
	                <div class="form-group">
	                  <label for="telpon_rumah_ortu">Nomor Telpon Rumah Orang Tua</label>
	                  <input type="text" name="telpon_rumah_ortu" class="form-control" id="telpon_rumah_ortu" placeholder="Nomor telpon rumah orang tua" value="{{$siswa->telpon_rumah_ortu}}" readonly>
	                </div>
					<div class="form-group">
	                  <label for="alamat_ortu">Alamat Orang Tua</label>
	                  <textarea class="form-control" name="alamat_ortu" rows="3" id="alamat_ortu" placeholder="Alamat orang tua" readonly>{{$siswa->alamat_ortu}}</textarea>
	                </div>
	                <div class="form-group">
	                  <label for="wali">Wali</label>
	                  <input type="text" name="wali" class="form-control" id="wali" placeholder="Nama Wali" value="{{$siswa->wali}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label>Pekerjaan Wali</label>
	                  <input type="text" name="pekerjaan_ayah_id" class="form-control" value="{{$siswa->pekerjaanWali->nama}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="telpon_rumah_wali">Nomor Telpon Rumah Wali</label>
	                  <input type="text" name="telpon_rumah_wali" class="form-control" id="telpon_rumah_wali" placeholder="Nomor telpon rumah wali" value="{{$siswa->telpon_rumah_wali}}" readonly>
	                </div>
	                <div class="form-group">
	                  <label for="alamat_wali">Alamat Wali</label>
	                  <textarea class="form-control" name="alamat_wali" rows="3" id="alamat_wali" placeholder="Alamat wali" readonly>{{$siswa->alamat_wali}}</textarea>
	                </div>
				</div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <a href="{{url('admin/siswa')}}" class="btn btn-default">Kembali</a>
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
