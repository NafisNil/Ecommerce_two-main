<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug', 'summary','description','stock','brand_id','brand_id','cat_id','child_cat_id','photo','price','offer_price','discount','size','conditions','vendor_id','status'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function rel_product(){
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status','active')->limit(8);
    }


    public static function getProductByCart($id){
        return self::where('id', $id)->get()->toArray();
    }
}
