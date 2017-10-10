@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kompetensi Dasar Mata Pelajaran {{$mapel->nama}} {{$mapel->keterangan}} Kelas {{$mapel->kelas->tingkat}}
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Kelas</li>
        <li>Mata Pelajaran</li>
        <li><a href="{{url('admin/kd')}}">Kompetensi Dasar</a></li>
        <li class="active">Kompetensi Dasar (Show)</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')

      <div class="col-xs-8">
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Kompetensi Dasar</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover">
              	<thead>
              		<tr>
		                <th>Nomor</th>
		                <th>Deskripsi</th>
		                <th>Gasal/Genap</th>
		                <th class="no-sort">Aksi</th>
              		</tr>
              	</thead>
              	<tbody>
            		@foreach($mapel->kompetensiDasar as $kompetensiDasar)
	                  	<tr>
		                  	<td>{{$kompetensiDasar->nomor}}</td>
		                  	<td>{{$kompetensiDasar->deskripsi}}</td>
		                  	<td>@if($kompetensiDasar->gasal_genap==1) Gasal @else Genap @endif</td>
		                  	<td>
								<form style="display: inline-block" method="post" class="form-delete" action="{{url('admin/kd/'.$kompetensiDasar->id)}}">
				                  	{{ method_field('DELETE') }}{{ csrf_field() }}
				                  	<a data-toggle="tooltip" title="Hapus" class="delete-modal btn btn-danger btn-xs"><span class='fa fa-trash-o'></span></a>
								</form>
							</td>
	                  	</tr>
                	@endforeach
              	</tbody>
            </table>
          </div>
      </div>
      </div>
      <div class="col-xs-4">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Tambah Kompetensi Dasar</h3>
        </div>
          <form role="form" action="{{url('admin/kd')}}" method="post">
          <!-- /.box-header -->
          <div class="box-body">
              {{ csrf_field() }}
              <input type="hidden" name="mata_pelajaran_id" value="{{$mapel->id}}">
              <div class="form-group">
                <label for="nomor">Nomor</label>
                <input type="number" name="nomor" min="1" max="50" class="form-control" id="tingkat" placeholder="Nomor KD" required>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" id="deskripsi" placeholder="Deskripsi"></textarea>
              </div>
              <div class="form-group">
                <label>Gasal/Genap</label>
                <select name="gasal_genap" class="form-control">
                    <option value="1">Gasal</option>
                    <option value="2">Genap</option>
                </select>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Tambah</button>
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
