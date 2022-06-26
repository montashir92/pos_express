@extends('admin.layouts.master')
{{-- @section('user')
active menu-open
@endsection()

@section('view-user')
active
@endsection() --}}
@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ (!empty(Auth::user()->image)) ? asset(Auth::user()->image) : asset('admin/image/no.png') }}"
                         alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                  <hr>

                  <a href="{{ route('users.profiles') }}" class="btn btn-primary btn-block"><b><i class="fas fa-home"></i> Home</b></a>
                  <a href="#" class="btn btn-primary btn-block"><b><i class="fas fa-lock"></i> Change Password</b></a>
                </div>
                <!-- /.card-body -->
              </div>
          </div>


          <div class="col-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-key"></i> Change Password</h3>
                </div>
                <!-- form start -->
                <form action="{{ route('user.update.password') }}" method="POST" class="form-horizontal">
                  @csrf
  
                  <div class="card-body">

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Current Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="currentPass" class="form-control" id="currentPass" placeholder="Current Password">
                        <span style="color: red">{{ ($errors->has('currentPass')) ? ($errors->first('currentPass')) : '' }}</span>
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                        <span style="color: red">{{ ($errors->has('password')) ? ($errors->first('password')) : '' }}</span>
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Again New Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                      </div>
                    </div>
                    
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update change</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection

  @push('adminjs')


  @endpush
  