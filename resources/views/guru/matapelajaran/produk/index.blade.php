@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produk<br>
        <small>Kompetensi Dasar {{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/matapelajaran')}}"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
        <li><a href="{{url('guru/matapelajaran/'.$mapelBuka->id)}}">{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</a></li>
        <li class="active">Produk (KD)</li>
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
              <h3 class="box-title">Tabel Kompetensi Dasar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>KD</th>
                  <th>Deskripsi</th>
                  <th>Gasal/Genap</th>
                  <th class="no-sort">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($kompetensiDasars as $index => $kompetensiDasar)
                    <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$kompetensiDasar->nomor}}</td>
                    <td>{{$kompetensiDasar->deskripsi}}</td>
                    <td>
                        @if($kompetensiDasar->gasal_genap==1)
                            Gasal
                        @else
                            Genap
                        @endif
                    </td>
                    <td><a class="btn btn-default btn-xs" href="{{url('guru/matapelajaran/produk/'.$mapelBuka->id.'/kd/'.$kompetensiDasar->id)}}"><span class="fa fa-edit"></span></a></td>
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
