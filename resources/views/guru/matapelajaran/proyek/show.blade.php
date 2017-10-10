@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proyek<br>
        <small>KD {{$kd->nomor}} {{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/matapelajaran')}}"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
        <li><a href="{{url('guru/matapelajaran/'.$mapelBuka->id)}}">{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</a></li>
        <li><a href="{{url('guru/matapelajaran/proyek/'.$mapelBuka->id)}}">Proyek (KD)</a></li>
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
              <h3 class="box-title">Proyek</h3><br>
              <small>Deskripsi: {{$kd->deskripsi}}</small>
            </div>
            <!-- /.box-header -->
            <form role="form" class="form-update" action="{{url('guru/matapelajaran/proyek/'.$mapelBuka->id.'/kd/'.$kd->id)}}" method="post">
                {{ csrf_field() }}
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Nilai Proyek</th>
                    </tr>
                    @foreach($proyeks as $index => $proyek)
                    <tr>
                      <td>{{$proyek->nilaiRapor->semesterSiswa->siswa->nis}}</td>
                      <td>{{$proyek->nilaiRapor->semesterSiswa->siswa->user->name}}</td>
                      <td><input class="nilai" type="number" name="nilai[{{$proyek->id}}]" min="0" max="100" value="{{$proyek->nilai}}"></td>
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

<script>
	$(function() {
		$('.nilai').each(function(index){
			if ( $(this).val() < {{$mapelBuka->kkm}} ) {
    			$(this).addClass("has-error");
    		} else {
    			$(this).removeClass("has-error");
    		}
		 });
		 $('.nilai').keyup(function(){
 			if ( $(this).val() < {{$mapelBuka->kkm}} ) {
     			$(this).addClass("has-error");
     		} else {
     			$(this).removeClass("has-error");
     		}
 		 });
	});
</script>
@endsection
