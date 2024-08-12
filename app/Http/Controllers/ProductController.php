<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backend.product.index', compact('products'));
    }


    public function productStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $products = Product::find($request->id);
        if ($products) {
            if ($request->mode == 1) {
                # code...
                $products->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $products->status = 'inactive';
            }

            $products->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Banner not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|required',
            'stock' =>  'nullable|numeric',
            'price' =>  'nullable|numeric',
            'discount' =>  'nullable|numeric',
            'photo' => 'required',
            'cat_id' => 'required',
           
            'size' => 'nullable',
            'condition' => 'nullable',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data =  $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count < 1) {
            # code...
            $slug .= time().'-'.$slug;
        }

        $data['slug'] = $slug;
        $data['offer_price'] = ($request->price-(($request->price * $request->discount)/100));
        $status = Product::create($data);
        if ($status) {
            # code...
            return redirect()->route('product.index')->with('success', 'Data added successfully!');
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
        $product = Product::find($id);
        if ($product) {
            # code...
            return view('backend.categories.view', compact('category', 'parent_cats'));
        } else {
            # code...
            return back()->with('status', 'No data found!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
