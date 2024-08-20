@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product  <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus-square"></i>Create Product</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
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

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List  <b>({{ \App\Models\Product::count() }})</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.alert')
                <br><br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $item)
                    @php
                        $photo = explode(',' , $item->photo);
                    @endphp

                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->title}}
                    
                    </td>
                    <td> <img src="{{ $photo[0] }}" alt="{{ $item->photo }}" style="max-height: 98px; max-width:128px"></td>
                    <td>{{number_format($item->price, 2)}}
                    </td>

                    <td>{{$item->discount}}%
                    </td>
                    <td>{{$item->size}}
                    </td>
                    <td>
                      @if ($item->conditions=="new")
                          <span class="badge bg-success">{{ $item->conditions }}</span>
                      @elseif($item->conditions == 'popular')
                        <span class="badge bg-red">{{ $item->conditions }}</span>
                      @else
                      <span class="badge bg-info">{{ $item->conditions }}</span>
                      @endif
                    </td>
                    <td> 
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="toggle" value={{$item->id}}  data-toggle="switchbutton"  data-onlabel = "active" data-offlable="inactive" {{ $item->status == 'active' ? 'checked' : ''  }}>
      
                      </div>
                    </td>
                    <td>
                       <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-outline-info float-left mr-1" data-toggle = "tooltip" title="edit" data-placement="bottom" ><i class="fas fa-edit"></i></a>
                       <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary float-left mr-1"  title="view" data-placement="bottom"  data-toggle="modal" data-target="#productID{{ $item->id }}"><i class="fas fa-eye"></i></a>
                      <form action="{{ route('product.destroy', $item->id) }}" method="post" class="float-left">
                        @csrf
                        @method('delete')
                        <a href=""  class="dlBtn btn btn-sm btn-outline-danger" data-toggle = "tooltip" title="delete" data-placement="bottom"  data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                      </form>
                    </td>
                  </tr>

                  <!--modal-->
<!-- Modal -->
<div class="modal fade" id="productID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  @php
      $product = \App\Models\Product::where('id',$item->id)->first();
  @endphp
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ $product->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <strong>Summary : </strong>
         <p>{!! html_entity_decode($item->summary)!!}</p>
         <strong>Description : </strong>
         <p>{!! html_entity_decode($item->description)!!}</p>
         <hr>
         <div class="row">
          <div class="col-md-4">
            <strong>Price : </strong>
            <p>{{number_format($item->price, 2)}}</p>
          </div>
          <div class="col-md-4">
            <strong>Price : </strong>
            <p>{{number_format($item->offer_price, 2)}}</p>
          </div>
          <div class="col-md-4">
            <strong>Stock : </strong>
            <p>{{$item->stock}}</p>
          </div>
         </div>

         <strong>Discount : </strong>
         <p>{{$item->discount}}%</p>

         <div class="row">
          <div class="col-md-6">
            <strong>Category : </strong>
            <p>{{ \App\Models\Category::where('id',$item->cat_id)->value('title') }}</p>
          </div>
          <div class="col-md-6">
            <strong>Child Category : </strong>
            <p>{{ \App\Models\Category::where('id',$item->child_cat_id)->value('title') }}</p>
          </div>
         </div>

         <strong>Brand : </strong>
         <p>{{ \App\Models\Brand::where('id',$item->brand_id)->value('title') }}</p>

         <div class="row">
          <div class="col-md-6">
            <strong>Size : </strong>
            <p>{{ $item->size }}</p>
          </div>
          <div class="col-md-6">
            <strong>Condition : </strong>
            <p>{{ $item->conditions }}</p>
          </div>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--modal-->
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

  @section('scripts')
  <script> 
   $("input[name='toggle']").change(function() {
    var mode  = $(this).prop('checked')? 1 : 0;
    var id = $(this).val();
    $.ajax({
      url:'{{ route("product.status") }}',
      type:'POST',
      data:{
        _token:'{{ csrf_token() }}',
        mode:mode,
        id:id
      },

      success:function(response){
        if (response.status) {
          alert(response.status);
        }else{
          alert('something went wrong!');
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  });

  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.dlBtn').click(function (e) {

  var form = $(this).closest('form');
  var dataID = $(this).data('id');
  e.preventDefault();
  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    form.submit();
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});
});
</script>
  @endsection
