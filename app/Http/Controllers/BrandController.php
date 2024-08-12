<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'string|nullable',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug', $slug)->count();
        if ($slug_count < 1) {
            # code...
            $slug .= time().'-'.$slug;
        }

        $data['slug'] = $slug;
        $status = Brand::create($data);
        if ($status) {
            # code...
            return redirect()->route('brand.index')->with('success', 'Data created successfully!');
        }else{
            return back()->with('error','something went wrong!');
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
        $brand = Brand::find($id);
        if ($brand) {
            # code...
            return view('backend.brand.edit', compact('brand'));
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
        $brand = Brand::find($id);
        if ($brand) {
            $this->validate($request, [
                'title' => 'required|string',
              
                'photo' => 'required',
         
            ]);
            $data =  $request->all();
           
            $status = $brand->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('brand.index')->with('success', 'Data updated successfully!');
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
        $brand = Brand::find($id);
        if ($brand) {
            # code...
            $status = $brand->delete();
            if ($status) {
                # code...
                return redirect()->route('brand.index')->with('success', 'Brand successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    public function brandStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $brand = Brand::find($request->id);
        if ($brand) {
            if ($request->mode == 1) {
                # code...
                $brand->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $brand->status = 'inactive';
            }

            $brand->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Banner not found'], 404);
        }
    }
}
