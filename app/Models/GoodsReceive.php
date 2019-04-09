<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsReceive extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];  
    
    public function purchase_order() {
        return $this->belongsTo(PurchaseOrder::class);
    }
     
    public function goods_receive_detail() {
        return $this->hasMany(GoodsReceiveDetail::class);
    } 
}
