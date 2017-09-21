@extends('layouts.appsiswa')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
