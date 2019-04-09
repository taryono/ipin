<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingOrder extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function work_order() {
        return $this->belongsTo(WorkOrder::class);
    } 
    
    public function user(){
        return $this->belongsTo(\App\User::class);
    }
    public function shipping_order_detail() {
        return $this->hasMany(ShippingOrderDetail::class);
    } 
    
    public function customer() {
        return $this->belongsTo(Customer::class);
    } 
     
}
