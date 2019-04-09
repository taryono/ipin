<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionCategory extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public function position() {
        return $this->hasMany(Position::class);
    }  
} 