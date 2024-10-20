<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth;
use Session;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Mail;
use App\Mail\OrderMail;

use Cart;

class CheckoutController extends Controller
{
    //
    public function checkout1(){
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1', compact('user'));
    }

    public function checkout1Store(Request $request){
        //dd($request->note);
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'numeric|required',
            'state' => 'required|string',
            'postcode' => 'numeric|required',
            'postcode' => 'nullable|string',
            'note' => 'nullable|string',
            'saddress' => 'required|string',
            'scity' => 'required|string',
            'scountry' => 'required|string',
            'sstate' => 'required|string',
            'spostcode' => 'numeric|required',
            'sub_total' => 'required|numeric',
            'total_amount' => 'numeric',
        ]);
        Session::push('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state'=> $request->state,
            'country'=> $request->country,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'sfirst_name' => $request->sfirst_name,
            'slast_name' => $request->slast_name,
            'semail' => $request->semail,
            'sphone' => $request->sphone,
            'saddress' => $request->saddress,
            'scity' => $request->scity,
            'scountry' => $request->scountry,
            'sstate'=> $request->sstate,
            'spostcode' => $request->spostcode,
            'sub_total' =>$request->sub_total,
          //  'quantity' => $request->quantity,
            'total_amount' => $request->total_amount
        ]);

        //    dd(Session::get('checkout'));
        $shippings = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();
        return view('frontend.pages.checkout.checkout2', compact('shippings'));
    }

    public function checkout2Store(Request $request){
        $this->validate($request, [
            'delivery_charge' => 'numeric|required'
        ]);
        Session::push('checkout',[
            'delivery_charge' => $request->delivery_charge
        ]);
        return view('frontend.pages.checkout.checkout3');
    }

    public function checkout3Store(Request $request){
        $this->validate($request, [
            'payment_method' => 'required|string',
            'payment_status' => 'string|in:paid,unpaid'
        ]);
        Session::push('checkout',[
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid'
        ]);
      
        return view('frontend.pages.checkout.review');
    }

    public function checkout(Request $request){
      /*  $this->validate($request, [
            
        ]);*/
        $order = new Order;
        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-' . Str::random(6));
      // dd(Session::get('checkout'));
        $order['sub_total'] = Session::get('checkout')[0]['sub_total'];
        if (Session::has('coupon')) {
            # code...
            $order['coupon'] = Session::get('coupon')['value'];
        }else{
            $order['coupon'] =0;
        }
        $order['payment_method'] = Session::get('checkout')[2] ['payment_method'];
        $order['payment_status'] = Session::get('checkout')[2] ['payment_status'];
        $order['condition'] = "Pending";
        $order['delivery_charge'] = Session::get('checkout')[1] ['delivery_charge'];
        $order['first_name'] = Session::get('checkout')[0] ['first_name'];
        $order['last_name'] = Session::get('checkout') [0] ['last_name'];
        $order['email'] = Session::get('checkout') [0] ['email'];
        $order['phone'] = Session::get('checkout')[0]  ['phone'];
        $order['address'] = Session::get('checkout')[0]  ['address'];
        $order['country'] = Session::get('checkout') [0] ['country'];
        $order['state'] = Session::get('checkout')[0]  ['state'];
        $order['city'] = Session::get('checkout') [0] ['city'];
        $order['postcode'] = Session::get('checkout')[0]  ['postcode'];
        $order['note'] = Session::get('checkout') [0] ['note'];
        $order['sfirst_name'] = Session::get('checkout')[0]  ['sfirst_name'];
        $order['slast_name'] = Session::get('checkout')[0]  ['slast_name'];
        $order['semail'] = Session::get('checkout') [0] ['semail'];
        $order['saddress'] = Session::get('checkout') [0] ['saddress'];
        $order['sphone'] = Session::get('checkout')[0]  ['sphone'];
        $order['spostcode'] = Session::get('checkout')[0]  ['spostcode'];
        $order['scountry'] = Session::get('checkout') [0] ['scountry'];
        $order['scity'] = Session::get('checkout') [0] ['scity'];
        $order['sstate'] = Session::get('checkout') [0] ['sstate'];
        $order['total_amount'] = (float)str_replace(',', '', Session::get('checkout')[0]['sub_total'] ) + Session::get('checkout')[1] ['delivery_charge']-$order['coupon'];

        $status = $order->save();
        if ($status) {
            # code..
            Mail::to($order['email'])->bcc($order['semail'])->cc('nafis.zaman.35@gmail.com')->send(new OrderMail($order));
            Cart::instance('shopping')->destroy();
            Session::forget('checkout');
            Session::forget('coupon');
            return redirect()->route('complete', $order['order_number']);
        }else{
            return redirect()->route('checkout1')->with('error', 'Please try again!');
        }
    }

    public function complete($order){
        $order = $order;
        return view('frontend.pages.checkout.complete', compact('order'));
    }
}
