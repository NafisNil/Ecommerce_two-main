@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shipping  <a href="{{ route('shipping.create') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus-square"></i>Create Shipping</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Shipping</li>
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
                <h3 class="card-title">Shipping List  <b>({{ \App\Models\Shipping::count() }})</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.alert')
                <br><br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                
                    <th>Shipping Address</th>
                    <th>Delivery Time</th>
                    <th>delivery Charge</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($shippings as $item)


                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->shipping_address}}
                    </td>
                    <td>{!! html_entity_decode($item->delivery_time) !!}</td>
                    <td>{!! number_format($item->delivery_charge, 2) !!}</td>


                    <td> 
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="toggle" value={{$item->id}}  data-toggle="switchbutton"  data-onlabel = "active" data-offlable="inactive" {{ $item->status == 'active' ? 'checked' : ''  }}>
      
                      </div>
                    </td>
                    <td>
                       <a href="{{ route('shipping.edit', $item->id) }}" class="btn btn-sm btn-outline-info float-left mr-1" data-toggle = "tooltip" title="edit" data-placement="bottom" ><i class="fas fa-edit"></i></a>
                      <form action="{{ route('shipping.destroy', $item->id) }}" method="post" class="float-left">
                        @csrf
                        @method('delete')
                        <a href=""  class="dlBtn btn btn-sm btn-outline-danger" data-toggle = "tooltip" title="delete" data-placement="bottom"  data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                      </form>
                    </td>
                  </tr>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Shipping Address</th>
                    <th>Delivery Time</th>
                    <th>delivery Charge</th>
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
      url:'{{ route("shipping.status") }}',
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
