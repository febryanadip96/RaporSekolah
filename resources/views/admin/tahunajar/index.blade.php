@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tahun Ajar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-calendar"></i> Tahun Ajar</li>
        <li class="active">Tahun Ajar</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      	@include('includes.common.status')
      	@include('includes.common.errors')
      	<div class="col-xs-6">
			<div class="box box-primary">
				<div class="box-header">
				  	<h3 class="box-title">Tabel Tahun Ajar</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  	<table class="table table-bordered table-hover">
				    	<thead>
					    	<tr>
					      		<th>No</th>
					      		<th>Nama</th>
					      		<th>Total Hari Efektif</th>
								<th>Tanggal Tutup</th>
					      		<th class="no-sort">Aksi</th>
					    	</tr>
				    	</thead>
				    	<tbody>
					      	@foreach($tahunAjars as $index => $tahunAjar)
						        <tr>
							        <td>{{$index+1}}</td>
							        <td>{{$tahunAjar->nama}}</td>
							        <td>{{$tahunAjar->total_hari_efektif}} hari</td>
									<td>{{date('m/d/Y',strtotime($tahunAjar->tutup))}}</td>
							        <td>
										<a data-toggle="tooltip" title="Edit" class="btn btn-warning btn-xs" href="{{url('admin/tahunajar/'.$tahunAjar->id.'/edit')}}"><span class="fa fa-pencil"></span></a>
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
      	<div class="col-xs-6">
	        <!-- general form elements -->
	        <div class="box box-success">
	          <div class="box-header with-border">
	            <h3 class="box-title">Data Tahun Ajar Baru</h3>
	          </div>
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{url('admin/tahunajar')}}" method="post">
	            {{ csrf_field() }}
	            <div class="box-body">
	              	<div class="form-group">
	                	<label for="nama">Nama</label>
	                	<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Tahun Ajar" value="{{ old('nama') }}" required>
	              	</div>
	              	<div class="form-group">
	                	<label for="total_hari_efektif">Total Hari Efektif</label>
	                	<input type="number" name="total_hari_efektif" class="form-control" id="total_hari_efektif"  value="{{ old('total_hari_efektif') }}" placeholder="Total Hari Efektif" required>
	              	</div>
				  	<!-- Date -->
		  			<div class="form-group">
		  			  <label>Tanggal Tutup:</label>
		  			  <div class="input-group date">
		  				<div class="input-group-addon">
		  				  <i class="fa fa-calendar"></i>
		  				</div>
		  				<input type="text" name="tutup" class="form-control pull-right datepicker" value="{{ old('tutup') ? date('m/d/Y',strtotime( old('tutup') )) : date('m/d/Y',strtotime('now')) }}" required>
		  			  </div>
		  			  <!-- /.input group -->
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
