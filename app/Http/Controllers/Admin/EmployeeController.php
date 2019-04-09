<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;

class EmployeeController extends AdminController { 

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $users = \App\User::with('user_detail')->whereHas('roles', function($q) {
                    $q->whereNotIn('name', ['administrator']);
                })->paginate(20);
        return view('admin.employee.list', compact('users'));
    }

    public function create(Request $request) {
        $roles = Role::where('name', '<>', 'administrator')->get();
        $departments = \App\Models\Department::all();
        $positions = \App\Models\Position::all();
        $religions = \App\Models\Religion::all();
        return view('admin.employee.create', compact('roles','departments', 'positions','religions'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $user = User::create([
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
        ]);

        $user_detail = \App\Models\UserDetail::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address' => $request->input('address'),
                    'cellphone' => $request->input('cellphone'),
                    'phone_number' => $request->input('phone_number'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'sex' => $request->input('sex'),
                    'department_id' => $request->input('position_id'),
                    'position_id' => $request->input('position_id'),
                    'religion_id' => $request->input('religion_id'),
                    'user_id' => $user->id,
        ]);
        $user->name = $user_detail->first_name . ' ' . $user_detail->last_name;
        $user->save();
        if ($request->has('roles')) {
            foreach ($request->input('roles') as $id){
                $user->roles()->attach(Role::where('id', $id)->first());
            }
                
        } 
       return response()->json(['status'=> 'success','msg'=> 'Tambah data karyawan berhasil','redirect'=> route('employee.index')]);
    }

    public function edit($id) {
        $user = User::find($id);
        $roles = Role::where('name', '<>', 'administrator')->get();
        $departments = \App\Models\Department::all();
        $positions = \App\Models\Position::all();
        $religions = \App\Models\Religion::all();
        return view('admin.employee.edit', compact('roles', 'user','departments','positions','religions'));
    }
 
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) { 
            $user = User::find($id);
            if ($user) {
                $user->update([
                    'email' => $request->input('email'),
                ]);
                $user_detail = $user->user_detail;
                if ($user_detail) {
                    $user_detail->update([
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'address' => $request->input('address'),
                        'cellphone' => $request->input('cellphone'),
                        'phone_number' => $request->input('phone_number'),
                        'date_of_birth' => $request->input('date_of_birth'),
                        'position_id' => $request->input('position_id'),
                        'department_id' => $request->input('department_id'),
                        'religion_id' => $request->input('religion_id'),
                        'sex' => $request->input('sex'),
                    ]);
                } else {
                    $user_detail = \App\Models\UserDetail::create([
                                'first_name' => $request->input('first_name'),
                                'last_name' => $request->input('last_name'),
                                'address' => $request->input('address'),
                                'cellphone' => $request->input('cellphone'),
                                'phone_number' => $request->input('phone_number'),
                                'date_of_birth' => $request->input('date_of_birth'),
                                'sex' => $request->input('sex'),
                                'position_id' => $request->input('position_id'),
                                'department_id' => $request->input('department_id'),
                                'religion_id' => $request->input('religion_id'),
                                'user_id' => $user->id,
                    ]);
                }
            }
            $user->name = $user_detail->first_name . ' ' . $user_detail->last_name;
            $user->save();
            if($request->has('roles')){
            $user->roles()->detach();
            foreach ($request->input('roles') as $id){
                $user->roles()->attach(Role::where('id', $id)->first());
            }
                
        }
        return response()->json(['status'=> 'success','msg'=> 'Update data karyawan berhasil','redirect'=> route('employee.index')]);
    }

    public function destroy($id) {
        $user = \App\User::find($id);
        if ($user) {
            $role_users = \App\Models\RoleUser::where([
                        'user_id' => $id,
                    ])->get();
            if ($role_users->count() > 0) {
                foreach ($role_users as $role) {
                    $role->delete();
                }
            }
            $user->delete(); 
            return response()->json(['status'=> 'success','msg'=> 'Hapus data karyawan berhasil','redirect'=> route('employee.index')],200);
        }
        return response()->json(['status'=> 'success','msg'=> 'Hapus data karyawan gagal','redirect'=> route('employee.index')],200);
    }

}
