<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Cart;
use Session;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'code' => 'required|min:2',
            'type' => 'required|in:fixed,percentage',
            'status' => 'required|in:active,inactive',
            'value' => 'required|numeric'
        ]);

        $data = $request->all();
        $status = Coupon::create($data);
        if ($status) {
            # code...
            return redirect()->route('coupon.index')->with('success', 'Data added successfully!');
        } else {
            # code...
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $coupon = Coupon::find($id);
        if ($coupon) {
            # code...
            return view('backend.coupon.edit', compact('coupon'));
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $coupon = Coupon::find($id);
        if ($coupon) {
            $this->validate($request, [
                'code' => 'required|min:2',
                'type' => 'required|in:fixed,percentage',
                'status' => 'required|in:active,inactive',
                'value' => 'required|numeric'
            ]);
            $data =  $request->all();
           
            $status = $coupon->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('coupon.index')->with('success', 'Data updated successfully!');
            } else {
                # code...
                return back()->with('error', 'Something went wrong!');
            }
    
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $coupon = Coupon::find($id);
        if ($coupon) {
            # code...
            $status = $coupon->delete();
            if ($status) {
                # code...
                return redirect()->route('coupon.index')->with('success', 'Banner successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    public function couponStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $coupon = Coupon::find($request->id);
        if ($coupon) {
            if ($request->mode == 1) {
                # code...
                $coupon->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $coupon->status = 'inactive';
            }

            $coupon->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Coupon not found'], 404);
        }
    }

    public function couponAdd(Request $request){
        $coupon = Coupon::where('code', $request->input('code'))->first();
        if (!$coupon) {
            # code...
            return back()->with('error', 'Invalid coupon code!');
        } else {
            # code...
            $total_price = Cart::instance('shopping')->subtotal();
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($total_price)
            ]);
            return back()->with('success', 'Coupon applied successfully!');
        }
        

    }

}
