<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Subdistrict extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function getNameAttribute($value) {
       return $this->attributes['name'] = ucwords(strtolower($value));
    }
    
    public function supplier() {
        return $this->hasMany(Supplier::class);
    }
    
    public function district() {
        return $this->belongsTo(District::class)->orderBy('name','ASC');
    }
    
}
