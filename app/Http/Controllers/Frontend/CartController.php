<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
class CartController extends Controller
{
    //
    public function cartStore(Request $request){
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $cart_Array = [];
        foreach (Cart::instance('shopping')->content() as $key => $value) {
            # code...
            $cart_Array[] = $value->id;
        }
        $result = Cart::instance('shopping')->add($product_id, $product[0]['title'], $product_qty, $price)->associate('App\Models\Product');
      
        if ($result) {
            # code...
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item is added!";
        }
        if ($request->ajax()) {
            # code...
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    public function cartDelete(Request $request){
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
       
            # code...
            $response['status'] = true;
            $response['message'] = 'Cart successfully deleted!';
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        
        if ($request->ajax()) {
            # code...
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    public function cart(){
        return view('frontend.pages.cart.index');
    }

    public function cartUpdate(Request $request){
        $this->validate($request,[
            'product_qty' => 'required|numeric'
        ]);
        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty');
        $productQuantity = $request->input('productQuantity');
        if ($request_quantity > $productQuantity) {
            # code...
            $message = "Not enough product in the stock!";
            $response['status'] = false;
        }elseif ($request_quantity < 1) {
            # code...
            $message = "You can't buy less than 1 product!";
            $response['status'] = false;
        }else{
            Cart::instance('shopping')->update($rowId, $request_quantity);
            $message = "Quantity updated successfully!";
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['status'] = true;

        }
        if ($request->ajax()) {
            # code...

            $header = view('frontend.layouts.header')->render();
            $cart_list = view('frontend.layouts._cart-list')->render();
            $response['header'] = $header;
            $response['cart_list'] = $cart_list;
            $response['message'] = $message;
           
        }
        return $response;
    }
 
}
