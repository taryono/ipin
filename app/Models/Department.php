<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function user() {
        return $this->hasMany(\App\User::class);
    } 
    
    public function request_order() {
        return $this->hasMany(RequestOrder::class);
    }  
    
    public function goods() {
        return $this->hasMany(Goods::class);
    }
    
    public function announcement() {
        return $this->hasMany(Announcement::class);
    }

}