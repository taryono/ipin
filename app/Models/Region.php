<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function getNameAttribute($value) {
       return $this->attributes['name'] = ucwords(strtolower($value));
    }
    
    public function supplier() {
        return $this->hasMany(Supplier::class);
    }
    
    public function city() {
        return $this->hasMany(City::class);
    }
}