@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Karyawan
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li class="active">Karyawan</li>
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
              <h3 class="box-title">Tabel Karyawan</h3>
              <a class="btn btn-success pull-right" href="{{url('admin/karyawan/create')}}"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>No Telp</th>
                  <th>Username</th>
                  <th>Super</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($karyawans as $index => $karyawan)
                    <tr>
	                    <td>{{$karyawan->nik}}</td>
	                    <td>{{$karyawan->user->name}}</td>
	                    <td>
	                      @if ($karyawan->jenis_kelamin == 0)
	                        Laki-laki
	                      @elseif ($karyawan->jenis_kelamin == 1)
	                        Perempuan
	                      @endif
	                    </td>
	                    <td>{{date('m/d/Y',strtotime($karyawan->tanggal_lahir))}}</td>
	                    <td>{{$karyawan->asal->nama}}</td>
	                    <td>{{$karyawan->no_telp}}</td>
	                    <td>{{$karyawan->user->username}}</td>
	                    <td>
	                      @if ($karyawan->super == 0)
	                        Tidak
	                      @elseif ($karyawan->super == 1)
	                        Ya
	                      @endif
	                    </td>
	                    <td>
							<a data-toggle="tooltip" title="Lihat" class="btn btn-default btn-xs" href="{{url('admin/karyawan/'.$karyawan->id)}}"><span class="fa fa-eye"></span></a>
							<a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/karyawan/'.$karyawan->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
							<a data-toggle="tooltip" title="Keluar" class="btn btn-danger btn-xs" href="{{url('admin/karyawan/keluar/'.$karyawan->id.'')}}"><span class="fa fa-sign-out"></span></a>
	                        <form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/karyawan/'.$karyawan->id)}}">
	                          {{ method_field('DELETE') }}{{ csrf_field() }}
	                          <a data-toggle="tooltip" title="Hapus" class="delete-modal btn btn-xs btn-danger"><span class='fa fa-trash'></span></a>
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
