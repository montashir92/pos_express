@extends('admin.layouts.master')
@section('entry')
active menu-open
@endsection()

@section('unit')
active
@endsection()
@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Manage Unit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Unit</li>
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
                @if(isset($unitData))
                        <i class="fas fa-edit"></i> Update Unit
                    @else
                        <i class="fas fa-plus"></i> Add Unit
                    @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ (@$unitData) ? route('admin.unit.update', $unitData->id) : route('admin.unit.store') }}" method="POST" class="form-horizontal" id="myForm">
                @csrf

                <div class="card-body">

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Unit Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" value="{{ @$unitData->name }}" class="form-control" id="name" placeholder="Enter Unit Name">
                      <span style="color: red">{{ ($errors->has('name')) ? ($errors->first('name')) : '' }}</span>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">{{(@$unitData)?'Update change':'Save change'}}</button>
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
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($unit as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('admin.unit.edit', $item->id)  }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.unit.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>

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
          }

        },
        messages: {
          name: {
            required: "Please enter a Unit Name"
          }
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
  