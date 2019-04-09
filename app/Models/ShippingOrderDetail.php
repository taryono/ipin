<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingOrderDetail extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function goods() {
        return $this->belongsTo(Goods::class);
    } 
    
    public function shipping_order() {
        return $this->belongsTo(ShippingOrder::class);
    } 
}
