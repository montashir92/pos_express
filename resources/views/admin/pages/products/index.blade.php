@extends('admin.layouts.master')
    @section('entry')
    active menu-open
    @endsection()

    @section('product')
    active
    @endsection()

@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                    @if(isset($productData))
                        <i class="fas fa-edit"></i> Update Product
                    @else
                        <i class="fas fa-plus"></i> Add Product
                    @endif
                </h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ (@$productData) ? route('admin.product.update', $productData->id) : route('admin.product.store') }}" method="POST" class="form-horizontal" id="myForm">
                @csrf

                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Supplier Name</label>
                        <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="">Select Supplier Name</option>
                            @foreach ($suppliers as $item)
                            <option value="{{ $item->id }}" {{ (@$productData->supplier_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                            
                        </select>
                        @error('supplier_id') <span style="color: red">{{$message}}</span> @enderror
                        
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category option</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ (@$productData->category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span style="color: red">{{$message}}</span> @enderror
                        
                      </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-form-label">Unit</label>
                            <select class="form-control" name="unit_id" id="unit_id">
                                <option value="">Select Unit option</option>
                                @foreach ($units as $item)
                                <option value="{{ $item->id }}" {{ (@$productData->unit_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id') <span style="color: red">{{$message}}</span> @enderror
                            
                        </div>
    
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Product Name</label>
                          <input type="text" name="name" class="form-control" value="{{ @$productData->name }}" id="name" placeholder="Enter Product Name">
                          @error('name') <span style="color: red">{{$message}}</span> @enderror
                      </div>

                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">{{(@$productData)?'Update change':'Save change'}}</button>
                  {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Product List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($product as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->supplier->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->unit->name }}</td>
                            <td>
                                <a href="{{ route('admin.product.edit', $item->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.product.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
          supplier_id: {
            required: true,
          },
          unit_id: {
            required: true,
          },
          category_id: {
            required: true
          },
          name: {
            required: true,
          }

        },
        messages: {
          supplier_id: {
            required: "Please enter a Supplier Name"
          },
          unit_id: {
            required: "Please enter a Unit"
          },
          category_id: {
            required: "Please enter a Category name"
          },
          name: {
            required: "Please provide a Product Name"
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
  