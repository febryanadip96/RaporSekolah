@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produk<br>
        <small>KD {{$kd->nomor}} {{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/matapelajaran')}}"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
        <li><a href="{{url('guru/matapelajaran/'.$mapelBuka->id)}}">{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</a></li>
        <li><a href="{{url('guru/matapelajaran/produk/'.$mapelBuka->id)}}">Produk (KD)</a></li>
        <li class="active">KD {{$kd->nomor}}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Produk</h3><br>
              <small>Deskripsi: {{$kd->deskripsi}}</small>
            </div>
            <!-- /.box-header -->
            <form role="form" class="form-update" action="{{url('guru/matapelajaran/produk/'.$mapelBuka->id.'/kd/'.$kd->id)}}" method="post">
                {{ csrf_field() }}
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Nilai Produk</th>
                    </tr>
                    @foreach($produks as $index => $produk)
                    <tr>
                      <td>{{$produk->nilaiRapor->semesterSiswa->siswa->nis}}</td>
                      <td>{{$produk->nilaiRapor->semesterSiswa->siswa->user->name}}</td>
                      <td><input type="number" name="nilai[{{$produk->id}}]" min="0" max="100" value="{{$produk->nilai}}"></td>
                    </tr>
                    @endforeach
                  </table>
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
