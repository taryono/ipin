<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Controller as controller_model;

class ControllerController extends AdminController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $controllers = controller_model::where('is_hide', NULL)->get();
        return view('admin.controller.list', compact('controllers'));
    }

    public function create(Request $request) {
        $groups = \App\Models\GroupMenu::all();
        return view('admin.controller.create', compact('groups'));
    }

    public function edit($id) {
        $controller = \App\Models\Controller::find($id);
        $groups = \App\Models\GroupMenu::all();
        return view('admin.controller.edit', compact('controller', 'groups'));
    }

    public function store(Request $request) {
        $name = "\\App\Http\\Controllers\\" . $request->input('name');
        try {
            controller_model::create([
                'name' => $name,
                'title' => $this->setTitle($name),
                'text' => $request->input('title'),
                'group_menu_id' => $request->input('group_menu_id')
            ]);
            return response()->json(['status' => 'success', 'msg' => 'Simpan controller berhasil', 'redirect' => route('controller.index')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Simpan controller gagal', 'redirect' => route('controller.index')]);
        }
    }

    public function update(Request $request, $id) {
        $con = controller_model::find($id);
        $old_title = $con->title;
        $name = "\\App\Http\\Controllers\\" . $request->input('name');

        if (trim($this->setTitle($name)) != trim($old_title)) {
            $menus = \App\Models\Menu::where([
                        'controller_id' => $id,
                    ])->get();
            if ($menus->count() > 0) {
                foreach ($menus as $menu) {
                    $menu->forceDelete();
                }
            }
        }
        $con->update([
            'name' => trim($name),
            'title' => $this->setTitle($name),
            'text' => $request->input('title'),
            'group_menu_id' => $request->input('group_menu_id'),
        ]);
        if ($con) {
            $parent = \App\Models\Menu::where([
                        'controller_id' => $id,
                        'type'=> 'index'
                    ])->first();
            
            $menus = \App\Models\Menu::where([
                        'controller_id' => $id,
                    ])->get();
            if ($menus->count() > 0) { 
                foreach ($menus as $menu) {
                    if($menu->type == "index"){
                        $menu->group_menu_id = $request->input('group_menu_id');
                        $menu->save();
                    }else{
                        $menu->parent = $parent->id;
                        $menu->group_menu_id = $request->input('group_menu_id');
                        $menu->save();
                    }
                }

                return response()->json(['status' => 'success', 'msg' => 'Update controller berhasil', 'redirect' => route('controller.index')]);
            }
        }
        return response()->json(['status' => 'info', 'msg' => 'Update controller gagal', 'redirect' => route('controller.index')]);
    }

    public function show($id) {
        
    }

    public function destroy($id) {
        $controller = \App\Models\Controller::find($id);
        if ($controller) {
            if ($controller && $controller->delete()) { 
                return response()->json(['status' => 'success', 'msg' => 'Hapus controller berhasil', 'redirect' => route('controller.index')],200);
            }
        }
        return response()->json(['status' => 'error', 'msg' => 'Hapus controller gagal', 'redirect' => 'controller'], 200);
    }

    protected function setTitle($name) {
        $text = explode('\\', $name);
        $converted = explode('_', snake_case($text[count($text) - 1]));
        return (str_replace('_controller', '', snake_case($text[count($text) - 1])));
    }

}
