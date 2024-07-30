@extends('backend.layouts.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Banner Form</li>
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
                <h3 class="card-title">Banner Form</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <form class="form-horizontal" action="{{ route('banner.store') }}" method="POST">
                @csrf
                <br>
                @include('backend.alert')
                <br><br>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" placeholder="title" name="title" value="{{ old('title') }}" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <textarea name="description" id="description" cols="30" rows="5" class="form-control" >{{ old('description') }}</textarea>
                    </div>
                  </div>

                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Status <span class="text-danger">*</span></label>

                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="status" required>
                      <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>

                    </select>
                  </div>

                  <div class="form-group row pl-3">
                    <label for="exampleSelectBorder">Condition <span class="text-danger">*</span></label>

                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="condition" required>
                      <option value="banner" {{ old('condition') == 'banner' ? 'selected' : '' }}>Banner</option>
                      <option value="promo" {{ old('condition') == 'promo' ? 'selected' : '' }}>Promo</option>

                    </select>
                  </div>
                  <div class="form-group row pl-3">

                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo">
                      </div>
                      <div id="holder" style="margin-top:15px;max-height:100px;"></div>





                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
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
