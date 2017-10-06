@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atur Kelulusan kelas {{$kelasBuka->nama}} ({{$kelasBuka->tahunAjar->nama}})
	</h1><br>
	  <a class="btn btn-success" href="{{url('admin/aturkelulusan/proses/'.$kelasBuka->id)}}"><i class="fa fa-gear"></i> Proses Otomatis Kelulusan</a>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Kelas</li>
        <li><a href="{{url('admin/aturkelulusan')}}">Atur Kelulusan</a></li>
        <li class="active">Atur Kelulusan (show)</li>
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
              <h3 class="box-title">Tabel Siswa Lulus</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table class="table table-bordered table-hover">
                  	<thead>
                  	<tr>
                    	<th>No</th>
                    	<th>NIS</th>
    	                <th>Nama</th>
    	                <th>Status Lulus</th>
    	                <th class="no-sort">Aksi</th>
                  	</tr>
                  	</thead>
                  	<tbody>
                    	@foreach($kelasBuka->daftarKelas->where('status_lulus',1) as $index => $daftarKelas)
    		              	<tr>
    		                  	<td>{{$index+1}}</td>
    		                  	<td>{{$daftarKelas->siswa->nis}}</td>
    		                  	<td>{{$daftarKelas->siswa->user->name}}</td>
    		                  	<td>@if($daftarKelas->status_lulus==1) Lulus @else Belum Lulus @endif</td>
    		                  	<td>
									<a href="{{url('admin/aturkelulusan/lihat/'.$daftarKelas->id)}}" data-toggle="tooltip" title="Lihat Data" class="btn btn-default btn-xs"><span class='fa fa-file-text-o'></span></a>
									<a href="{{url('admin/aturkelulusan/lulustidak/'.$daftarKelas->id)}}" data-toggle="tooltip" title="Tinggal Kelas" class="btn btn-danger btn-xs"><span class='fa fa-close'></span></a>
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
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tabel Siswa Tidak Lulus</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table class="table table-bordered table-hover">
                  	<thead>
                  	<tr>
                    	<th>No</th>
                    	<th>NIS</th>
    	                <th>Nama</th>
    	                <th>Status Lulus</th>
						<th class="no-sort">Aksi</th>
                  	</tr>
                  	</thead>
                  	<tbody>
                    	@foreach($kelasBuka->daftarKelas->where('status_lulus',0) as $index => $daftarKelas)
    		              	<tr>
    		                  	<td>{{$index+1}}</td>
    		                  	<td>{{$daftarKelas->siswa->nis}}</td>
    		                  	<td>{{$daftarKelas->siswa->user->name}}</td>
    		                  	<td>@if($daftarKelas->status_lulus==1) Lulus @else Belum Lulus @endif</td>
								<td>
									<a href="{{url('admin/aturkelulusan/lihat/'.$daftarKelas->id)}}" data-toggle="tooltip" title="Lihat Data" class="btn btn-default btn-xs"><span class='fa fa-file-text-o'></span></a>
				                  	<a href="{{url('admin/aturkelulusan/lulustidak/'.$daftarKelas->id)}}" data-toggle="tooltip" title="Luluskan" class="btn btn-success btn-xs"><span class='fa fa-check'></span></a>
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
