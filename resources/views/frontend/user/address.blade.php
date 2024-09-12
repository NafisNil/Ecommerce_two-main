@extends('frontend.layouts.master')
@section('title')
    User Dashboard
@endsection
@section('content')
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>My Account</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb Area -->
    
        <!-- My Account Area -->
        <section class="my-account-area section_padding_100_50">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="my-account-navigation mb-50">
                           @include('frontend.user.sidebar')
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="my-account-content mb-50">
                            <p>The following addresses will be used on the checkout page by default.</p>
    
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                    <h6 class="mb-3">Billing Address</h6>
                                    <address>
                                        {{ $user->full_name }}<br>
                                       {!! $user->address !!}<br>
                                        {{ $user->state }} , {{ $user->city }} <br>
                                        {{ $user->country }} <br>
                                        {{ $user->postcode }}
                                    </address>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Edit Address</a>

                                    <!-- Modal -->
                                    <div class="shortcodes_content">
                           
                
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0, 0, 0, .5)">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('billing.address', $user->id) }}" method="post">
                                                            @csrf
                                                                <div class="form-group">
                                                                    <label for="">Address</label>
                                                                    <textarea name="address" id="" cols="20" class="form-control" rows="10">{{ $user->address }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Country</label>
                                                                    <input type="text" name="country" class="form-control" placeholder="eg. Bangladesh" value="{{ $user->country }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Postcode</label>
                                                                    <input type="text" name="postcode" class="form-control" placeholder="eg. 1215" value="{{ $user->posstcode }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">State</label>
                                                                    <input type="text" name="state" class="form-control" placeholder="eg. Dhaka" value="{{ $user->state }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">City</label>
                                                                    <input type="text" name="city" class="form-control" placeholder="eg. Dhaka" value="{{ $user->city }}">
                                                                </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                         {{-- model --}}
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h6 class="mb-3">Shipping Address</h6>
                                    <address>
                                        {{ $user->full_name }}<br>
                                       {!! $user->saddress !!}<br>
                                        {{ $user->sstate }} , {{ $user->scity }} <br>
                                        {{ $user->scountry }} <br>
                                        {{ $user->spostcode }}
                                    </address>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSAddress">Edit  Address</a>
                                                       <!-- Modal -->
                                                       <div class="shortcodes_content">
                           
                
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="editSAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0, 0, 0, .5)">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Shipping Address</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('shipping.address', $user->id) }}" method="post">
                                                                            @csrf
                                                                                <div class="form-group">
                                                                                    <label for="">Shipping Address</label>
                                                                                    <textarea name="saddress" id="" cols="20" class="form-control" rows="10">{{ $user->saddress }}</textarea>
                                                                                </div>
                
                                                                                <div class="form-group">
                                                                                    <label for="">Shipping Country</label>
                                                                                    <input type="text" name="scountry" class="form-control" placeholder="eg. Bangladesh" value="{{ $user->saddress }}">
                                                                                </div>
                
                                                                                <div class="form-group">
                                                                                    <label for="">Shipping Postcode</label>
                                                                                    <input type="text" name="spostcode" class="form-control" placeholder="eg. 1215" value="{{ $user->spostcode }}">
                                                                                </div>
                
                                                                                <div class="form-group">
                                                                                    <label for="">Shipping State</label>
                                                                                    <input type="text" name="sstate" class="form-control" placeholder="eg. Dhaka" value="{{ $user->sstate }}">
                                                                                </div>
                
                                                                                <div class="form-group">
                                                                                    <label for="">Shipping City</label>
                                                                                    <input type="text" name="scity" class="form-control" placeholder="eg. Dhaka" value="{{ $user->scity }}">
                                                                                </div>
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                         {{-- model --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- My Account Area -->
@endsection