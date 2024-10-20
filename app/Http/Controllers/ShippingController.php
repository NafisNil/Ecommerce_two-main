<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use Session;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shippings = Shipping::orderBy('id', 'DESC')->get();
        return view('backend.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'shipping_address' => 'required|string',
            'delivery_time' => 'required',
            'delivery_charge' => 'nullable|numeric',
            'status' => 'nullable|in:active,inactive'
        ]);
        $data =  $request->all();
      

        $status = Shipping::create($data);
        if ($status) {
            # code...
            return redirect()->route('shipping.index')->with('success', 'Data added successfully!');
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
        $shipping = Shipping::find($id);
        if ($shipping) {
            # code...
            return view('backend.shipping.edit', compact('shipping'));
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
        $shipping = Shipping::find($id);
        if ($shipping) {
            $this->validate($request, [
                'shipping_address' => 'required|string',
                'delivery_time' => 'required',
                'delivery_charge' => 'nullable|numeric',
                'status' => 'nullable|in:active,inactive'
            ]);
            $data =  $request->all();
           
            $status = $shipping->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('shipping.index')->with('success', 'Data updated successfully!');
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
        $shipping = Shipping::find($id);
        if ($shipping) {
            # code...
            $status = $shipping->delete();
            if ($status) {
                # code...
                return redirect()->route('shipping.index')->with('success', 'Data successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    public function shippingStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $shipping = Shipping::find($request->id);
        if ($shipping) {
            if ($request->mode == 1) {
                # code...
                $shipping->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $shipping->status = 'inactive';
            }

            $shipping->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Coupon not found'], 404);
        }
    }
}
