@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mata Pelajaran yang Diajar
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> Mata Pelajaran</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tabel Mata Pelajaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mata Pelajaran</th>
                  <th>KKM</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($mapelBukas as $index => $mapelBuka)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}}</td>
                    <td>{{$mapelBuka->kkm}}</td>
                    <td><a class="btn btn-default btn-xs" href="{{url('guru/matapelajaran/'.$mapelBuka->id)}}"><span class="fa fa-edit"></span></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
