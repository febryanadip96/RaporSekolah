@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atur Kelulusan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li class="active"> Atur Kelulusan</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
		<!-- Widget: user widget style 1 -->
		<div class="box box-widget widget-user-2">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-blue">
			  	<h3>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</h3>
			</div>
			<div class="box-footer no-padding">
			  	<ul class="nav nav-stacked">
				  	<li><a>Total Mata Pelajaran yang Diambil <span class="pull-right badge bg-black">{{$banyakMataPelajaran}}</span></a></li>
				    <li><a>Ketidakhadiran Tanpa Keterangan <span class="pull-right badge bg-blue">{{$tanpaKeterangans}} dari {{round($batasKetidakhadiran)}}</span></a></li>
				    <li><a>Nilai Pengetahuan di bawah KKM <span class="pull-right badge bg-aqua">{{$nilaiPengetahuanBawahKkm}} dari 3</span></a></li>
				    <li><a>Nilai Ketrampilan di bawah KKM <span class="pull-right badge bg-green">{{$nilaiKetrampilanBawahKkm}} dari 3</span></a></li>
				    <li><a>Nilai Sikap Spiritual <span class="pull-right badge bg-yellow">{{$keteranganNilaiSikapSpiritual}}</span></a></li>
				    <li><a>Nilai Sikap Sosial <span class="pull-right badge bg-orange">{{$keteranganNilaiSikapSosial}}</span></a></li>
				    <li><a>Nilai Ekstrakulikuler Wajib <span class="pull-right badge bg-purple">{{$keteranganEkskul}}</span></a></li>
					<li><a>Status Kelulusan saat ini <span class="pull-right badge bg-red">@if($daftarKelas->status_lulus) Lulus @else Belum Lulus @endif</span></a></li>
			  	</ul>
		  </div>
		</div>
		<!-- /.widget-user -->
        <!-- general form elements -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Pilih Kelulusan</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <!-- /.box-body -->
          <form role="form" class="form-update" action="{{url('guru/walikelas/aturkelulusan/'.$semesterSiswa->id)}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
				<div class="form-group has-warning">
                  <label for="saran">Saran</label>
                  <input type="text" name="saran" class="form-control" id="saran" placeholder="Saran" value="{{$saran}}" readonly>
                </div>
              <!-- radio -->
              <div class="form-group has-warning">
                  <label>Lulus:</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="lulus" class="minimal" value="1" @if($lulus==true) checked @endif> Ya
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="lulus" class="minimal" value="0"  @if($lulus==false) checked @endif> Tidak
                  </label>
              </div>
            </div>

            <div class="box-footer">
              <a class="update-modal btn btn-warning">Simpan</a>
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
