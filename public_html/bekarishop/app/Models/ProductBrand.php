<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

}
