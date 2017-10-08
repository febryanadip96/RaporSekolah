<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Rapor Online SMP Kartika Nasional</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" media="all">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}" media="all">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}" media="all">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}" media="all">
	<style>
		@page {
			size: A4;
		}
		@media print {
			.page {
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}
	</style>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="page">
		<div class="wrapper">
		  	<!-- Main content -->
			<section class="invoice">
  		    	<!-- info row -->
				<div class="row">
				<div class="col-xs-12 table-responsive">
					<h4 class="text-center">LAPORAN</h4>
					<h4 class="text-center">HASIL CAPAIAN KOMPETENSI PESERTA DIDIK</h4>
					<h4 class="text-center">SEKOLAH MENENGAH PERTAMA</h4>
					<h4 class="text-center">(SMP)</h4><br>
					<table class="table table-responsive">
						<tr>
							<td class="text-right col-xs-6">Nama Sekolah:</td><td>{{$sekolah->nama}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">NIS/NSS/NDS:</td><td>{{$sekolah->nis}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Alamat Sekolah:</td><td>{{$sekolah->alamat}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Kelurahan:</td><td>{{$sekolah->kelurahan}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Kecamatan:</td><td>{{$sekolah->kecamatan}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Kota/Kabupaten:</td><td>{{$sekolah->kota->nama}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Provinsi:</td><td>{{$sekolah->provinsi}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Website:</td><td>{{$sekolah->website}}</td>
						</tr>
						<tr>
							<td class="text-right col-xs-6">Email:</td><td>{{$sekolah->email}}</td>
						</tr>
					</table>
				</div>
			</div>
			</section>
	  	</div>
	</div>
	<div class="page">
		<div class="wrapper">
		  	<!-- Main content -->
			<section class="invoice">
  		    	<!-- info row -->
				<div class="row">
					<div class="col-xs-12 table-responsive">
					<h4 class="text-center">KETERANGAN TENTANG DIRI PESERTA DIDIK</h4><br>
					<table class="table table-striped">
						<tr>
							<td class="col-xs-4">Nama Peserta Didik (Lengkap):</td><td>{{$semesterSiswa->siswa->user->name}}</td>
						</tr>
						<tr>
							<td>Nomor Induk/NISN:</td><td>{{$semesterSiswa->siswa->nisn}}</td>
						</tr>
						<tr>
							<td>Tempat Tanggal Lahir:</td><td>{{$semesterSiswa->siswa->asal->nama}}, {{date('d-m-Y',strtotime($semesterSiswa->siswa->tanggal_lahir))}}</td>
						</tr>
						<tr>
							<td>Jenis Kelamin:</td>
							<td>
								@if ($semesterSiswa->siswa->jenis_kelamin == 0)
		                          Laki-laki
		                        @elseif ($semesterSiswa->siswa->jenis_kelamin == 1)
		                          Perempuan
		                        @endif
							</td>
						</tr>
						<tr>
							<td>Agama:</td>
							<td>
								@if ($semesterSiswa->siswa->agama == 0)
		                          	Islam
		                        @elseif ($semesterSiswa->siswa->agama == 1)
		                          	Kristen Protestan
							  	@elseif ($semesterSiswa->siswa->agama == 2)
	  	                          	Khatolik
								@elseif ($semesterSiswa->siswa->agama == 3)
	  	                          	Hindu
								@elseif ($semesterSiswa->siswa->agama == 4)
	  	                          	Budha
								@elseif ($semesterSiswa->siswa->agama == 5)
	  	                          	Konghucu
		                        @endif
							</td>
						</tr>
						<tr>
							<td>Anak Ke:</td><td>{{$semesterSiswa->siswa->anak_ke}}</td>
						</tr>
						<tr>
							<td>Alamat Peserta Didik:</td><td>{{$semesterSiswa->siswa->alamat}}</td>
						</tr>
						<tr>
							<td>Nomor Telpon Rumah:</td><td>{{$semesterSiswa->siswa->telpon_rumah}}</td>
						</tr>
						<tr>
							<td>Sekolah Asal:</td><td>{{$semesterSiswa->siswa->sekolahAsal->nama}}</td>
						</tr>
						<tr>
							<td colspan="2">Diterima Di Sekolah ini:</td>
						</tr>
						<tr>
							<td>Di Kelas:</td><td>{{$semesterSiswa->siswa->masukKelasAwal->tingkat}}</td>
						</tr>
						<tr>
							<td>Pada Tanggal:</td><td>{{date('d-m-Y',strtotime($semesterSiswa->siswa->tanggal_masuk))}}</td>
						</tr>
						<tr>
							<td colspan="2">Nama Orang Tua:</td>
						</tr>
						<tr>
							<td>Ayah:</td><td>{{$semesterSiswa->siswa->ayah}}</td>
						</tr>
						<tr>
							<td>Ibu:</td><td>{{$semesterSiswa->siswa->ibu}}</td>
						</tr>
						<tr>
							<td>Alamat Orang Tua:</td><td>{{$semesterSiswa->siswa->alamat_ortu}}</td>
						</tr>
						<tr>
							<td>Nomor Telpon Rumah:</td><td>{{$semesterSiswa->siswa->telpon_rumah_ortu}}</td>
						</tr>
						<tr>
							<td colspan="2">Pekerjaan Orang Tua:</td>
						</tr>
						<tr>
							<td>Ayah:</td><td>{{$semesterSiswa->siswa->pekerjaanAyah->nama}}</td>
						</tr>
						<tr>
							<td>Ibu:</td><td>{{$semesterSiswa->siswa->pekerjaanIbu->nama}}</td>
						</tr>
						<tr>
							<td>Nama Wali Peserta Didik:</td><td>{{$semesterSiswa->siswa->wali}}</td>
						</tr>
						<tr>
							<td>Alamat Wali Peserta Didik:</td><td>{{$semesterSiswa->siswa->alamat_wali}}</td>
						</tr>
						<tr>
							<td>Nomor Telpon Rumah:</td><td>{{$semesterSiswa->siswa->telpon_rumah_wali}}</td>
						</tr>
						<tr>
							<td>Pekerjaan Wali Peserta Didik:</td><td>{{$semesterSiswa->siswa->pekerjaanWali->nama}}</td>
						</tr>
					</table>
				</div>
				</div>
			</section>
	  	</div>
	</div>
    <div class="page">
		<div class="wrapper">
		  <!-- Main content -->
		  	<section class="invoice">
			    <!-- info row -->
			    <div class="row">
			      <!-- /.col -->
			      <div class="col-xs-6">
			        <table>
			            <tr>
			              <td>Nama Siswa</td><td>: {{$semesterSiswa->siswa->user->name}}</td>
			            </tr>
			            <tr>
			              <td>NISN/NIS</td><td>: {{$semesterSiswa->siswa->nis}}</td>
			            </tr>
			            <tr>
			              <td>Nama Sekolah</td><td>: {{$sekolah->nama}}</td>
			            </tr>
			            <tr>
			              <td>Alamat</td><td>: {{$sekolah->alamat}}</td>
			            </tr>
			          </table>
			      </div>
					<div class="col-xs-6">
			        	<table>
				            <tr>
				              <td>Kelas</td><td>: {{$semesterSiswa->kelasBuka->nama}}</td>
				            </tr>
				            <tr>
				              <td>Semester</td><td>: {{$semesterSiswa->semester->gasal_genap}}</td>
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

						<h3><b>G. Tanggapan Orangtua/Wali Siswa</b></h3>
						<hr style="border-top: dotted 1px;" />
						<hr style="border-top: dotted 1px;" />
						<hr style="border-top: dotted 1px;" /><br>

						<div col-xs-12>
							<div class="pull-left">
							    Orang Tua/Wali Siswa<br><br><br><br><br>
							    (................................)
							</div>

							<div class="pull-right">
								Surabaya, {{$tanggalHariIni}}<br><br><br><br><br>
								<p class="text-center">{{$semesterSiswa->kelasBuka->waliKelas->user->name}}</p>
							</div>
						</div>
						<div>
							<div class="col-xs-12">
						          <div class="text-center">
						              Kepala Sekolah<br><br><br><br><br>
						              <u>{{$kepalaSekolah->name}}</u>
						          </div>
						      </div>
						</div>
					</div>
					<!-- /.col -->
			    </div>
			    <!-- /.row -->
		  	</section>
		  <!-- /.content -->
		</div>
		<!-- ./wrapper -->
    </div>
</body>
</html>
