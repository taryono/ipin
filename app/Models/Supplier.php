<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function goods() {
        return $this->hasMany(Goods::class);
    }
    
    public function subdistrict() {
        return $this->belongsTo(Subdistrict::class);
    }
    
    public function purchase_order() {
        return $this->hasMany(PurchaseOrder::class);
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
