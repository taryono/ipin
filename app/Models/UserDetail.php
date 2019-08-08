<?php

namespace App\Models; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class UserDetail extends Model {
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function position() {
        return $this->belongsTo(\App\Models\Position::class);
    }
    
    public function department() {
        return $this->belongsTo(\App\Models\Department::class);
    }
}
