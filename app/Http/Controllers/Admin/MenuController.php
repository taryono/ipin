<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Controller as controller_model;

class MenuController extends AdminController
{ 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        $menus = Menu::where('parent',0)->orderBy('name','asc')->get();
        return view('admin.menu.list', compact('menus'));
    }
    
    public function create(Request $request)
    {	
        $controllers = controller_model::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.menu.create', compact('controllers','groups'));
    }
    
    public function show($id)
    {	$menus = \App\Models\Menu::where('parent',$id)->paginate(20); 
        $controllers = controller_model::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.menu.children', compact('menus','controllers','groups'));
    }
    
    public function edit($id)
    {	 
        $menu = \App\Models\Menu::find($id); 
        $controllers = controller_model::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.menu.edit', compact('menu','controllers','groups'));
    }
    
    public function store(Request $request)
    {	
        $types = [
            'index','create','edit','save','update','show','destroy'
        ];
        $menu = Menu::create([
            'route'=> $request->input('route'),
            'name'=> $request->input('name'),
            'controller_id'=> $request->input('path'),
            'action'=> '@'.$request->input('action'),
            'param'=> $request->input('param'),
            'nav_type'=> $request->input('nav_type'),
            'type'=> $request->input('type'),
            'parent'=> $request->input('parent'),
            'title'=> ucfirst($request->input('action')),
            'position'=> $request->input('position'),
            'is_published'=> $request->input('is_published'),
            'is_show'=> $request->input('is_show'),
            'group_menu_id'=> $request->input('group_menu_id'),
            'method'=> $request->input('method'),
        ]);
        if($menu){ 
            $menu->concat = $menu->name.'/'.$menu->param;
            if(!in_array($menu->type,$types)){
                $parent = Menu::where(['controller_id'=>$request->input('path'),'parent'=> 0])->first();
                if($parent){
                    $menu->parent = $parent->id;
                }
            }
            $menu->save();
        }  
        return response()->json(['status'=> 'success','msg'=> 'Tambah data menu berhasil','redirect'=> route('menu.index')],200);
    }
    
    public function update(Request $request, $id)
    {	
        
        $id = $request->input('id');
        $menu = \App\Models\Menu::find($id);
        
        if($menu){
            $menu->update([
                'route'=> $request->input('route'),
                'name'=> $request->input('name'),
                'controller_id'=> $request->input('path'),
                'action'=> '@'.$request->input('action'),
                'param'=> $request->input('param'),
                'nav_type'=> $request->input('nav_type'), 
                'title'=> ucfirst($request->input('action')),
                'position'=> $request->input('position'),
                'is_published'=> $request->input('is_published'), 
                'is_show'=> $request->input('is_show'),
                'group_menu_id'=> $request->input('group_menu_id'), 
                'method'=> $request->input('method'), 
            ]);
            if($menu){
                $menu->parent = $menu->getParent();
                $menu->concat = $menu->name.'/'.$menu->param;
                if($request->has('type')){
                    $menu->type = $request->input('type');
                }else{
                    $menu->type = $request->input('action');
                }
                $menu->save();
            } 
        } 
        return response()->json(['status'=> 'success','msg'=> 'Update data menu berhasil','redirect'=> route('menu.index')],200);
    }
    
    public function children($id)
    {	$menus = \App\Models\Menu::where('parent',$id)->get(); 
        $controllers = controller_model::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.menu.children', compact('menus','controllers','groups'));
    }
}
