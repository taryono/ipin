<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderDetail extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function goods() {
        return $this->belongsTo(Goods::class);
    }
    
    public function request_order() {
        return $this->belongsTo(RequestOrder::class);
    }
    
    public function purchase_order() {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
