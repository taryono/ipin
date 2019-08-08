<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function user_detail() {
        return $this->hasMany(\App\Models\UserDetail::class);
    } 
    
    public function request_order() {
        return $this->hasMany(RequestOrder::class);
    } 
     
    public function position_category() {
        return $this->belongsTo(PositionCategory::class);
    } 

}