<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User', 'customer_id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

    public function paid_by(){
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
    }

    public function payment_method_name()
    {
        return $this-> paid_by -> title;
    }
}
