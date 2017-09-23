@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sekolah
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-hdd-o"></i> Data Lain</li>
        <li class="active">Sekolah</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-8">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Sekolah</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Negeri/Swasta</th>
                <th>Alamat</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($sekolahs as $index => $sekolah)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$sekolah->nama}}</td>
                  <td>@if($sekolah->negeri_swasta==0) Negeri @elseif($sekolah->negeri_swasta==1) Swasta @endif</td>
                  <td>{{$sekolah->alamat}}</td>
                  <td><a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/sekolah/'.$sekolah->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-4">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Sekolah Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/sekolah')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <label>Negeri/Swasta</label>
                <select name="negeri_swasta" class="form-control">
                    <option value="0">Negeri</option>
                    <option value="1">Swasta</option>
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required></textarea>
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
