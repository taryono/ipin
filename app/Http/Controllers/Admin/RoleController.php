<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends AdminController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
         
        $roles = \App\Models\Role::where('name', '<>', 'administrator')->paginate(10);
        return view('admin.role.list', compact('roles'));
    }

    public function create(Request $request) {
        return view('admin.role.create');
    }

    public function store(Request $request) {
        $role = \App\Models\Role::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'parent' => 1
        ]);
        if ($role) {
            return response()->json(['status'=> 'success','msg'=> 'Tambah Role berhasil','redirect'=> route('role.index')],200);
        }
    }

    public function edit($id) {
        $role = \App\Models\Role::find($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id) {
        $role = \App\Models\Role::find($id);
        if ($role) {
            $role->update($request->input());
        } 
        return response()->json(['status'=> 'success','msg'=> 'Update Role berhasil','redirect'=> route('role.index')],200);
    }

    public function role_user(Request $request) {
        return view('admin.role.role_user');
    }
    
    public function destroy($id) {
        $role = \App\Models\Role::find($id);
        if ($role && $role->delete()) {  
            return response()->json(['status'=> 'success','msg'=> 'Hapus Role berhasil','redirect'=> route('role.index')],200);
        }
        return response()->json(['status'=> 'success','msg'=> 'Hapus Role gagal','redirect'=> route('role.index')],200);
    }

}
