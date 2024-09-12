<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class WishlistController extends Controller
{
    //
    public function wishlist(){
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_quantity');
        $product = Product::getProductByCart($product_id);
       $price = $product[0]['offer_price'];
       $wishlist_array = [];
       foreach (Cart::instance('wishlist')->content() as $key => $value) {
        # code...
       }
    }
}
