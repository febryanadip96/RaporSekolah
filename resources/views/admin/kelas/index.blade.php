@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelas
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Kelas</li>
        <li class="active">Kelas</li>
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
              <h3 class="box-title">Tabel Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tingkat</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($kelas as $index => $kelas1)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$kelas1->tingkat}}</td>
                    <td><a class="btn btn-warning btn-xs" href="{{url('admin/kelas/'.$kelas1->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
            <h3 class="box-title">Kelas Baru</h3>
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
