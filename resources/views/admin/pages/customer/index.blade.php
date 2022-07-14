@extends('admin.layouts.master')
@section('customer')
active menu-open
@endsection

@section('view-customer')
active
@endsection

@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                
                <h3 class="card-title">
                    @if(isset($customerData))
                        <i class="fas fa-edit"></i> Update Customer
                    @else
                        <i class="fas fa-plus"></i> Add Customer
                    @endif
                </h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ (@$customerData) ? route('admin.customer.update', $customerData->id) : route('admin.customer.store') }}" method="POST" class="form-horizontal" id="myForm">
                @csrf

                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Customer Name</label>
                          <input type="text" name="name" class="form-control" value="{{ @$customerData->name }}" id="name" placeholder="Enter Supplier Name">
                          <span style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</span>
                        
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Mobile</label>
                          <input type="text" name="mobile" class="form-control" value="{{ @$customerData->mobile }}" id="mobile" placeholder="Enter Mobile Number">
                          <span style="color: red">{{ ($errors->has('mobile')) ? ($errors->first('mobile')) : '' }}</span>
                        
                      </div>

                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Email</label>
                          <input type="email" name="email" class="form-control" value="{{ @$customerData->email }}" id="email" placeholder="Email Address">
                          <span style="color: red">{{ ($errors->has('email')) ? ($errors->first('email')) : '' }}</span>
                        
                      </div>
    
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Address</label>
                          <input type="text" name="address" class="form-control" value="{{ @$customerData->address }}" id="address" placeholder="Enter Address">
                          <span style="color: red">{{ ($errors->has('address')) ? ($errors->first('address')) : '' }}</span>
                      </div>

                    </div>
                  </div>
                  

                  

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">{{(@$customerData)?'Update change':'Save change'}}</button>
                  {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Customer List</h3>
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
                      @foreach ($customer as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a href="{{ route('admin.customer.edit', $item->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.customer.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
            email: true
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
  