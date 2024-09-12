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
                            <h5 class="mb-3">Account Details</h5>
                          
                            <form action="{{ route('account.update', $user->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">First Name *</label>
                                            <input type="text" class="form-control" id="firstName" value="{{ $user->full_name }}" name="full_name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Display Name *</label>
                                            <input type="text" class="form-control" id="lastName" value="{{ $user->username }}" name="username">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Phone Number *</label>
                                            <input type="text" class="form-control" id="lastName" value="{{ $user->phone }}" name="phone">
                                        </div>
                                    </div>
                
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="emailAddress">Email Address *</label>
                                            <input type="email" class="form-control" id="emailAddress" placeholder="care.designingworld@gmail.com" name="email" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="currentPass">Current Password (Leave blank to leave unchanged)</label>
                                            <input type="password" class="form-control" id="currentPass" name="oldpassword">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPass">New Password (Leave blank to leave unchanged)</label>
                                            <input type="password" class="form-control" id="newPass" name="newpassword">
                                        </div>
                                    </div>
               
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- My Account Area -->
@endsection