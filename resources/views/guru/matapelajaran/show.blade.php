@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/matapelajaran')}}"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
        <li class="active">{{$mapelBuka->mataPelajaran->nama}} {{$mapelBuka->mataPelajaran->keterangan}} {{$mapelBuka->kelasBuka->nama}}</li>
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
              <li class="active"><a href="#tab_kkm" data-toggle="tab">KKM</a></li>
              <li><a href="#tab_ki3" data-toggle="tab">Pengetahuan (KI-3)</a></li>
              <li><a href="#tab_ki4" data-toggle="tab">Ketrampilan (KI-4)</a></li>
              <li><a href="#tab_hasil" data-toggle="tab">Hasil Akhir</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_kkm">
                    <h4 class="box-title">Setting KKM</h4>
                    <!-- form start -->
                    <form role="form" class="form-update" action="{{url('guru/matapelajaran/kkm'.$mapelBuka->id)}}" method="post">
                        {{ csrf_field() }}
                        {{method_field("PUT")}}
                        <div class="form-group">
                          <label for="kkm">KKM</label>
                          <input type="number" name="kkm" class="form-control" id="kkm" placeholder="KKM" value="{{$mapelBuka->kkm}}" required>
                        </div>
                        <a class="update-modal btn btn-warning">Simpan</a>
                    </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_ki3">
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/ptspas/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> PTS & PAS
                  </a>
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/uh/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> Ulangan Harian
                  </a>
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/tugas/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> Tugas
                  </a>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_ki4">
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/praktek/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> (P1) PRAKTEK
                  </a>
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/portofolio/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> (P2) PORTOFOLIO
                  </a>
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/proyek/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> (P3) PROYEK
                  </a>
                  <a class="btn btn-app" href="{{url('guru/matapelajaran/produk/'.$mapelBuka->id)}}">
                    <i class="fa fa-edit"></i> (P4) PRODUK
                  </a>
              </div>
              <div class="tab-pane" id="tab_hasil">
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>UH</th>
                      <th>Tugas</th>
                      <th>PTS</th>
                      <th>PAS</th>
                      <th>NA KI-3</th>
                      <th>P1</th>
                      <th>P2</th>
                      <th>P3</th>
                      <th>P4</th>
                      <th>NA KI-4</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($semesterSiswas as $index => $semesterSiswa)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$semesterSiswa->siswa->user->name}}</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->ulanganHarian->where('nilai_akhir','!=',null)->pluck('nilai_akhir'))->avg()}}</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->tugas->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
                        <td>{{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->nilai_pts}}</td>
                        <td>{{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->nilai_pas}}</td>
                        <td>{{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->nilai_pengetahuan}} ({{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->predikatPengetahuan->predikat_ki3_ki4}})</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->ketrampilan->where('kategori',1)->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->ketrampilan->where('kategori',2)->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->ketrampilan->where('kategori',3)->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
                        <td>{{($semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->ketrampilan->where('kategori',4)->where('nilai','!=',null)->pluck('nilai'))->avg()}}</td>
                        <td>{{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->nilai_ketrampilan}} ({{$semesterSiswa->nilaiRapor->where('mapel_buka_id',$mapelBuka->id)->first()->predikatKetrampilan->predikat_ki3_ki4}})</td>
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
