<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $category = Category::find($id);
        if ($category) {
            # code...
            $status = $category->delete();
            if ($status) {
                # code...
                return redirect()->route('category.index')->with('success', 'Category successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }

    public function categoryStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $category = Category::find($request->id);
        if ($category) {
            if ($request->mode == 1) {
                # code...
                $category->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $category->status = 'inactive';
            }

            $category->save();
            return response()->json(['status' => 'successfully updated!'], 200);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Banner not found'], 404);
        }
    }
}
