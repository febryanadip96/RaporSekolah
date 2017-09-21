@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Catatan <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Catatan</li>
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
            <h3 class="box-title">Ubah Catatan Wali Kelas</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('guru/walikelas/catatan/'.$semesterSiswa->id)}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="catatan_walikelas">Catatan Wali Kelas</label>
                <textarea class="form-control" name="catatan_walikelas" rows="4" id="catatan_walikelas" placeholder="Catatan Wali Kelas" required>{{$semesterSiswa->catatan_walikelas}}</textarea>
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
