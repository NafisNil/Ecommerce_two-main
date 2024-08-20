@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User  <a href="{{ route('user.create') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus-square"></i>Create user</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">user</li>
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
                <h3 class="card-title">User List  <b>({{ \App\Models\User::count() }})</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.alert')
                <br><br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $item)


                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->full_name}}
                    </td>
                    <td>{!! html_entity_decode($item->username) !!}</td>
                    <td>{{$item->email}}
                    <td> <img src="{{ $item->photo }}" alt="{{ $item->photo }}" style="max-height: 98px; max-width:128px;border-radius:4px"></td>
                    <td>{{$item->phone}}
                </td>
                <td>{!! html_entity_decode($item->address) !!}</td>
                <td>{!! html_entity_decode($item->role) !!}</td>
                    <td> 
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="toggle" value={{$item->id}}  data-toggle="switchbutton"  data-onlabel = "active" data-offlable="inactive" {{ $item->status == 'active' ? 'checked' : ''  }}>
      
                      </div>
                    </td>
                    <td>
                      <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary float-left mr-1"  title="view" data-placement="bottom"  data-toggle="modal" data-target="#userID{{ $item->id }}"><i class="fas fa-eye"></i></a>
                       <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-outline-info float-left mr-1" data-toggle = "tooltip" title="edit" data-placement="bottom" ><i class="fas fa-edit"></i></a>
                      <form action="{{ route('user.destroy', $item->id) }}" method="post" class="float-left">
                        @csrf
                        @method('delete')
                        <a href=""  class="dlBtn btn btn-sm btn-outline-danger" data-toggle = "tooltip" title="delete" data-placement="bottom"  data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                      </form>
                    </td>
                  </tr>
                                    <!-- Modal -->
                  <div class="modal fade" id="userID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->full_name }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <strong>Username : </strong>
                          <p>{!! html_entity_decode($item->username)!!}</p>
                          <strong>Address : </strong>
                          <p>{!! html_entity_decode($item->address)!!}</p>
                          <hr>
                          <div class="row">
                          
                            <div class="col-md-6">
                              <strong>Email : </strong>
                              <p><a href="mailto:{{$item->email}}">{{$item->email}}</a></p>
                            </div>
                            <div class="col-md-6">
                              <strong>Phone : </strong>
                              <p><a href="tel:{{$item->phone}}">{{$item->phone}}</a></p>
                            </div>
                          </div>

                          <strong>Role : </strong>
                          <p>{{$item->role}}</p>

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
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
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
      url:'{{ route("user.status") }}',
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
