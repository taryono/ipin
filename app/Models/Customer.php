<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    public function subdistrict() {
        return $this->belongsTo(Subdistrict::class);
    }
    
    public function work_order() {
        return $this->hasMany(WorkOrder::class);
    }
     
    public function shipping_order() {
        return $this->hasMany(ShippingOrder::class);
    }
    
    public function district() {
        return $this->belongsTo(District::class);
    }
    
    public function city() {
        return $this->belongsTo(City::class);
    }
    
    public function region() {
        return $this->belongsTo(Region::class);
    }
    
    public function country() {
        return $this->belongsTo(Country::class);
    }
     
}
