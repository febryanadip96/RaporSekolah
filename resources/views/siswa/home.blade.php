@extends('layouts.appsiswa')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')

	  <div class="col-xs-12 col-sm-6">
        <div class="box box-primary">
          <div class="box-header with-border">
			  <h3 class="box-title">Data Siswa</h3>
			  <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	          </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
			  <table class="table table-striped">
				  <tr>
					  <td class="col-xs-4">Nama Peserta Didik (Lengkap):</td><td>{{Auth::user()->siswa->user->name}}</td>
				  </tr>
				  <tr>
					  <td>Nomor Induk/NISN:</td><td>{{Auth::user()->siswa->nisn}}</td>
				  </tr>
				  <tr>
					  <td>Tempat Tanggal Lahir:</td><td>{{Auth::user()->siswa->asal->nama}}, {{date('d-m-Y',strtotime(Auth::user()->siswa->tanggal_lahir))}}</td>
				  </tr>
				  <tr>
					  <td>Jenis Kelamin:</td>
					  <td>
						  @if (Auth::user()->siswa->jenis_kelamin == 0)
							Laki-laki
						  @elseif (Auth::user()->siswa->jenis_kelamin == 1)
							Perempuan
						  @endif
					  </td>
				  </tr>
				  <tr>
					  <td>Agama:</td>
					  <td>
						  @if (Auth::user()->siswa->agama == 0)
							  Islam
						  @elseif (Auth::user()->siswa->agama == 1)
							  Kristen Protestan
						  @elseif (Auth::user()->siswa->agama == 2)
							  Khatolik
						  @elseif (Auth::user()->siswa->agama == 3)
							  Hindu
						  @elseif (Auth::user()->siswa->agama == 4)
							  Budha
						  @elseif (Auth::user()->siswa->agama == 5)
							  Konghucu
						  @endif
					  </td>
				  </tr>
				  <tr>
					  <td>Anak Ke:</td><td>{{Auth::user()->siswa->anak_ke}}</td>
				  </tr>
				  <tr>
					  <td>Alamat Peserta Didik:</td><td>{{Auth::user()->siswa->alamat}}</td>
				  </tr>
				  <tr>
					  <td>Nomor Telpon Rumah:</td><td>{{Auth::user()->siswa->telpon_rumah}}</td>
				  </tr>
				  <tr>
					  <td>Sekolah Asal:</td><td>{{Auth::user()->siswa->sekolahAsal->nama}}</td>
				  </tr>
				  <tr>
					  <th colspan="2">Diterima Di Sekolah ini:</th>
				  </tr>
				  <tr>
					  <td>Di Kelas:</td><td>{{Auth::user()->siswa->masukKelasAwal->tingkat}}</td>
				  </tr>
				  <tr>
					  <td>Pada Tanggal:</td><td>{{date('d-m-Y',strtotime(Auth::user()->siswa->tanggal_masuk))}}</td>
				  </tr>
				  <tr>
					  <th colspan="2">Nama Orang Tua:</th>
				  </tr>
				  <tr>
					  <td>Ayah:</td><td>{{Auth::user()->siswa->ayah}}</td>
				  </tr>
				  <tr>
					  <td>Ibu:</td><td>{{Auth::user()->siswa->ibu}}</td>
				  </tr>
				  <tr>
					  <td>Alamat Orang Tua:</td><td>{{Auth::user()->siswa->alamat_ortu}}</td>
				  </tr>
				  <tr>
					  <td>Nomor Telpon Rumah:</td><td>{{Auth::user()->siswa->telpon_rumah_ortu}}</td>
				  </tr>
				  <tr>
					  <th colspan="2">Pekerjaan Orang Tua:</th>
				  </tr>
				  <tr>
					  <td>Ayah:</td><td>{{Auth::user()->siswa->pekerjaanAyah->nama}}</td>
				  </tr>
				  <tr>
					  <td>Ibu:</td><td>{{Auth::user()->siswa->pekerjaanIbu->nama}}</td>
				  </tr>
				  <tr>
					  <th colspan="2">Nama Wali Siswa:</th>
				  </tr>
				  <tr>
					  <td>Nama Wali Peserta Didik:</td><td>{{Auth::user()->siswa->wali}}</td>
				  </tr>
				  <tr>
					  <td>Alamat Wali Peserta Didik:</td><td>{{Auth::user()->siswa->alamat_wali}}</td>
				  </tr>
				  <tr>
					  <td>Nomor Telpon Rumah:</td><td>{{Auth::user()->siswa->telpon_rumah_wali}}</td>
				  </tr>
				  <tr>
					  <td>Pekerjaan Wali Peserta Didik:</td><td>{{Auth::user()->siswa->pekerjaanWali->nama}}</td>
				  </tr>
			  </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-xs-12 col-sm-6">
        <div class="box box-success">
          <div class="box-header with-border">
			  <h3 class="box-title">Lihat Rapor Semester</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
			  <table class="table table-bordered table-hover">
				<thead>
				<tr>
				  <th>No</th>
				  <th>Semester</th>
				  <th class="no-sort">Rapor</th>
				</tr>
				</thead>
				<tbody>
				  @foreach(Auth::user()->siswa->semesterSiswa as $index => $semesterSiswa)
					<tr>
					<td>{{$index+1}}</td>
					<td>{{$semesterSiswa->semester->gasal_genap === 1? "Gasal" : "Genap" }} {{$semesterSiswa->semester->tahunAjar->nama}}</td>
					<td>
						<a class="btn btn-default btn-xs" href="{{url('siswa/lihatrapor/'.$semesterSiswa->id)}}"><span class="fa fa-eye"></span></a>
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
