<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    protected $with = ['customer'];


    public function request_order() {
        return $this->hasOne(RequestOrder::class);
    }
    
     public function customer() {
        return $this->belongsTo(Customer::class);
    }
    
     public function shipping_order() {
        return $this->hasMny(ShippingOrder::class);
    }
}
