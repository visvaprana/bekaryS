<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{
    use HasFactory;

	public function country(){
		return $this->belongsTo('App\Models\Country', 'country_id');
	}

	public function city(){
		return $this->belongsTo('App\Models\City', 'city_id');
	}

	public function area(){
		return $this->belongsTo('App\Models\Area', 'area_id');
	}

}
