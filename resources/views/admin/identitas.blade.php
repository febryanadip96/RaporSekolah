@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Identitas Sekolah
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-bank"></i> Identitas Sekolah</li>
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
            <h3 class="box-title">Data Identitas Sekolah</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/identitas/'.$identitas->id)}}" method="post">
              {{csrf_field()}}
              {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Sekolah" value="{{$identitas->nama}}" required>
              </div>
              <div class="form-group">
                <label for="nis">NIS/NSS/NDS</label>
                <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS/NSS/NDS" value="{{$identitas->nis}}" required>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required>{{$identitas->alamat}}</textarea>
              </div>
              <div class="form-group">
                <label for="kelurahan">Kelurahan</label>
                <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" value="{{$identitas->kelurahan}}" required>
              </div>
              <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{$identitas->kecamatan}}" required>
              </div>
              <div class="form-group">
                <label>Kota</label>
                <select name="kota_id" class="form-control">
                  @foreach($kotas as $kota)
                    <option value="{{$kota->id}}"
                    @if($identitas->kota_id==$kota->id)
                    selected
                    @endif>{{$kota->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{$identitas->provinsi}}" required>
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="website" value="{{$identitas->website}}" class="form-control" id="website" placeholder="Website">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" value="{{$identitas->email}}" class="form-control" id="email" placeholder="Email" required>
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
