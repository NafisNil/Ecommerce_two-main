@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="bg-danger p-1 m-2 alert alert-dismissible close"  id="alert" data-dismiss="alert">
    <span class="text-white">{{ $error }}</span>
</div>
@endforeach
@endif
@if (session('success'))
<div class="bg-success p-1 m-2 alert alert-dismissible close"  id="alert" data-dismiss="alert">
    <span class="text-white">{{ session('success') }}</span>
    </div>
@endif

@if (session('status'))
<div class="bg-info p-1 m-2 alert alert-dismissible close"  id="alert" data-dismiss="alert">
    <span class="text-white"> {{ session('status') }}</span>
    </div>
@endif