@extends('admin.layouts.master')

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
              <li class="breadcrumb-item active">Profile</li>
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
                         src="{{ (!empty($user->image)) ? asset($user->image) : asset('admin/image/no.png') }}"
                         alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{ $user->name }}</h3>
                  <hr>

                  <a href="{{ route('users.profiles') }}" class="btn btn-primary btn-block"><b><i class="fas fa-home"></i> Home</b></a>
                  <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-block"><b><i class="fas fa-lock"></i> Change Password</b></a>
                </div>
                <!-- /.card-body -->
              </div>
          </div>


          <div class="col-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-edit"></i> Update User</h3>
                </div>
                <!-- form start -->
                <form action="{{ route('user.profile.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  @csrf
  
                  <input type="hidden" name="old_image" value="{{ $user->image }}">
                  <div class="card-body">

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Enter Name">
                        <span style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</span>
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email">
                        <span style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</span>
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Mobile</label>
                      <div class="col-sm-9">
                        <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control" id="mobile" placeholder="Mobile Number">
                        <span style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</span>
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                          <textarea name="address" id="address" rows="2" class="form-control">{{ $user->address }}</textarea>
                          {{-- <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="address" placeholder="Address"> --}}
                          <span style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</span>
                        </div>
                      </div>
  
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="gender" id="gender">
                            <option value="">Select your Gender</option>
                            <option value="Male" {{ ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                          </select>
                          <span style="color: red">{{ ($errors->has('gender')) ? ($errors->first('gender')) : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Image Upload</label>
                        <div class="col-sm-7">
                           <input type="file" name="image" class="form-control" onchange="mainThambUrl(this)">
                          <span style="color: red">{{ ($errors->has('gender')) ? ($errors->first('gender')) : '' }}</span>
                        </div>

                        <div class="col-md-2">
                            <img src="{{ (!empty($user->image)) ? asset($user->image) : asset('admin/image/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #ddd; padding: 4px; border-radius: 5px" alt="">
                        </div>

                    </div>
                    
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update change</button>
                    {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
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
  <script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(100)
                  .height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

  @endpush
  