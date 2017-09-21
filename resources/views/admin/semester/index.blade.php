@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semester
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-calendar"></i> Tahun Ajar</li>
        <li class="active">Semester</li>
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
              <h3 class="box-title">Tabel Semester</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Tutup Tengah Semester</th>
                  <th>Tutup Akhir Semester</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($semesters as $index => $semester)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{ $semester->gasal_genap === 1? "Gasal" : "Genap" }} {{$semester->tahunAjar->nama}}</td>
                    <td>{{$semester->status === 1? "Aktif" : "Tidak Aktif"}}</td>
                    <td>{{$semester->awal_tutup_tengah_semester==null && $semester->akhir_tutup_tengah_semester==null? '':date('m/d/Y h:i A',strtotime($semester->awal_tutup_tengah_semester)).' - '.date('m/d/Y h:i A',strtotime($semester->akhir_tutup_tengah_semester))}}</td>
                    <td>{{$semester->awal_tutup_akhir_semester==null && $semester->akhir_tutup_akhir_semester==null? '':date('m/d/Y h:i A',strtotime($semester->awal_tutup_akhir_semester)).' - '.date('m/d/Y h:i A',strtotime($semester->akhir_tutup_akhir_semester))}}</td>
                    <td><a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/semester/'.$semester->id.'/edit')}}"><span class="fa fa-pencil"></span></a></td>
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
