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
        <li class="active">Predikat</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-8">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Tabel Predikat</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nilai Awal</th>
						<th>Nilai Akhir</th>
						<th>Predikat KI3 & KI4</th>
						<th>Predikat KI1 & KI2</th>
						<th>Lulus KI1 & KI2</th>
						<th class="no-sort">Aksi</th>
					</tr>
				</thead>
				<tbody>
                @foreach($predikats as $index => $predikat)
                  	<tr>
	                  	<td>{{$index+1}}</td>
	                  	<td>{{$predikat->nilai_awal}}</td>
	                  	<td>{{$predikat->nilai_akhir}}</th>
	                  	<td>{{$predikat->predikat_ki3_ki4}}</td>
	                  	<td>{{$predikat->predikat_ki1_ki2}}</td>
	                  	<td>@if($predikat->lulus_ki1_ki2==1) Ya @else Tidak @endif</td>
	                  	<td><a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/predikat/'.$predikat->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
							<form  style="display: inline-block" method="post" class="form-delete" action="{{url('admin/predikat/'.$predikat->id)}}">
			                  	{{ method_field('DELETE') }}{{ csrf_field() }}
		                  		<a data-toggle="tooltip" title="Hapus" class="delete-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a>
							</form>
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
      <div class="col-xs-4">
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Predikat Baru</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/predikat')}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="nilai_awal">Nilai Awal</label>
                <input type="number" min="0" max="100" name="nilai_awal" class="form-control" id="nilai_awal" placeholder="Nilai awal" required>
              </div>
              <div class="form-group">
                <label for="nilai_akhir">Nilai Akhir</label>
                <input type="number" min="0" max="100" name="nilai_akhir" class="form-control" id="nilai_akhir" placeholder="Nilai akhir" required>
              </div>
              <div class="form-group">
                <label for="predikat_ki3_ki4">Predikat KI-3 & KI-4</label>
                <input type="text" name="predikat_ki3_ki4" class="form-control" id="predikat_ki3_ki4" placeholder="Predikat KI-3 & KI-4" required>
              </div>
              <div class="form-group">
                <label for="predikat_ki1_ki2">Predikat KI-1 & KI-2</label>
                <input type="text" name="predikat_ki1_ki2" class="form-control" id="predikat_ki1_ki2" placeholder="Predikat KI-1 & KI-2" required>
              </div>
              <!-- radio -->
              <div class="form-group">
                  <label>Lulus KI1 & KI-2</label><br>
                  <label class="radio-inline">
                      <input type="radio" name="lulus_ki1_ki2" class="minimal" value="1" checked> Ya
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="lulus_ki1_ki2" class="minimal" value="0"> Tidak
                  </label>
              </div>
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
@endsection
