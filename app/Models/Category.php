<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'summary', 'photo', 'is_parent', 'parent_id','status'];
    public  static function shiftChild($id){
        return Category::whereIn('id',$id)->update(['is_parent'=>'1']);
    }

    public static function getChidByParentId($id){
        return Category::where('parent_id', $id)->get();
    }

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }
}
