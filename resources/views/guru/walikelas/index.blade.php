@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wali Kelas {{$kelasWaliKelas->nama}}
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-mortar-board"></i> Wali Kelas</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">KI-1 dan KI-2</a></li>
              <li><a href="#tab_2" data-toggle="tab">Ekstrakulikuler</a></li>
              <li><a href="#tab_3" data-toggle="tab">Prestasi</a></li>
              <li><a href="#tab_4" data-toggle="tab">Ketidakhadiran</a></li>
              <li><a href="#tab_5" data-toggle="tab">Catatan</a></li>
              <li><a href="#tab_6" data-toggle="tab">Cetak Rapor</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>KI-1</th>
                      <th>KI-2</th>
                      <th class="no-sort">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>{{$semesterSiswa->nilaiSikap->nilai_spiritual}}</td>
                        <td>{{$semesterSiswa->nilaiSikap->nilai_sosial}}</td>
                        <td><a class="btn btn-default btn-xs" href="{{url('guru/walikelas/nilaisikap/'.$semesterSiswa->nilaiSikap->id)}}"><span class="fa fa-edit"></span></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Ekstrakulikuler</th>
                      <th class="no-sort">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>
                            @foreach($semesterSiswa->nilaiEkstrakulikuler as $nilaiEkstrakulikuler)
                                @if ($loop->last)
                                    {{$nilaiEkstrakulikuler->ekstrakulikuler->nama}} ({{$nilaiEkstrakulikuler->nilai}})
                                @else
                                    {{$nilaiEkstrakulikuler->ekstrakulikuler->nama}} ({{$nilaiEkstrakulikuler->nilai}})<br>
                                @endif
                            @endforeach
                        </td>
                        <td><a class="btn btn-default btn-xs" href="{{url('guru/walikelas/ekstrakulikuler/'.$semesterSiswa->id)}}"><span class="fa fa-edit"></span></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Prestasi</th>
                      <th class="no-sort">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>
                            @foreach($semesterSiswa->prestasi as $prestasi)
                                @if ($loop->last)
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
                                @else
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
                                    )<br>
                                @endif
                            @endforeach
                        </td>
                        <td><a class="btn btn-default btn-xs" href="{{url('guru/walikelas/prestasi/'.$semesterSiswa->id)}}"><span class="fa fa-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab_4">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Ketidakhadiran</th>
                      <th class="no-sort">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>
                            Sakit: {{count($semesterSiswa->ketidakhadiran->where('status',0))}}<br>
                            Izin: {{count($semesterSiswa->ketidakhadiran->where('status',1))}}<br>
                            Tanpa Keterangan: {{count($semesterSiswa->ketidakhadiran->where('status',2))}}<br>
                        </td>
                        <td><a class="btn btn-default btn-xs" href="{{url('guru/walikelas/ketidakhadiran/'.$semesterSiswa->id)}}"><span class="fa fa-edit"></span></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <div class="tab-pane" id="tab_5">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Catatan</th>
                      <th class="no-sort">Cetak Rapor</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>{{$semesterSiswa->catatan_walikelas}}</td>
                        <td><a class="btn btn-default btn-xs" href="{{url('guru/walikelas/catatan/'.$semesterSiswa->id)}}"><span class="fa fa-edit"></span></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <div class="tab-pane" id="tab_6">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th class="no-sort">Rapor</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->nis}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>
                            @if($semesterSiswa->semester->gasal_genap==2)
                                <a class="btn btn-info btn-xs" href="{{url('guru/walikelas/aturkelulusan/'.$semesterSiswa->id)}}"><span class="fa fa-balance-scale"></span> Atur Kelulusan</a>
                            @endif
                            <a class="btn btn-warning btn-xs" href="{{url('guru/walikelas/cetakraportengahsemester/'.$semesterSiswa->id)}}"><span class="fa fa-print"></span> Tengah Semester</a>
                            <a class="btn btn-danger btn-xs" href="{{url('guru/walikelas/cetakraporakhirsemester/'.$semesterSiswa->id)}}"><span class="fa fa-print"></span> Akhir Semester</a>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
