@extends('layouts.appadmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      @include('includes.common.status')
      @include('includes.common.errors')

      <div class="col-xs-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('admin/profile/'.Auth::user()->id)}}" method="post">
              <div class="box-body">
                {{csrf_field()}}
                {{method_field("PUT")}}
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="nis" placeholder="Username" value="{{Auth::user()->username}}" readonly>
                </div>
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{Auth::user()->name}}" required>
                </div>
				<div class="form-group">
                  <label>
                    Super <input type="checkbox" name="super" class="minimal" value="1" @if($karyawan->super==1) checked @endif>
                  </label>
                </div>
                <div class="form-group">
                  <label for="password">Password Baru (Diisi apabila akan mengganti password)</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Konfirmasi Password (Diisi apabila akan mengganti password)</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Konfirmasi">
                </div>
              </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <a class="update-modal btn btn-primary">Simpan</a>
              <a href="{{url('admin/home')}}" class="btn btn-default">Batal</a>
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
