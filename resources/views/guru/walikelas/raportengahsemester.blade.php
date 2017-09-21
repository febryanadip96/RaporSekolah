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
		      <!-- /.col -->
		      <div class="col-sm-12 text-center">
            <h2>{{$sekolah->nama}}</h2>
            <h4>Laporan Hasil Belajar Siswa</h4>
            <small>(Tengah Semester @if($semesterSiswa->semester->gasal_genap==1) Gasal @else Genap @endif)</small><br>
					</div>
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
		          <table class="table table-striped">
		            <thead>
		            <tr>
		              <th>No</th>
		              <th>Mata Pelajaran</th>
		              <th>KKM</th>
		              <th>Tugas</th>
		              <th>UH</th>
		              <th>PTS</th>
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
		                          <td>{{($semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->tugas->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
		                          <td>{{($semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->ulanganHarian->where('nilai_akhir','!=',null)->pluck('nilai_akhir'))->avg()}}</td>
		                          <td>{{$semesterSiswa->nilaiRapor->whereIn('mapel_buka_id',$mataPelajaran->mapelBuka->pluck('id'))->first()->nilai_pts}}</td>
		                        </tr>
		                        @endif
		                      @endif
		                  @endforeach
		                @endforeach
		            </tbody>
		          </table>
		      </div>
		      <div class="col-xs-4 table-responsive">
		              <table class="table table-striped">
		                  <tr><th colspan="6">Ketidakhadiran</th></tr>
		                  <tr><td colspan="2">Sakit</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',0))}} hari</td></tr>
		                  <tr><td colspan="2">Izin</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',1))}} hari</td></tr>
		                  <tr><td colspan="2">Tanpa Keterangan</td><td colspan="4">{{count($semesterSiswa->ketidakhadiran->where('status',2))}} hari</td></tr>
		              </table>
		      </div>
		      <div class="col-xs-12">
		          <br>
		          <b>Catatan Wali Kelas</b><br>
		          <p>{{$semesterSiswa->siswa->user->name}} {{$semesterSiswa->catatan_walikelas}}</p>
		          <b>Tanggapan Orangtua/Wali Siswa</b>
		          <hr style="border-top: dotted 1px;" />
		          <hr style="border-top: dotted 1px;" />
		          <hr style="border-top: dotted 1px;" /><br>

		          <div>
		            <div class="pull-left">
		                Orang Tua/Wali Siswa<br><br><br><br><br>
		                (................................)
		            </div>

		            <div class="pull-right">
		              Surabaya, {{$tanggalHariIni}}<br><br><br><br><br>
		              <p class="text-center">{{$semesterSiswa->kelasBuka->waliKelas->user->name}}</p>
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
