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
        Session::put('url.intended', URL::previous);
        $user = Auth::user();
        return view('frontend.user.account',compact('user'));
    }

    public function billingAddress(Request $request, $id){
        $user = User::where('id', $id)->update(['country'=> $request->country, 'city'=>$request->city, 'state'=>$request->state, 'postcode'=>$request->postcode, 'address' => $request->address]);
       if ($user) {
        # code...
        return back()->with('success', 'Address saved successfully!');
       } else {
        # code...
        return back()->with('error', 'something went wrong!');
       }
       
    }

    public function shippingAddress(Request $request, $id){
        $user = User::where('id', $id)->update(['scountry'=> $request->scountry, 'scity'=>$request->scity, 'sstate'=>$request->scity, 'spostcode'=>$request->spostcode, 'saddress'=>$request->saddress]);
       if ($user) {
        # code...
        return back()->with('success', 'Shipping Address saved successfully!');
       } else {
        # code...
        return back()->with('error', 'something went wrong!');
       }
       
    }

    public function updateAccount(Request $request, $id){
        $this->validate($request, [
            'newpassword' => 'min:4',
            'oldpassword' => 'min:4',
            'username' => 'string',
            'full_name' => 'required',
            'phone' => 'nullable|min:8'
        ]);
        $hashpassword = Auth::user()->password;
        if ($request->oldpassword == null && $request->newpassword == null) {
            # code...
            User::where('id', $id)->update(['Full_name'=>$request->full_name, 'username' => $request->username,'phone'=>$request->phone]);
            return back()->with('success','Account updated successfully!');
        }else{
            
            if (\Hash::check($request->oldpassword, $hashpassword)) {
                # code...
             
                if (!\Hash::check($request->newpassword, $hashpassword)) {
                    # code...
                    
                    User::where('id', $id)->update(['Full_name'=>$request->full_name, 'username' => $request->username,'phone'=>$request->phone, 'password'=> $request->newpassword]);
                    return back()->with('success','Account updated successfully!');
                }else{
                    return back()->with('error', 'New password should be different from the old!');
                }
            }else{
               
                return back()->with('error','old password do not match!');
            }
            
        }
    }

    public function shop(Request $request){
        $products = Product::query();
        if (!empty($_GET['category'])) {
            # code...
            $slugs  =explode(',',$_GET['category']);
            $cats_id  = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('cat_id', $cats_id)->paginate(9);
           // return $products;
        }
        $sort =$_GET['sortBy'];
        if (!empty($sort)) {
            # code...
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
        else{
            $products = Product::where('status', 'active')->paginate(9);
        }
        $cats  = Category::where('status','active')->where('is_parent',1)->with('products')->orderBy('title','asc')->get();
        return view('frontend.pages.product.shop', compact('products', 'cats'));
    }

    public function shopFilter(Request $request){
        $data = $request->all();
        $catUrl = "";
        if (!empty($data['category'])) {
            # code...
            foreach ($data['category'] as $key => $category) {
                # code...
                if (empty($catUrl)) {
                    # code...
                    $catUrl .= "&category=".$category;
                }else{
                    $catUrl .=",".$category;
                }
            }
        }
       
        $sortByUrl = "";
        if (!empty($data['sortBy'])) {
            # code...
            $sortByUrl  .= "&sortBy=".$data['sortBy'];
           
        }
        return \redirect()->route('shop', $catUrl.$sortByUrl);
    }
}
