@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Peringkat
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-hdd-o"></i> Data Lain</li>
        <li class="active">Peringkat</li>
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
            <h3 class="box-title">Tabel Peringkat</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Juara</th>
                <th class="no-sort">Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach($peringkats as $index => $peringkat)
                  <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$peringkat->juara}}</td>
                  <td><a class="btn btn-warning btn-xs" href="{{url('admin/peringkat/'.$peringkat->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
            <h3 class="box-title">Tambah Peringkat Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/peringkat')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="juara">Juara</label>
                <input type="text" name="juara" class="form-control" id="juara" placeholder="Juara" required>
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
