<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Session;
use Auth;
use Hash;
class IndexController extends Controller
{
    //
    public function home(){
        $banners = Banner::where(['status'=>'active', 'condition'=>'banner'])->orderBy('id','desc')->limit('4')->get();
        $categories = Category::where(['status'=>'active', 'is_parent'=>'1'])->orderBy('id','desc')->limit('3')->get();
        return view('frontend.index', compact('banners','categories'));
    }

    public function productCategory(Request $request, $slug){
        $category = Category::with('products')->where('slug', $slug)->first();
        $sort = '';
        if ($request->sort != null) {
            # code...
            $sort = $request->sort;
        }
        if ($category  == null) {
            # code...
            return view('errors.404');
        }else{
            if ($sort == "priceAsc") {
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('offer_price','asc')->paginate(12);
            } elseif ($sort == "priceDesc") {
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('offer_price','desc')->paginate(12);
            } 
            elseif ($sort == "discAsc") {
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('discount','asc')->paginate(12);
            } 
            elseif ($sort == "discDesc") {
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('discount','desc')->paginate(12);
            } 
            elseif ($sort == "titleDesc") {
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('title','desc')->paginate(12);
            } else{
                # code...
                $products = Product::where(['status'=>'active', 'cat_id'=>$category->id])->orderBy('title','asc')->paginate(12);
            }
            
        }

        $route = 'product-cat';
        if ($request->ajax()) {
            # code...
            $view = view('frontend.layouts._single-product', compact('products'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('frontend.pages.product.product-category', compact('category','route','products'));
    }

    public function productDetails($slug){
        $product = Product::with('rel_product')->where('slug', $slug)->first();
        if ($product) {
            # code...
            return view('frontend.pages.product.product-details',compact('product'));
        }else{
            return "Product will not found!";
        }
    }

    public function userAuth(){
        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request){
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status'=>'active'])) {
            # code...
            $request->session()->put('user', $request->email);
            if (Session::get('url.intended')) {
                # code...
                 return redirect(Session::get('url.intended'));
            }else{
                return redirect()->route('home')->with('success','successfully login!');
            }
            
        }else{
             return redirect()->back()->with('error', 'invalid credentials!');
        }
    }

    public function registerSubmit(Request $request){
       $this->validate($request,[
            'username' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed'
       ]);
       $data= $request->all();
       $check = $this->create($data);
       Session::put('user',$data['email']);
       Auth::login($check);
       if ($check) {
        # code...
        return redirect()->route('index')->with('success','Successfully registered!');
       }else{
        return back();
       }
    }

    private function create(array $data){
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function userLogout(){
        Session::forget('user');
        Auth::logout();
        return redirect()->route('index')->with('success','Successfully logout!');
    }

    public function userDashboard(){
        $user = Auth::user();
        return view('frontend.user.dashboard',compact('user'));
    }

    public function userOrder(){
        $user = Auth::user();
        return view('frontend.user.order',compact('user'));
    }

    public function userAddress(){
        $user = Auth::user();
        return view('frontend.user.address',compact('user'));
    }

    public function userAccount(){
        $user = Auth::user();
        return view('frontend.user.account',compact('user'));
    }

    public function billingAddress(Request $request, $id){
        $user = User::where('id', $id)->update(['country'=> $request->country, 'city'=>$request->city, 'state'=>$request->city, 'postcode'=>$request->postcode]);
       if ($user) {
        # code...
        return back()->with('success', 'Address saved successfully!');
       } else {
        # code...
        return back()->with('error', 'something went wrong!');
       }
       
    }
}
