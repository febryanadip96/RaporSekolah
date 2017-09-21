@extends('layouts.appguru')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ekstrakulikuler <small>{{$nilaiEkstrakulikuler->semesterSiswa->siswa->user->name}} ({{$nilaiEkstrakulikuler->semesterSiswa->siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('guru/walikelas')}}"><i class="fa fa-mortar-board"></i> Wali Kelas</a></li>
        <li><a href="{{url('guru/walikelas/ekstrakulikuler/'.$nilaiEkstrakulikuler->semesterSiswa->id)}}">Ekstrakulikuler</a></li>
        <li class="active"> Ekstrakulikuler (Edit)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <div class="box box-warning">
          <div class="box-header">
            <h3 class="box-title">Edit Nilai Ekstrakulikuler</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" class="form-update" action="{{url('guru/walikelas/ekstrakulikuler/'.$nilaiEkstrakulikuler->id)}}" method="post">
              {{ csrf_field() }}
              {{method_field("PUT")}}
              <div class="form-group">
                <label>Ekstrakulikuler</label>
                <select name="ekstrakulikuler_id" class="form-control select2" style="width: 100%;">
                  @foreach($ekskulPilihans as $ekskulPilihan)
                    <option value="{{$ekskulPilihan->id}}" @if($ekskulPilihan->id==$nilaiEkstrakulikuler->ekstrakulikuler_id) selected @endif>{{$ekskulPilihan->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" class="form-control" id="nilai" placeholder="Nilai" value="{{$nilaiEkstrakulikuler->nilai}}" required>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a class="update-modal btn btn-warning">Simpan</a>
          </div>
          </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
