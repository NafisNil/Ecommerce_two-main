@extends('frontend.layouts.master')
@section('title')
    Shop
@endsection

@section('content')
        <!-- Quick View Modal Area -->
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                            <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                            <!-- Product Badge -->
                                            <div class="product_badge">
                                                <span class="badge-new">New</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">Boutique Silk Dress</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">$120.99 <span>$130</span></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                            <a href="#">View Full Product Details</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <form class="cart" method="post">
                                            <div class="quantity">
                                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                            </div>
                                            <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html"><i class="icofont-exchange"></i></a>
                                            </div>
                                        </form>
                                        <!-- Share -->
                                        <div class="share_wf mt-30">
                                            <p>Share with friends</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View Modal Area -->
    
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>Shop Grid</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Shop Grid</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb Area -->
    
        <section class="shop_grid_area section_padding_100">
            <div class="container">
                <form action="{{ route('shop.filter') }}" method="POST">
                    @csrf
                <div class="row">
                
                        <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                         
                                <div class="shop_sidebar_area">
        
                                    <!-- Single Widget -->
                                    <div class="widget catagory mb-30">
                                        <h6 class="widget-title">Product Categories</h6>
                                        <div class="widget-desc">
                                            @if (!empty($_GET['category']))
                                          
                                                @php
                                                    $filter_cats = explode(',',$_GET['category']);
                                                  
                                                @endphp
                                            @endif
                                            @foreach ($cats as $item)
                                                <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" @if (!empty($filter_cats) && in_array($item->slug, $filter_cats))
                                                    checked
                                                @endif  class="custom-control-input" name="category[]" onchange="this.form.submit();" id="{{ $item->slug }}" value="{{ $item->slug }}"> 
                                                <label class="custom-control-label" for="{{ $item->slug }}">{{ ucfirst($item->title) }} <span class="text-muted">({{ count($item->products) }})</span></label>
                                            </div>
                                            @endforeach
                                        
            
                                        </div>
                                    </div>
            
                                    <!-- Single Widget -->
                                    <div class="widget price mb-30">
                                        <h6 class="widget-title">Filter by Price</h6>
                                        <div class="widget-desc">
                                            <div class="slider-range">
                                                <div data-min="0" data-max="1350" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="1350" data-label-result="Price:">
                                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                </div>
                                                <div class="range-price">Price: 0 - 1350</div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Single Widget -->
                                    <div class="widget color mb-30">
                                        <h6 class="widget-title">Filter by Color</h6>
                                        <div class="widget-desc">
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                <label class="custom-control-label black" for="customCheck6">Black <span class="text-muted">(9)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                <label class="custom-control-label pink" for="customCheck7">Pink <span class="text-muted">(6)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                <label class="custom-control-label red" for="customCheck8">Red <span class="text-muted">(8)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck9">
                                                <label class="custom-control-label purple" for="customCheck9">Purple <span class="text-muted">(4)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck10">
                                                <label class="custom-control-label orange" for="customCheck10">Orange <span class="text-muted">(7)</span></label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Single Widget -->
                                    <div class="widget brands mb-30">
                                        <h6 class="widget-title">Filter by brands</h6>
                                        <div class="widget-desc">
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                <label class="custom-control-label" for="customCheck11">Zara <span class="text-muted">(213)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                <label class="custom-control-label" for="customCheck12">Gucci <span class="text-muted">(65)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                <label class="custom-control-label" for="customCheck13">Addidas <span class="text-muted">(70)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck14">
                                                <label class="custom-control-label" for="customCheck14">Nike <span class="text-muted">(104)</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck15">
                                                <label class="custom-control-label" for="customCheck15">Denim <span class="text-muted">(71)</span></label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Single Widget -->
                                    <div class="widget rating mb-30">
                                        <h6 class="widget-title">Average Rating</h6>
                                        <div class="widget-desc">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span class="text-muted">(103)</span></a></li>
            
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(78)</span></a></li>
            
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(47)</span></a></li>
            
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(9)</span></a></li>
            
                                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(3)</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
            
                                    <!-- Single Widget -->
                                    <div class="widget size mb-30">
                                        <h6 class="widget-title">Filter by Size</h6>
                                        <div class="widget-desc">
                                            <ul>
                                                <li><a href="#">XS</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        
                            </div>
                        <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                            <!-- Shop Top Sidebar -->
                            <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                                <div class="view_area d-flex">
                                    <div class="grid_view">
                                        <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="icofont-layout"></i></a>
                                    </div>
                                    <div class="list_view ml-3">
                                        <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="List View"><i class="icofont-listine-dots"></i></a>
                                    </div>
                                </div>
                                <select id="sortBy" name="sortBy" onchange="this.form.submit()" class="small right">
                                    <option selected>Default</option>
                                    <option value="priceAsc" {{ old('sortBy') == 'priceAsc' ? 'selected' : '' }}>Price :Low to High</option>
                                    <option value="priceDesc" {{ old('sortBy') == 'priceDesc' ? 'selected' : '' }}>Price :High to Low</option>
                                    <option value="titleAsc" {{ old('sortBy') == 'titleAsc' ? 'selected' : '' }}>Title :Ascending</option>
                                    <option value="titleDesc" {{ old('sortBy') == 'titleDesc' ? 'selected' : '' }}>Title :Descending</option>
                                    <option value="discAsc" {{ old('sortBy') == 'discAsc' ? 'selected' : '' }}>Discount :Low to High</option>
                                    <option value="discDesc" {{ old('sortBy') == 'discDesc' ? 'selected' : '' }}>Discount :High to Low</option>
                                </select>
                            </div>
        
                            <div class="shop_grid_product_area">
                                <div class="row justify-content-center">
                                    <!-- Single Product -->
                                    @if (count($products) > 0)
                                        @foreach ($products as $item)
                                        <div class="col-9 col-sm-12 col-md-6 col-lg-4">
                                            <div class="single-product-area mb-30">
                                                <div class="product_image">
                                                    <!-- Product Image -->
                                                    <img class="normal_img" src="{{ $item->photo }}" alt="">
                                                    <img class="hover_img" src="img/product-img/new-1.png" alt="">
            
                                                    <!-- Product Badge -->
                                                    <div class="product_badge">
                                                        <span>{{ $item->conditions }}</span>
                                                    </div>
            
                                                    <!-- Wishlist -->
                                                    <div class="product_wishlist">
                                                        <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                                    </div>
            
                                                    <!-- Compare -->
                                                    <div class="product_compare">
                                                        <a href="compare.html"><i class="icofont-exchange"></i></a>
                                                    </div>
                                                </div>
            
                                                <!-- Product Description -->
                                                <div class="product_description">
                                                    <!-- Add to cart -->
                                                    <div class="product_add_to_cart">
                                                        <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                                    </div>
            
                                                    <!-- Quick View -->
                                                    <div class="product_quick_view">
                                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                                                    </div>
            
                                                    <p class="brand_name">{{ \App\Models\Brand::where('id', $item->brand_id)->value('title') }}</p>
                                                    <a href="{{ route('product.details', $item->slug) }}">{{ $item->title }}</a>
                                                    <h6 class="product-price">${{ number_format($item->offer_price, 2) }} <del class="text-danger">${{ number_format(@$item->price, 2) }}</del></h6>
                                                </div>
                                            </div>
                                        </div>    
                                        @endforeach
                                        
                                    @else
                                        <span class="text-warning">No Product Found!</span>
                                    @endif

                                </div>
                            </div>
                            
                            <!-- Shop Pagination Area -->
                            {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
        
                        </div>
                   
                
                </div>
            </form>
            </div>
        </section>
    
@endsection