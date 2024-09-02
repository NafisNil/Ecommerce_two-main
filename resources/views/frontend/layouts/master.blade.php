<!doctype html>
<html lang="en">
<head>
	@include('frontend.layouts.head')
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Header Area -->
    @include('frontend.layouts.header')
    <!-- Header Area End -->
    <!-- Welcome Slides Area -->
    <div class="row">
        <div class="col-md-12">
            @include('backend.alert')
        </div>
    </div>
    @yield('content')
    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    @include('frontend.layouts.script')
</body>
</html>