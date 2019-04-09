<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model {
    use SoftDeletes;
    public $guarded = ['id'];     
    protected $dates = ['deleted_at'];
    
    public function request_order() {
        return $this->hasMany(RequestOrder::class);
    }  
    
    public function purchase_order() {
        return $this->hasMany(PurchaseOrder::class);
    }  
}
