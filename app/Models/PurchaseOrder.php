<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    } 
    
    public function purchase_order_detail() {
        return $this->hasMany(PurchaseOrderDetail::class);
    } 
    
    public function user() {
        return $this->belongsTo(\App\User::class);
    } 
    
    public function status() {
        return $this->belongsTo(Status::class);
    }
}
