@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <h3 class="card-title">Banner List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($banners as $item)


                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->title}}
                    </td>
                    <td>{{$item->description}}</td>
                    <td> <img src="{{ $item->photo }}" alt="{{ $item->photo }}" style="max-height: 98px; max-width:128px"></td>
                    <td>@if ($item->condition == 'banner')
                        <span class="badge bg-success"> Banner</span>
                    @else
                        <span class="badge bg-info"> Promotion</span>
                    @endif
                </td>
                    <td> 
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="toggle" value={{$item->id}}  data-toggle="switchbutton"  data-onlabel = "active" data-offlable="inactive" {{ $item->status == 'active' ? 'checked' : ''  }}>
      
                      </div>
                    </td>
                    <td>
                       <a href="" class="btn btn-sm btn-outline-info" data-toggle = "tooltip" title="edit" data-placement="bottom" ><i class="fas fa-edit"></i></a>

                       <a href="" class="btn btn-sm btn-outline-danger" data-toggle = "tooltip" title="delete" data-placement="bottom" ><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
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
      url:'{{ route("banner.status") }}',
      type:'POST',
      data:{
        _token:'{{ csrf_token() }}',
        mode:mode,
        id:id
      },

      success:function(response){
        console.log(response.status);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  });

  </script>

  @endsection
