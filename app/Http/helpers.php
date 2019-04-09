<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getActions($name, $type = NULL, $param = NULL) {
    if (\Auth::user()->menus) {
        $role_ids = [];
        foreach (\Auth::user()->roles()->get() as $role) {
            $role_ids[] = $role->id;
        }
        $menu_ids = [];
        foreach (json_decode(\Auth::user()->menus) as $menu) {
            $menu_ids[] = $menu->id;
        }
        $menu_roles = \App\Models\MenuRole::with('menu', 'menu.controller')->whereIn('role_id', $role_ids)->get();
        $titles = [];
        $types = [];
        if ($menu_roles->count() > 0) {
            foreach ($menu_roles as $mr) {
                if ($mr->menu){
                    if(isset($mr->menu) && isset($mr->menu->controller)){
                        $titles[] = $mr->menu->controller->title;
                        if ($mr->menu->controller->title == $name && $mr->{$type} == 1) {
                            $types[$type] = $mr->{$type};
                        }
                    }
                    
                }
                
            }
        }
        if (in_array($name, $titles) && array_key_exists($type, $types) && $types[$type]) {
            return menuBuilder($name, $type, $param);
        }
    }
    return NULL;
}

function getStatus($role_id, $menu_id, $type) {
    $role_menu = \App\Models\MenuRole::where([
                'role_id' => $role_id,
                'menu_id' => $menu_id,
            ])->first();
    if ($role_menu) {
        if ($role_menu->{$type} == 1) {
            return "checked='checked'";
        } else {
            return NULL;
        }
    } else {
        return NULL;
    }
}

function groups() {
    $groups = [];
    if (\Auth::user()->menus) {
        $is_admin = \Auth::user()->isAdmin();
         
        foreach (json_decode(\Auth::user()->menus) as $menu) {
            $menu = \App\Models\Menu::find($menu->id);  
            if($menu && $menu->group_menu_id != 7){
                if(isset($menu->group_menu)){
                    if($is_admin){
                        $groups [$menu->group_menu_id] = $menu->group_menu->is_published ? $menu->group_menu : NULL;
                    }else{
                        if($menu->group_menu_id !=1){
                            $groups [$menu->group_menu_id] = $menu->group_menu->is_published ? $menu->group_menu : NULL;
                        }
                    }
                } 
            }
            
        }
    }

    return array_values($groups);
}

function groupMenu($group_id) {
    $menus = [];
    if (\Auth::user()->menus) {
        $show = [];
        foreach (json_decode(\Auth::user()->menus) as $menu) {
            $controller = \App\Models\Controller::find($menu->controller_id);
            if ($controller) { 
                if (!in_array($menu->type . $menu->id, $show)) {
                    $show[] = $menu->type . $menu->id;
                    if ($menu->group_menu_id == $group_id && $menu->type == "index") { 
                        $menus [] = $menu;
                    }
                }
            }
        }
    } 
    return $menus;
}

function menuBuilder($name, $type, $param = NULL, $is_modal = TRUE) {
    if($name != "acl"){
        if($type != "destroy"){
            $route = '<a data-toggle="modal" href="#modal_popup" class="'.$type.'" style="display:inline !important;" data-url="';
        }else{
            $route = '<a style="cursor:pointer;" class="'.$type.'" data-url="';
        } 
    }else{
        if($type != "destroy"){
            $route = '<a class="acl-edit" href="';
        }else{
            $route = '<a style="cursor:pointer;" class="'.$type.'" href="';
        }
        
    }
    
    if ($type == "edit") {
        $route .= $name . "/" . $param . '/edit" title="'.title($type).'">';
    } elseif ($type == "update" || $type == "show" || $type == "destroy") {
        $route .= ($type == "destroy") ? route($name . "." . $type, $param) . '" class="delete" id="' . $name . '.index' . '" title="'.title($type).'">' : $name . "/" . $param . '" title="'.title($type).'">';
    } elseif ($type == "print") {
        $route .=  route($name . "." . $type, $param) . '" id="' . $name . '.index' . '" title="'.title($type).'">';
    } elseif ($type == "create") {
        $route .= $name . '/create" title="'.title($type).'">';
    } else {
        $route .= $name . '" title="'.title($type).'">';
    }
    $route .= translate($type); 
    $route .= '</a>';
    return $route;
}

function translate($type){
    $types=[
        'destroy'=> '<i class="fa fa-trash" aria-hidden="true"></i>',
        'create'=> '<button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah </button>',
        'edit'=> '<i class="fa fa-edit" aria-hidden="true"></i>',
        'update'=> '<i class="fa fa-search" aria-hidden="true"></i>',
        'show'=> '<i class="fa fa-file" aria-hidden="true"></i>',
        'print'=> '<i class="fa fa-print" aria-hidden="true"></i>',
    ];
    return ucfirst($types[$type]);
}

function title($type){
    $types=[
        'destroy'=> 'Hapus',
        'create'=> 'Tambah',
        'edit'=> 'Edit',
        'update'=> 'Update',
        'show'=> 'Lihat Detail',
        'print'=> 'Cetak',
    ];
    return ucfirst($types[$type]);
}

function rupiahFormat($price) {
    return "Rp.&nbsp;" . number_format((float) $price,0).',-';
}

 function dateFormatIndo($date){
    $days = [
        'Mon'=> 'Senin',
        'Tue'=> 'Selasa',
        'Wed'=> 'Rabu',
        'Thu'=> 'Kamis',
        'Fri'=> 'Jum\'at',
        'Sat'=> 'Sabtu',
        'Sun'=> 'Ahad'
    ];
    return $days[date('D', strtotime($date))].' '.date('d/m/Y', strtotime($date));
}

function number($object){
    return ($object->perPage()*$object->currentPage() - ($object->perPage()-1)); 
}