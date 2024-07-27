@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="bg-danger p-1 m-2 alert alert-dismissible close"  data-dismiss="alert">
    <span class="text-white">{{ $error }}</span>
</div>
@endforeach
@endif
