<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use SoftDeletes;
    public $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public function users() {
        return $this->belongsToMany(\App\User::class);
    }
    
    public function group_menu() {
        return $this->belongsToMany(GroupMenu::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }
    
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($model){
            $menu_roles = MenuRole::where([
                    'role_id' => $model->id, 
                ])->get();
             if($menu_roles->count()>0){
                 foreach ($menu_roles as $menu_role) {
                     $menu_role->delete();
                 }
             }
             
             $role_users = RoleUser::where([
                    'role_id' => $model->id, 
                ])->get();
             if($role_users->count()>0){
                 foreach ($role_users as $role_user) {
                     $role_user->delete();
                 }
             }
        });
        
    }
     
}
