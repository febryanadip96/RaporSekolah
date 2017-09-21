@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Karyawan Keluar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li class="active">Karyawan Keluar</li>
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
              <h3 class="box-title">Tabel Guru Keluar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Ijazah Tertinggi</th>
                  <th>Jenis Kelamin</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($karyawans as $index => $karyawan)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$karyawan->user->name}}</td>
                    <td>{{$karyawan->ijazah->nama}}</td>
                    <td>
                      @if ($karyawan->jenis_kelamin == 0)
                        Laki-laki
                      @elseif ($karyawan->jenis_kelamin == 1)
                        Perempuan
                      @endif
                    </td>
                    <td><a data-toggle="tooltip" title="Lihat" class="btn btn-default btn-xs" href="{{url('admin/gurukeluar/'.$karyawan->id)}}"><span class="fa fa-eye"></span></a>
                        <form style="display: inline-block" method="post" class="form-delete" action="{{url('admin/gurukeluar/'.$karyawan->id)}}">
                          {{ method_field('DELETE') }}{{ csrf_field() }}
                          <a data-toggle="tooltip" title="Restore" class="update-modal btn btn-xs btn-default"><span class='fa fa-history'></span></a>
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
