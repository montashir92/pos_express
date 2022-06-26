@extends('admin.layouts.master')
@section('entry')
active menu-open
@endsection

@section('supplier')
active
@endsection

@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
                
                <h3 class="card-title">
                    @if(isset($editData))
                        <i class="fas fa-plus"></i> Add Supplier
                    @else
                        <i class="fas fa-plus"></i> Add Supplier
                    @endif
                </h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ (@$editData) ? route('admin.supplier.update', $editData->id) : route('admin.supplier.store') }}" method="POST" class="form-horizontal" id="myForm">
                @csrf

                <div class="card-body">

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Supplier Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" value="{{ @$editData->name }}" id="name" placeholder="Enter Supplier Name">
                      <span style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Mobile</label>
                    <div class="col-sm-9">
                      <input type="text" name="mobile" class="form-control" value="{{ @$editData->mobile }}" id="mobile" placeholder="Enter Mobile Number">
                      <span style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" class="form-control" value="{{ @$editData->email }}" id="email" placeholder="Email Address">
                      <span style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                      <input type="text" name="address" class="form-control" value="{{ @$editData->address }}" id="address" placeholder="Enter Address">
                      <span style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</span>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">{{(@$editData)?'Update change':'Save change'}}</button>
                  {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>


          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Supplier List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($supplier as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a href="{{ route('admin.supplier.edit', $item->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.supplier.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
          name: {
            required: true,
          },
          mobile: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          address: {
            required: true,
          }

        },
        messages: {
           name: {
            required: "Please enter a Supplier Name"
          },
          mobile: {
            required: "Please enter a Mobile Number"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          address: {
            required: "Please provide a Address"
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
  