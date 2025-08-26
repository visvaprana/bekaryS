<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }       
    public function color(){
        return $this->belongsTo('App\Models\Color', 'color_id');
    }       
    public function size(){
        return $this->belongsTo('App\Models\Size', 'size_id');
    }       
    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }   
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }  
}
