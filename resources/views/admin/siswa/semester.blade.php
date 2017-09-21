@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pilih Semester Siswa <small>{{$siswa->user->name}} ({{$siswa->nis}})</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Anggota</li>
        <li><a href="{{url('admin/siswa')}}">Siswa</a></li>
		<li class="active">Pilih Semester Siswa</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
			  <h3 class="box-title">Pilih Semester</h3>
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
				  @foreach($siswa->semesterSiswa as $index => $semesterSiswa)
					<tr>
					<td>{{$index+1}}</td>
					<td>{{$semesterSiswa->semester->gasal_genap === 1? "Gasal" : "Genap" }} {{$semesterSiswa->semester->tahunAjar->nama}}</td>
					<td>
						<a data-toggle="tooltip" title="Lihat" class="btn btn-default btn-xs" href="{{url('admin/siswa/rapor/'.$semesterSiswa->id)}}"><span class="fa fa-eye"></span></a>
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
