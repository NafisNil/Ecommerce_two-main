<table class="table table-bordered mb-30">
    <thead>
        <tr>
            <th scope="col"><i class="icofont-ui-delete"></i></th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Unit Price</th>
           
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @if (Cart::instance('wishlist')->count()>0)
        @foreach (Cart::instance('wishlist')->content() as $item)
        <tr>
            <th scope="row">
                <i class="icofont-close delete_wishlist" data-id={{ $item->rowId }}></i>
            </th>
            <td>
                <img src="{{ $item->model->photo }}" alt="Product">
            </td>
            <td>
                <a href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
            </td>
            <td>${{ $item->price }}</td>

            <td><a href="javascript:void(0)" data-id={{ $item->rowId }}  class="move-to-card btn btn-primary btn-sm">Add to Cart</a></td>
        </tr>
     
        @endforeach
        @else
            <h6>Nothing found in the wishlist!</h6>
        @endif
      
      
    </tbody>
</table>