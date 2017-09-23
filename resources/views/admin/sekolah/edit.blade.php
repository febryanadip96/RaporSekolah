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
        <li><a href="{{url('admin/sekolah')}}">Sekolah</a></li>
        <li class="active">Sekolah (Edit)</li>
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
            <h3 class="box-title">Ubah Data Sekolah</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/sekolah/'.$sekolah->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="{{$sekolah->nama}}" required>
              </div>
							<!-- radio -->
              <div class="form-group">
                  <label>Negeri/Swasta</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="negeri_swasta" class="minimal" value="0" @if($sekolah->negeri_swasta==0) checked @endif> Negeri
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="negeri_swasta" class="minimal" value="1" @if($sekolah->negeri_swasta==1) checked @endif> Swasta
                  </label>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" id="alamat" placeholder="Alamat" required>{{$sekolah->alamat}}</textarea>
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
