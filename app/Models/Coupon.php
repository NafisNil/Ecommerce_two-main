<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code','type','status', 'value'];

    public function discount($total){
        if ($this->type == 'fixed') {
            # code...
            return $this->value;
        } elseif ($this->type == "percentage") {
            # code...
            return ($this->value/100)*$total;
        } else{
            # code...
            return 0;
        }
        
    }
}
