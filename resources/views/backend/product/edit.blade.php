@extends('backend.layouts.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Form</li>
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
                <h3 class="card-title">Product Form</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <form class="form-horizontal" action="{{ route('product.update', $product->id) }}" method="POST">
                @csrf
                @method('patch')
                <br>
                @include('backend.alert')
                <br><br>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" placeholder="title" name="title" value="{{ @$product->title }}" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Summary <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <textarea name="summary" id="summary" cols="30" rows="5" class="form-control" >{{ @$product->summary}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <textarea name="description" id="description" cols="30" rows="5" class="form-control" >{{ @$product->description}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Stock <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="" placeholder="stock" name="stock" value="{{ @$product->stock}}" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Price <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="number" step="any" class="form-control" id="" placeholder="price" name="price" value="{{ @$product->price}}" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Discount </label>
                    <div class="col-sm-10">
                      <input type="number" min="0" max="100" step="any" class="form-control" id="" placeholder="discount" name="discount" value="{{ @$product->discount }}" required>
                    </div>
                  </div>
                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Brand <span class="text-danger">*</span></label>
                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="brand_id" required>
                     <option value="">Select Option</option>
                     @foreach (\App\Models\Brand::get() as $item)
                     <option value="{{ $item->id }}" {{ $product->brand_id == $item->id? 'selected' : '' }}>{{ $item->title }}</option>
                     @endforeach
                    </select>
                  </div>

                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Category <span class="text-danger">*</span></label>
                    <select class="custom-select form-control-border" id="cat_id" name="cat_id"  required>
                     <option value="">Select Option</option>
                     @foreach (\App\Models\Category::where('is_parent',1)->get() as $item)
                     <option value="{{ $item->id }}" {{ $product->cat_id == $item->id? 'selected' : '' }}>{{ $item->title }}</option>
                     @endforeach
                    </select>
                  </div>

                  <div class="form-group pl-3 d-none" id="child_cat_div">
                    <label for="exampleSelectBorder">Child Category  <span class="text-danger">*</span></label>
                    <select class="custom-select form-control-border" name="child_cat_id" id="child_cat_id" >
                     
                     
                    </select>
                  </div>


                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Size <span class="text-danger">*</span></label>

                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="size" required>
                      <option value="S" {{ $product->status== 'S' ? 'selected' : '' }}>Small</option>
                      <option value="M" {{ $product->status == 'M' ? 'selected' : '' }}>Medium</option>
                      <option value="L" {{ $product->status== 'L' ? 'selected' : '' }}>Large</option>
                      <option value="XL" {{ $product->status == 'XL' ? 'selected' : '' }}>X-Large</option>

                    </select>
                  </div>


                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Conditions <span class="text-danger">*</span></label>
                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="conditions" required>
                      <option value="new" {{ $product->conditions == 'active' ? 'selected' : '' }}>New</option>
                      <option value="popular" {{  $product->conditions == 'inactive' ? 'selected' : '' }}>Popular</option>
                      <option value="winter" {{  $product->conditions == 'inactive' ? 'selected' : '' }}>Winter</option>
                    </select>
                  </div>


                  <div class="form-group pl-3">
                    <label for="exampleSelectBorder">Vendor  <span class="text-danger">*</span></label>
                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="vendor_id" required>
                     <option value="">Select Option</option>
                     @foreach (\App\Models\User::where('role','vendor')->get() as $item)
                     <option value="{{ $item->id }}" {{  $product->vendor_id == $item->id? 'selected' : '' }}>{{ $item->full_name }}</option>
                     @endforeach
                    </select>
                  </div>

               
                  <div class="form-group row pl-3">

                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $product->photo }}" multiple>
                      </div>
                      <div id="holder" style="margin-top:15px;max-height:100px;"></div>





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

    $(document).ready(function() {
        $('#summary').summernote();
    });

</script>
<script>
  var child_cat_id = {{ $product->child_cat_id }};
  $('#cat_id').change(function(){
    var cat_id = $(this).val();
    if (cat_id != null) {
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        type:"POST",
        data:{
          _token:"{{ csrf_token() }}",
          cat_id:cat_id
        },
        success:function(response){
          var html_option = "<option value=''> -- Child Category -- </option>";
          if (response.status) {
           
            $('#child_cat_div').removeClass('d-none');
            $.each(response.data, function(id,title){
         //     html_option +="<option value='"+id+"++" "'>"+title.title+" </option>";
              html_option +="<option value='"+id+": "+(child_cat_id==id ? 'selected' : '†' )" >"+title.title+" </option>";
            });
          }else if(!response.status){
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
  });

  if (child_cat_id != null) {
    $('#cat_id').change();
  }
</script>
@endsection
