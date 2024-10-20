@extends('backend.layouts.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shipping Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Shipping Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->

            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Shipping Form</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <form class="form-horizontal" action="{{ route('shipping.update', $shipping->id) }}" method="POST">
                @csrf
                @method('patch')
                <br>
                @include('backend.alert')
                <br><br>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Shipping Address <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <textarea name="shipping_address" class="form-control"  id="" cols="30" rows="10">{{ $shipping->shipping_address }}</textarea>
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery Time <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="delivery_time" value="{{ $shipping->delivery_time }}" id="" class="form-control" >
                      
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery Charge <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="number" step="any" name="delivery_charge" value="{{ $shipping->delivery_charge }}" id="" class="form-control" >
                      
                    </div>
                  </div>

                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Status <span class="text-danger">*</span></label>

                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="status" required>
                      <option value="active" {{ $shipping->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $shipping->status== 'inactive' ? 'selected' : '' }}>Inactive</option>

                    </select>
                  </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
        $('#description').summernote();
    });

</script>
@endsection
