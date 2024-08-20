<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'DESC')->get();
        return view('backend.user.index', compact('users'));
    }

    public function userStatus(Request $request){
        \Log::info('Received request data:', $request->all());

        // Validate the request
        $request->validate([
            'mode' => 'required|boolean',
            'id' => 'required|integer'
        ]);
        
        // Assuming you have a Banner model to update the status
        $user = User::find($request->id);
        if ($user) {
            if ($request->mode == 1) {
                # code...
                $user->status = 'active';
            }elseif ($request->mode == 0) {
                # code...
                $user->status = 'inactive';
            }

            $user->save();
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
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'full_name' => 'string|required',
            'username' => 'string|nullable',
            'email' => 'email|required|unique:users,email',
            'password' =>  'min:4|required',
            'phone' =>  'nullable|string',
            'photo' => 'required',
            'address' => 'string|nullable',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'nullable|in:active,inactive',
            ]);
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $status = User::create($data);
            if ($status) {
                # code...
                return redirect()->route('user.index')->with('success', 'Data added successfully!');
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
        $user = User::find($id);
        if ($user) {
            # code...
            return view('backend.user.edit', compact('user'));
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
        $user = User::find($id);
        if ($user) {
            # code...
            $this->validate($request, [
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|exists:users,email',
                'password' =>  'min:4|required',
                'phone' =>  'nullable|string',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,vendor',
                'status' => 'nullable|in:active,inactive',
            ]);
          
            $data =  $request->all();
           
           
            $status = $user->fill($data)->save();
            if ($status) {
                # code...
                return redirect()->route('user.index')->with('success', 'Data updated successfully!');
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
        $user = User::find($id);
      
        if ($user) {
            # code...
            $status = $user->delete();
            if ($status) {
                # code...
                return redirect()->route('user.index')->with('success', 'Product successfully deleted!');
            }else{
                return back()->with('error', 'Data not found!');
            }
        }else{
            return back()->with('error', 'Data not found!');
        }
    }
}
