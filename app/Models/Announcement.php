<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{   use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
 
    public function to_department() {
        return $this->belongsTo(Department::class,'to_department_id','id');
    }
    
    public function from_department() {
        return $this->belongsTo(Department::class,'from_department_id','id');
    }
     
}
