<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function goods_code() {
        return $this->belongsTo(GoodsCode::class);
    } 
    
    public function category() {
        return $this->belongsTo(Category::class);
    } 
    
    public function request_order_detail() {
        return $this->hasMany(RequestOrderDetail::class);
    }
    
    public function package() {
        return $this->belongsTo(Package::class);
    } 
    
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    } 
}
