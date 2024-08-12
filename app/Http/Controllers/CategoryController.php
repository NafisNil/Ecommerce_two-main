<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $parent_cats = Category::where('is_parent', 1)->orderby('title')->get();
        return view('backend.categories.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive'
        ]);
      
        $data =  $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count < 1) {
            # code...
            $slug .= time().'-'.$slug;
        }

        $data['slug'] = $slug;

        $status = Category::create($data);
        if ($status) {
            # code...
            return redirect()->route('category.index')->with('success', 'Data added successfully!');
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
        $parent_cats = Category::where('is_parent', 1)->orderby('title')->get();
        $category = Category::find($id);
        if ($category) {
            # code...
            return view('backend.categories.edit', compact('category', 'parent_cats'));
        } else {
            # code...
            return back()->with('status', 'No data found!');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        if ($category) {
            # code...
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable',
                'status' => 'nullable|in:active,inactive'
            ]);
          
            $data =  $request->all();
           
            if ($request->is_parent == 1) {
                # code...
                $data['parent_id'] = null;
            }
            $status = $category->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('category.index')->with('success', 'Data updated successfully!');
            } else {
                # code...
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            # code...
            return back()->with('status', 'No data found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);
        $child_cat_id = Category::where('parent_id', $id)->pluck('id');
        if ($category) {
            # code...
            $status = $category->delete();
            if ($status) {
                # code...
                if (count($child_cat_id) > 0) {
                    # code...
                    Category::shiftChild($child_cat_id);
                }
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

    public function getChidByParentId(Request $request, $id){

        $category = Category::find($id);
        if ($category) {
            # code...
            $child_id = Category::getChidByParentId($id);
            if (count($child_id) <= 0) {
                # code...
                 return response()->json(['status'=>'false','data'=>null, 'msg'=>'']);
            }
            return response()->json(['status'=>'true','data'=>$child_id, 'msg'=>'']);
        }else{
            return response()->json(['status'=>'false','data'=>null, 'msg'=>'']);
        }
        
    }
}
