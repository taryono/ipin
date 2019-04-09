<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Controller as controller_model;

class GroupMenuController extends AdminController
{ 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	 
        $group_menus = \App\Models\GroupMenu::paginate(20);
        return view('admin.group_menu.list', compact('group_menus'));
    }
    
    public function create(Request $request)
    {	$menus = \App\Models\Menu::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.group_menu.create', compact('menus','groups'));
    }
    
    public function edit($id)
    {	$group = \App\Models\GroupMenu::find($id);
        return view('admin.group_menu.edit', compact('group'));
    }
    
    public function store(Request $request)
    {	$group_menu = \App\Models\GroupMenu::create([
            'is_published'=> $request->input('is_published'),
            'name'=> $request->input('name'),
             
        ]);  
        return response()->json(['status'=> 'success','msg'=> 'Tambah data grup menu berhasil','redirect'=> route('group_menu.index')],200);
    }
    
    public function update(Request $request, $id)
    {	 
        $group_menu = \App\Models\GroupMenu::find($id);
         
        if($group_menu){
            $group_menu->update($request->input());  
        }
        return response()->json(['status'=> 'success','msg'=> 'Update data grup menu berhasil','redirect'=> route('group_menu.index')],200);
    }
    
    public function children($id)
    {	$menus = \App\Models\Menu::where('parent',$id)->paginate(20); 
        $controllers = controller_model::all();  
        $groups = \App\Models\GroupMenu::all();
        return view('admin.group_menu.children', compact('menus','controllers','groups'));
    }
    
    public function destroy($id) {
        $group_menu = \App\Models\GroupMenu::find($id);
        if ($group_menu && $group_menu->delete()) {
            return response()->json(['status'=> 'success','msg'=> 'Hapus data grup menu berhasil','redirect'=> route('group_menu.index')],200);
        }
        return response()->json(['status'=> 'error','msg'=> 'Hapus data grup menu berhasil','redirect'=> route('group_menu.index')],200);
    }
}
