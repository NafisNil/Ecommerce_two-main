<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive'
        ]);
        $data =  $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug', $slug)->count();
        if ($slug_count < 1) {
            # code...
            $slug .= time().'-'.$slug;
        }

        $data['slug'] = $slug;

        $status = Banner::create($data);
        if ($status) {
            # code...
            return redirect()->route('banner.index')->with('success', 'Data added successfully!');
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
        $banner = Banner::find($id);
        if ($banner) {
            # code...
            return view('backend.banner.edit', compact('banner'));
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
        $banner = Banner::find($id);
        if ($banner) {
            $this->validate($request, [
                'title' => 'required|string',
                'description' => 'required',
              //  'photo' => 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive'
            ]);
            $data =  $request->all();
           
            $status = $banner->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('banner.index')->with('success', 'Data updated successfully!');
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
        $banner = Banner::find($id);
        if ($banner) {
            # code...
            $status = $banner->delete();
            if ($status) {
                # code...
                return redirect()->route('banner.index')->with('success', 'Banner successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }


    public function bannerStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $banner = Banner::find($request->id);
        if ($banner) {
            if ($request->mode == 1) {
                # code...
                $banner->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $banner->status = 'inactive';
            }

            $banner->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Banner not found'], 404);
        }
    }
}
