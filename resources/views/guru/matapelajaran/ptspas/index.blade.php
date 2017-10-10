@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PTS & PAS
        <small>{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/matapelajaran')}}"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
        <li><a href="{{url('guru/matapelajaran/'.$mapelBuka->id)}}">{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</a></li>
        <li class="active">PTS & PAS</li>
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
              <h3 class="box-title">PTS & PAS</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" class="form-update" action="{{url('guru/matapelajaran/ptspas/'.$mapelBuka->id)}}" method="post">
                {{ csrf_field() }}
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>PTS</th>
                      <th>PAS</th>
                    </tr>
                    @foreach($nilaiRapors as $index => $nilaiRapor)
                    <tr>
                      <td>{{$nilaiRapor->semesterSiswa->siswa->nis}}</td>
                      <td>{{$nilaiRapor->semesterSiswa->siswa->user->name}}</td>
                      <td><input class="pts" type="number" name="pts[{{$nilaiRapor->id}}]" min="0" max="100" value="{{$nilaiRapor->nilai_pts!=null? $nilaiRapor->nilai_pts:0 }}" required></td>
                      <td><input class="pas" type="number" name="pas[{{$nilaiRapor->id}}]" min="0" max="100" value="{{$nilaiRapor->nilai_pas!=null? $nilaiRapor->nilai_pas:0 }}" required></td>
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
		$('.pts, .pas').each(function(index){
			if ( $(this).val() < {{$mapelBuka->kkm}} ) {
    			$(this).addClass("has-error");
    		} else {
    			$(this).removeClass("has-error");
    		}
		 });
		 $('.pts, .pas').keyup(function(){
 			if ( $(this).val() < {{$mapelBuka->kkm}} ) {
     			$(this).addClass("has-error");
     		} else {
     			$(this).removeClass("has-error");
     		}
 		 });
	});
</script>
@endsection
