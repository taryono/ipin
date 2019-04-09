<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function goods_code() {
        return $this->belongsTo(GoodsCode::class,'goods_code_id', 'id');
    } 
    
    public function category() {
        return $this->belongsTo(Category::class,'category_id', 'id');
    } 
    
    public function request_order_detail() {
        return $this->hasMany(RequestOrderDetail::class);
    }
    
    public function purchase_order_detail() {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
    
    public function package() {
        return $this->belongsTo(Package::class);
    } 
    
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    } 
    
    public function department() {
        return $this->belongsTo(Department::class);
    } 
    
    public function type() {
        return $this->belongsTo(Type::class);
    } 
}
