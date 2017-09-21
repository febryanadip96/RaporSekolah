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
        <li class="active">Siswa</li>
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
              <h3 class="box-title">Tabel Siswa</h3>
              <a class="btn btn-success pull-right" href="{{url('admin/siswa/create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>Rapor</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($siswas as $index => $siswa)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$siswa->nis}}</td>
                    <td>{{$siswa->nisn}}</td>
                    <td>{{$siswa->user->name}}</td>
                    <td>
                      @if ($siswa->jenis_kelamin == 0)
                        Laki-laki
                      @elseif ($siswa->jenis_kelamin == 1)
                        Perempuan
                      @endif
                    </td>
                    <td>{{date('m/d/Y',strtotime($siswa->tanggal_lahir))}}</td>
                    <td>{{$siswa->asal->nama}}</td>
                    <td>
						<a class="btn btn-default btn-xs" href="{{url('admin/siswa/semester/'.$siswa->id)}}"><span class="fa fa-file-o"></span></a>
                    </td>
                    <td><a class="btn btn-default btn-xs" href="{{url('admin/siswa/'.$siswa->id)}}"><span class="fa fa-eye"></span></a> <a class="btn btn-warning btn-xs" href="{{url('admin/siswa/'.$siswa->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                    <form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/siswa/'.$siswa->id)}}">
                      {{ method_field('DELETE') }}{{ csrf_field() }}
                      <a class="delete-modal btn btn-xs btn-danger"><span class='fa fa-sign-out'></span></a>
                    </form>
                    </td>
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
