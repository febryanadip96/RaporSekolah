@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Siswa Keluar/Pindah
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li class="active">Siswa Keluar/Pindah</li>
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
              <h3 class="box-title">Tabel Siswa Keluar/Pindah</h3>
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
                  <th>Keluar/Pindah</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($keluarPindahs as $index => $keluarPindah)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$keluarPindah->siswa->nis}}</td>
                    <td>{{$keluarPindah->siswa->nisn}}</td>
                    <td>{{$keluarPindah->siswa->user->name}}</td>
                    <td>
                      @if ($keluarPindah->siswa->jenis_kelamin == 0)
                        Laki-laki
                      @elseif ($keluarPindah->siswa->jenis_kelamin == 1)
                        Perempuan
                      @endif
                    </td>
                    <td>@if($keluarPindah->status==0) Keluar @elseif($keluarPindah->status==1) Pindah @endif</td>
                    <td><a class="btn btn-default btn-xs" href="{{url('admin/keluarpindah/'.$keluarPindah->id)}}"><span class="fa fa-eye"></span></a> <a class="btn btn-warning btn-xs" href="{{url('admin/keluarpindah/'.$keluarPindah->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
                        <form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/keluarpindah/'.$keluarPindah->id)}}">
                          {{ method_field('DELETE') }}{{ csrf_field() }}
                          <a class="update-modal btn btn-xs btn-default"><span class='fa fa-history'></span></a>
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
