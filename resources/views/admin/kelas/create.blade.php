@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kota
      </h1>
      <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Kelas</li>
          <li>Kelas</li>
          <li><a href="{{url('admin/kelas')}}">Kelas</a></li>
        <li class="active">Kelas (Create)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')

      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Kelas Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/kelas')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="tingkat">Tingkat</label>
                <input type="number" name="tingkat" class="form-control" id="tingkat" placeholder="Tingkat kelas" required>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
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
