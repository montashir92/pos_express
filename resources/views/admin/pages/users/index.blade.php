@extends('admin.layouts.master')
@section('user')
active menu-open
@endsection()

@section('view-user')
active
@endsection()
@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus"></i> Add User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('user.store') }}" method="POST" class="form-horizontal" id="myForm">
                @csrf

                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="usertype" id="usertype">
                        <option value="">Select User option</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                      </select>
                      <span style="color: red">{{ ($errors->has('usertype')) ? ($errors->first('usertype')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                      <span style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                      <span style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      <span style="color: red">{{ ($errors->has('password')) ? ($errors->first('password')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Re Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password2" class="form-control" placeholder="Re type Password">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Save change</button>
                  {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>


          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> User List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($allData as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->usertype }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="#editModal{{ $item->id }}" title="Edit" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('user.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="" method="post">
                                          @csrf

                                          <div class="form-group">
                                            <label for="usertype">User Role</label>
                                            <select name="usertype" id="usertype" class="form-control">
                                              <option value="">Select Role</option>
                                              <option value="admin">Admin</option>
                                              <option value="user">User</option>
                                            </select>
                                            <span style="color: red">{{ ($errors->has('usertype')) ? ($errors->first('usertype')) : '' }}</span>
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="name" value="" class="form-control" id="">
                                          </div>

                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" value="" class="form-control" id="">
                                          </div>
                                          
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Update changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                  
                 
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection

  @push('adminjs')
  <script>
    $(function () {
      
      $('#myForm').validate({
        rules: {
          usertype: {
            required: true,
          },
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
          }

        },
        messages: {
          usertype: {
            required: "Please enter a User Type"
          },
          name: {
            required: "Please enter a User Name"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
  @endpush
  