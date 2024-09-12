
<!-- Single Product -->
@foreach ($products as $item)
<div class="col-9 col-sm-12 col-md-6 col-lg-4">
  <div class="single-product-area mb-30">
      <div class="product_image">
          @php
              $photo = explode(',', $item->photo);
          @endphp
          <!-- Product Image -->
          <img class="normal_img" src="{{ $photo[0] }}" alt="">
          <img class="hover_img" src="{{ @$photo[1] }}" alt="">
          <!-- Product Badge -->
          <div class="product_badge">
              @if ($item->conditions == 'winter')
              <span style="color: rgb(20, 252, 98)">{{ $item->conditions }}</span>
              @elseif ($item->conditions == 'new')
              <span style="color: rgb(255, 27, 27)">{{ $item->conditions }}</span>
              @else
              <span style="color: rgb(5, 255, 251)">{{ $item->conditions }}</span>
              @endif
              
          </div>
          <!-- Wishlist -->
          <div class="product_wishlist">
              <a href="javascript:void(0);" class="add_to_wishlist" data-quantity='1' data-id='{{ $item->id }}' id="add_to_wishlist{{ $item->id }}"><i class="fa fa-heart"></i></a>
          </div>
          <!-- Compare -->
          <div class="product_compare">
              <a href="../bigshop-2.3.0/compare.html"><i class="icofont-exchange"></i></a>
          </div>
      </div>
      <!-- Product Description -->
      <div class="product_description">
          <!-- Add to cart -->
          <div class="product_add_to_cart">
              <a href="#" class="add_to_cart" data-quantity='1' data-product-id="{{ $item->id }}"  id="add_to_cart{{ $item->id }}"><i class="icofont-shopping-cart "></i> Add to Cart</a>
          </div>
          <!-- Quick View -->
          <div class="product_quick_view">
              <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
          </div>
          <p class="brand_name">{{ App\Models\Brand::where('id', $item->brand_id)->value('title') }}</p>
          <a href="{{ route('product.details', $item->slug) }}">{{ ucfirst($item->title) }}</a>
          <h6 class="product-price">${{ number_format($item->offer_price, 2) }} <del class="text-danger">${{ number_format(@$item->price, 2) }}</del></h6>
      </div>
  </div>
</div>
@endforeach
