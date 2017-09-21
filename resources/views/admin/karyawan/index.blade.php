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
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>No Telp</th>
                  <th>Agama</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  <th>Super</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($karyawans as $index => $karyawan)
                    <tr>
                    <td>{{$index+1}}</td>
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
                    <td>
                      @if ($karyawan->agama == 1)
                        Islam
                      @elseif ($karyawan->agama == 2)
                        Kristen Protestan
                      @elseif($karyawan->agama ==3)
                        Katolik
                      @elseif($karyawan->agama ==4)
                        Hindu
                      @elseif($karyawan->agama ==5)
                        Budha
                      @elseif($karyawan->agama ==6)
                        Konghucu
                      @endif
                    </td>
                    <td>{{$karyawan->user->username}}</td>
                    <td>
                      @if ($karyawan->user->role == 2)
                        Kepala Sekolah
                      @elseif ($karyawan->user->role == 3)
                        Guru
                      @endif
                    </td>
                    <td>
                      @if ($karyawan->super == 0)
                        Tidak
                      @elseif ($karyawan->super == 1)
                        Ya
                      @endif
                    </td>
                    <td><a class="btn btn-default btn-xs" href="{{url('admin/karyawan/'.$karyawan->id)}}"><span class="fa fa-eye"></span></a> <a class="btn btn-warning btn-xs" href="{{url('admin/karyawan/'.$karyawan->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                        <form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/karyawan/'.$karyawan->id)}}">
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
