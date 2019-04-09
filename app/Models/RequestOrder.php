<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOrder extends Model
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
    public function request_order_detail() {
        return $this->hasMany(RequestOrderDetail::class);
    } 
    
    public function department() {
        return $this->belongsTo(Department::class);
    } 
    
    public function to_department() {
        return $this->belongsTo(Department::class,'to_department_id', 'id');
    } 
    
    public function status() {
        return $this->belongsTo(Status::class);
    }
     
}
