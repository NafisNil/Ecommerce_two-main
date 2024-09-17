@extends('frontend.layouts.master')
@section('title')
    Wishlist  
@endsection
@section('content')
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>Wishlist</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Wishlist</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb Area -->
    
        <!-- Wishlist Table Area -->
        <div class="wishlist-table section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table wishlist-table">
                            <div class="table-responsive" id="wishlist_list">
                               @include('frontend.layouts._wishlist')
                            </div>
                        </div>
    

                    </div>
                </div>
            </div>
        </div>
        <!-- Wishlist Table Area -->
@endsection

@section('scripts')
    <script>
        $('.move-to-card').on('click', function(e){
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.move.cart') }}";

            $.ajax({
                url:path,
                type:'POST',
                data:{
                    _token:token,
                    rowId:rowId
                },
                beforeSend:function(){
                    $(this).html('<i class="fa fa-spinner fa-spin"></i>Add To Cart');
                },
                success:function(data){
                    if (data['status']) {
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);
                        swal({
                        title: "Oksy!",
                        text: data['message'],
                        icon: "success",
                        button: "Okay!",
                        });
                    }else{
                        swal({
                        title: "Oops!",
                        text: data['message'],
                        icon: "error",
                        button: "Okay!",
                        });
                    }
                },
                error:function(err){
                    swal({
                        title: "Oops!",
                        text: "Something went wrong!",
                        icon: "error",
                        button: "Okay!",
                        });
                }
            });
        });
    </script>

<script>
    $('.delete_wishlist').on('click', function(e){
        e.preventDefault();
        var rowId = $(this).data('id');
        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.delete') }}";

        $.ajax({
            url:path,
            type:'POST',
            data:{
                _token:token,
                rowId:rowId
            },
            success:function(data){
                if (data['status']) {
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    $('body #header-ajax').html(data['header']);
                    swal({
                    title: "Oksy!",
                    text: data['message'],
                    icon: "success",
                    button: "Okay!",
                    });
                }else{
                    swal({
                    title: "Oops!",
                    text: data['message'],
                    icon: "error",
                    button: "Okay!",
                    });
                }
            },
            error:function(err){
                swal({
                    title: "Oops!",
                    text: "Something went wrong!",
                    icon: "error",
                    button: "Okay!",
                    });
            }
        });
    });
</script>
@endsection