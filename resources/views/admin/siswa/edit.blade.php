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
        <li class="active">Siswa (Edit)</li>
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
            <h3 class="box-title">Ubah Data Siswa</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/siswa/'.$siswa->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
				<div class="col-xs-4">
					<div class="form-group">
	                  <label for="username">Username</label>
	                  <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{$siswa->user->username}}" readonly>
	                </div>
	                <div class="form-group has-warning">
	                  <label for="password">Password Baru(Diisi apabila akan mengganti password)</label>
	                  <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
	                </div>
	                <div class="form-group">
	                  <label for="nis">NIS</label>
	                  <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS siswa" value="{{$siswa->nis}}" required>
	                </div>
	                <div class="form-group">
	                  <label for="nisn">NISN</label>
	                  <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN siswa" value="{{$siswa->nisn}}" required>
	                </div>
	                <div class="form-group">
	                  <label for="name">Nama</label>
	                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama siswa" value="{{$siswa->user->name}}" required>
	                </div>
	                <!-- radio -->
	                <div class="form-group">
	                    <label>Jenis Kelamin</label><br>
	                    <label class="radio-inline">
	                        <input type="radio" name="jenis_kelamin" class="minimal" value="0" @if($siswa->jenis_kelamin==0) checked @endif> Laki-laki
	                    </label>
	                    <label class="radio-inline">
	                        <input type="radio" name="jenis_kelamin" class="minimal" value="1" @if($siswa->jenis_kelamin==1) checked @endif> Perempuan
	                    </label>
	                </div>
	                <!-- Date -->
	                <div class="form-group">
	                  <label>Tanggal Lahir:</label>

	                  <div class="input-group date">
	                    <div class="input-group-addon">
	                      <i class="fa fa-calendar"></i>
	                    </div>
	                    <input type="text" name="tanggal_lahir" class="form-control pull-right datepicker" value="{{date('m/d/Y',strtotime($siswa->tanggal_lahir))}}" required>
	                  </div>
	                  <!-- /.input group -->
	                </div>
	                <div class="form-group">
	                  <label>Tempat Lahir</label>
	                  <select name="tempat_lahir_id" class="form-control">
	                    @foreach($kotas as $kota)
	                      <option value="{{$kota->id}}" @if($siswa->tempat_lahir_id===$kota->id) selected @endif>{{$kota->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="alamat">Alamat</label>
	                  <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required>{{$siswa->alamat}}</textarea>
	                </div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
	                  <label for="telpon_rumah">Telpon Rumah</label>
	                  <input type="text" name="telpon_rumah" class="form-control" id="telpon_rumah" placeholder="Telpon rumah" value="{{$siswa->telpon_rumah}}">
	                </div>
	                <div class="form-group">
	                  <label>Agama</label>
	                  <select name="agama" class="form-control">
	                      <option value="1" @if($siswa->agama==1) selected @endif>Islam</option>
	                      <option value="2" @if($siswa->agama==2) selected @endif>Kristen Protestan</option>
	                      <option value="3" @if($siswa->agama==3) selected @endif>Katolik</option>
	                      <option value="4"@if($siswa->agama==4) selected @endif>Hindu</option>
	                      <option value="5"@if($siswa->agama==5) selected @endif>Budha</option>
	                      <option value="6"@if($siswa->agama==6) selected @endif>Konghucu</option>
	                  </select>
	                </div>

	                <!-- Date -->
	                <div class="form-group">
	                  <label>Tanggal Masuk:</label>

	                  <div class="input-group date">
	                    <div class="input-group-addon">
	                      <i class="fa fa-calendar"></i>
	                    </div>
	                    <input type="text" name="tanggal_masuk" class="form-control pull-right datepicker" value="{{$siswa->tanggal_masuk}}" required>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label>Tahun Ajar Masuk</label>
	                  <select name="tahun_ajar_id" class="form-control">
	                    @foreach($tahunAjars as $tahunAjar)
	                      <option value="{{$tahunAjar->id}}" @if($siswa->tahun_ajar_id==$tahunAjar->id) selected @endif>{{$tahunAjar->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label>Kelas Awal</label>
	                  <select name="kelas_awal_id" class="form-control">
	                    @foreach($kelas as $kelas1)
	                      <option value="{{$kelas1->id}}" @if($siswa->kelas_awal_id==$kelas1->id) selected @endif>{{$kelas1->tingkat}}</option>
	                    @endforeach
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="anak_ke">Anak ke</label>
	                  <input type="text" name="anak_ke" class="form-control" id="anak_ke" placeholder="Anak ke" value="{{$siswa->anak_ke}}" required>
	                </div>
	                <div class="form-group">
	                  <label for="ayah">Ayah</label>
	                  <input type="text" name="ayah" class="form-control" id="ayah" placeholder="Nama Ayah" value="{{$siswa->ayah}}" required>
	                </div>
	                <div class="form-group">
	                  <label>Pekerjaan Ayah</label>
	                  <select name="pekerjaan_ayah_id" class="form-control">
	                    @foreach($pekerjaans as $pekerjaan)
	                      <option value="{{$pekerjaan->id}}" @if($siswa->pekerjaan_ayah_id==$pekerjaan->id) selected @endif>{{$pekerjaan->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="ibu">Ibu</label>
	                  <input type="text" name="ibu" class="form-control" id="ibu" placeholder="Nama Ibu" value="{{$siswa->ibu}}" required>
	                </div>
	                <div class="form-group">
	                  <label>Pekerjaan Ibu</label>
	                  <select name="pekerjaan_ibu_id" class="form-control">
	                    @foreach($pekerjaans as $pekerjaan)
	                      <option value="{{$pekerjaan->id}}" @if($siswa->pekerjaan_ibu_id==$pekerjaan->id) selected @endif>{{$pekerjaan->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
				</div>
				<div class="col-xs-4">
					<div class="form-group has-warning">
					  <label for="telpon_rumah_ortu">Nomor Telpon Rumah Orang Tua (Tidak harus diisi)</label>
					  <input type="text" name="telpon_rumah_ortu" class="form-control" id="telpon_rumah_ortu" placeholder="Nomor telpon rumah orang tua" value="{{$siswa->telpon_rumah_ortu}}">
					</div>
					<div class="form-group has-warning">
	                  <label for="alamat_ortu">Alamat Orang Tua (Tidak harus diisi)</label>
	                  <textarea class="form-control" name="alamat_ortu" rows="3" id="alamat_ortu" placeholder="Alamat orang tua">{{$siswa->alamat_ortu}}</textarea>
	                </div>
	                <div class="form-group has-warning">
	                  <label for="wali">Wali (Tidak harus diisi)</label>
	                  <input type="text" name="wali" class="form-control" id="wali" placeholder="Nama Wali" value="{{$siswa->wali}}">
	                </div>
	                <div class="form-group has-warning">
	                  <label>Pekerjaan Wali (Tidak harus dipilih)</label>
	                  <select name="pekerjaan_wali_id" class="form-control">
	                    @foreach($pekerjaans as $pekerjaan)
	                      <option value="{{$pekerjaan->id}}" @if($siswa->pekerjaan_wali_id==$pekerjaan->id) selected @endif>{{$pekerjaan->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
	                <div class="form-group has-warning">
	                  <label for="telpon_rumah_wali">Nomor Telpon Rumah Wali (Tidak harus diisi)</label>
	                  <input type="text" name="telpon_rumah_wali" class="form-control" id="telpon_rumah_wali" placeholder="Nomor telpon rumah wali" value="{{$siswa->telpon_rumah_wali}}">
	                </div>
	                <div class="form-group has-warning">
	                  <label for="alamat_wali">Alamat Wali (Tidak harus diisi)</label>
	                  <textarea class="form-control" name="alamat_wali" rows="3" id="alamat_wali" placeholder="Alamat wali">{{$siswa->alamat_wali}}</textarea>
	                </div>
	                <div class="form-group">
	                  <label>Sekolah Asal</label>
	                  <select name="sekolah_asal_id" class="form-control">
	                    @foreach($sekolahs as $sekolah)
	                      <option value="{{$sekolah->id}}" @if($siswa->sekolah_asal_id===$sekolah->id) selected @endif>{{$sekolah->nama}}</option>
	                    @endforeach
	                  </select>
	                </div>
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
