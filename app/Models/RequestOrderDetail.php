<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOrderDetail extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function goods() {
        return $this->belongsTo(Goods::class);
    } 
    
    public function purchase_order_detail() {
        return $this->hasMany(PurchaseOrderDetail::class);
    } 
}
