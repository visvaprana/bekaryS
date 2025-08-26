<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

	public function resturant(){
		return $this->belongsTo('App\Models\Resturant', 'resturant_id');
	}



}
