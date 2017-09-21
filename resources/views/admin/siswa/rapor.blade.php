@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Rapor Siswa <small>{{$semesterSiswa->siswa->user->name}} ({{$semesterSiswa->siswa->nis}})</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><i class="fa fa-users"></i> Anggota</li>
		<li><a href="{{url('admin/siswa')}}">Siswa</a></li>
		<li><a href="{{url('admin/siswa/semester/'.$semesterSiswa->siswa->id)}}">Pilih Semester Siswa</a></li>
		<li class="active">Rapor Siswa</li>
	  </ol>
	</section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">

          </div>
          <!-- /.box-header -->
          <div class="box-body">
				<!-- Main content -->
				<section class="invoice">
				<!-- info row -->
				<div class="row">
				  <!-- /.col -->
				  <div class="col-sm-12">
				      <div class="text-center">
				          <h2>SMP Kartika Nasional</h2>
				          <h4>Laporan Hasil Belajar Siswa</h4>
				          <small>(Semester @if($semesterSiswa->semester->gasal_genap==1) Gasal @else Genap @endif {{$semesterSiswa->semester->tahunAjar->nama}})</small>
				      </div>
				  </div><br>
				  <div class="col-sm-12">
				    <table>
				        <tr>
				          <td>Nama Siswa</td><td>: {{$semesterSiswa->siswa->user->name}}</td>
				        </tr>
				        <tr>
				          <td>No. Induk Sekolah</td><td>: {{$semesterSiswa->siswa->nis}}</td>
				        </tr>
				        <tr>
				          <td>Kelas</td><td>: {{$semesterSiswa->kelasBuka->nama}}</td>
				        </tr>
				        <tr>
				          <td>Tahun Ajar</td><td>: {{$semesterSiswa->semester->tahunAjar->nama}}</td>
				        </tr>
				      </table>
				  </div>
				</div><br>
				<!-- /.row -->

				<!-- Table row -->
				<div class="row">
					<div class="col-xs-12 table-responsive">
					  <h3><b>A. Sikap</b></h3>
					  <table class="table table-striped">
					    <thead>
					    <tr>
					      <th>Sikap</th>
					      <th>Predikat</th>
					      <th>Deskripsi<th>
					    </tr>
					    </thead>
					    <tbody
							<tr>
								<td>Spiritual</td>
								<td>{{$semesterSiswa->nilaiSikap->predikatSpiritual->predikat_ki1_ki2}}</td>
								<td>{{$semesterSiswa->nilaiSikap->deskripsi_spiritual}}</td>
							</tr>

							<tr>
								<td>Sosial</td>
								<td>{{$semesterSiswa->nilaiSikap->predikatSosial->predikat_ki1_ki2}}</td>
								<td>{{$semesterSiswa->nilaiSikap->deskripsi_sosial}}</td>
							</tr>
					    </tbody>
					  </table>
					</div>
					<div class="col-xs-12 table-responsive">
					  <h3><b>B. Pengetahuan dan Ketrampilan</b></h3>
					  <small>Pengetahuan</small>
					  <table class="table table-striped">
					    <thead>
					    <tr>
					      <th>No</th>
					      <th>Mata Pelajaran</th>
					      <th>KKM</th>
					      <th>Angka</th>
					      <th>Predikat</th>
					    </tr>
					    </thead>
					    <tbody>
					        @php
					          $index=1
					        @endphp
					        @foreach($kelompoks as $kelompok)
					          <tr><th></th><th colspan="5">Kelompok {{$kelompok->nama}}</th></tr>
					          @foreach($kelompok->mataPelajaran->sortBy('urutan') as $mataPelajaran)
					              @if(count($mataPelajaran->mapelBuka)!=0)
					                @if(count($semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id')))!=0)
					                <tr>
					                  <td>{{$index++}}</td>
					                  <td><b>{{$mataPelajaran->nama}} {{$mataPelajaran->keterangan}}</b> <br> Pengajar: {{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->mapelBuka->pengajar->user->name}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->mapelBuka->kkm}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->nilai_pengetahuan}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->predikatPengetahuan->predikat_ki3_ki4}}</td>
					                </tr>
					                @endif
					              @endif
					          @endforeach
					        @endforeach
					    </tbody>
					  </table>

					  <small>Ketrampilan</small>
					  <table class="table table-striped">
					    <thead>
					    <tr>
					      <th>No</th>
					      <th>Mata Pelajaran</th>
					      <th>KKM</th>
					      <th>Angka</th>
					      <th>Predikat</th>
					    </tr>
					    </thead>
					    <tbody>
					        @php
					          $index=1
					        @endphp
					        @foreach($kelompoks as $kelompok)
					          <tr><th></th><th colspan="5">Kelompok {{$kelompok->nama}}</th></tr>
					          @foreach($kelompok->mataPelajaran->sortBy('urutan') as $mataPelajaran)
					              @if(count($mataPelajaran->mapelBuka)!=0)
					                @if(count($semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id')))!=0)
					                <tr>
					                  <td>{{$index++}}</td>
					                  <td><b>{{$mataPelajaran->nama}} {{$mataPelajaran->keterangan}}</b> <br> Pengajar: {{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->mapelBuka->pengajar->user->name}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->mapelBuka->kkm}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->nilai_ketrampilan}}</td>
					                  <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->predikatKetrampilan->predikat_ki3_ki4}}</td>
					                </tr>
					                @endif
					              @endif
					          @endforeach
					        @endforeach
					    </tbody>
					  </table>
					</div>
					<div class="col-xs-12 table-responsive">
					  <h3><b>C. Ekstrakulikuler</b></h3>
					  <table class="table table-striped">
					    <thead>
					    <tr>
					      <th>Kegiatan Ekstrakulikuler</th>
					      <th>Keterangan</th>
					    </tr>
					    </thead>
					    <tbody
							@foreach($semesterSiswa->nilaiEkstrakulikuler as $nilaiEkstrakulikuler)
								<tr>
									<td>{{$nilaiEkstrakulikuler->ekstrakulikuler->nama}}</td>
									<td>{{$nilaiEkstrakulikuler->predikat->predikat_ki1_ki2}}</td>
								</tr>
							@endforeach
					    </tbody>
					  </table>
					</div>
					<div class="col-xs-6 table-responsive">
						<h3><b>D. Ketidakhadiran</b></h3>
						<table class="table table-striped">
							<tr><th colspan="6">Ketidakhadiran</th></tr>
							<tr><td colspan="2">Sakit</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',0))}} hari</td></tr>
							<tr><td colspan="2">Izin</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',1))}} hari</td></tr>
							<tr><td colspan="2">Tanpa Keterangan</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',2))}} hari</td></tr>
						</table>
					</div>
					<div class="col-xs-6 table-responsive">
						<h3><b>Keputusan:</b><br></h3>
						<p>{{$statusKelulusan}}</p>
					</div>
					<div class="col-xs-12 table-responsive">
					  <h4><b>E. Prestasi</b></h4>
					  <table class="table table-striped">
					    <thead>
					    <tr>
					      <th>Nomor</th>
					      <th>Prestasi</th>
					    </tr>
					    </thead>
					    <tbody
							@foreach($semesterSiswa->prestasi as $index => $prestasi)
								<tr>
									<td>{{$index+1}}</td>
									<td>
										{{$prestasi->peringkat->juara}} {{$prestasi->nama_lomba}} (tingkat
				                        @if($prestasi->tingkat==0)
				                            Sekolah
				                        @elseif($prestasi->tingkat==1)
				                            Kecamatan
				                        @elseif($prestasi->tingkat==2)
				                            Kabupaten
				                        @elseif($prestasi->tingkat==3)
				                            Provinsi
				                        @elseif($prestasi->tingkat==4)
				                            Nasional
				                        @elseif($prestasi->tingkat==5)
				                            Internasional
				                        @endif
				                        )
									</td>
								</tr>
							@endforeach
					    </tbody>
					  </table>
					</div>
					<div class="col-xs-12">
						<h3><b>F. Catatan Wali Kelas</b></h3>
						<p>{{$semesterSiswa->siswa->user->name}} {{$semesterSiswa->catatan_walikelas}}</p>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
				</section>
				<!-- /.content -->
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
