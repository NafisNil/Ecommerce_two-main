<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
class WishlistController extends Controller
{
    //
    public function wishlist(){
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
       $price = $product[0]['offer_price'];
       $wishlist_array = [];
       foreach (Cart::instance('wishlist')->content() as $key => $value) {
        # code...
        $wishlist_array[] = $value->id;
       }
       if (in_array($product_id, $wishlist_array)) {
        # code...
        $response['present'] = true;
        $response['message'] = "Item is already in the list";
       }
       else{
            $result = Cart::instance('wishlist')->add($product_id, $product[0]['title'], $product_qty, $price)->associate('App\Models\Product');
            if ($result) {
                # code...
                $response['status'] = true;
                $response['message'] ='Item has been saved in the wishlist';
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
       }

       return json_encode($response);
    }

    public function moveToCart(Request $request){
        $item = Cart::instance('wishlist')->get($request->input('rowId'));
        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id, $item->name, 1,$item->price)->associate('App\Models\Product');
        if ($result) {
            # code.
            $response['status'] = true;
            $response['message'] = "Item has been moved to Cart";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if ($request->ajax()) {
            # code...
            $wishlist = view('frontend.layouts._wishlist')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }
        return $response;
    }

    public function wishlistDelete(Request $request){
        $id = $request->input('rowId');
        Cart::instance('wishlist')->remove($id);
        $response['status'] = true;
        $response['message'] = "Item removed from wishlist!";
        $response['cart_count'] = Cart::instance('shopping')->count();
        if($request->ajax()) {
            # code...
            $wishlist = view('frontend.layouts._wishlist')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }
        return $response;
    }
}
