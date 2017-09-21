@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Predikat
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-hdd-o"></i> Data Lain</li>
        <li><a href="{{url('admin/predikat')}}">Predikat</a></li>
        <li class="active">Predikat (Edit)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Data Predikat</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" class="form-update" action="{{url('admin/predikat/'.$predikat->id)}}" method="post">
            {{ csrf_field() }}
            {{method_field("PUT")}}
            <div class="box-body">
              <div class="form-group">
                <label for="nilai_awal">Nilai Awal</label>
                <input type="number" min="0" max="100" name="nilai_awal" class="form-control" id="nilai_awal" placeholder="Nilai awal" value="{{$predikat->nilai_awal}}" required>
              </div>
              <div class="form-group">
                <label for="nilai_akhir">Nilai Akhir</label>
                <input type="number" min="0" max="100" name="nilai_akhir" class="form-control" id="nilai_akhir" placeholder="Nilai akhir" value="{{$predikat->nilai_akhir}}" required>
              </div>
              <div class="form-group">
                <label for="predikat_ki3_ki4">Predikat KI-4 & KI-3</label>
                <input type="text" name="predikat_ki3_ki4" class="form-control" id="predikat_ki3_ki4" placeholder="Predikat KI-3 & KI-4" value="{{$predikat->predikat_ki3_ki4}}" required>
              </div>
              <div class="form-group">
                <label for="predikat_ki1_ki2">Predikat KI-1 & KI-2</label>
                <input type="text" name="predikat_ki1_ki2" class="form-control" id="predikat_ki1_ki2" placeholder="Predikat KI-1 & KI-2" value="{{$predikat->predikat_ki1_ki2}}" required>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Lulus KI1 & KI-2</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="lulus_ki1_ki2" class="minimal" value="1" @if($predikat->lulus_ki1_ki2==1) checked @endif> Ya
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="lulus_ki1_ki2" class="minimal" value="0"  @if($predikat->lulus_ki1_ki2==0) checked @endif> Tidak
                  </label>
              </div>
            </div>
            <!-- /.box-body -->

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
