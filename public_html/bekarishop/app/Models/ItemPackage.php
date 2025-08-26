<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPackage extends Model
{
    use HasFactory;
	public function resturant(){
		return $this->belongsTo('App\Models\Resturant', 'resturant_id');
	}
	public function item(){
		return $this->belongsTo('App\Models\Item', 'item_id');
	}


}
