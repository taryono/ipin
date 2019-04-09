<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Http\Controllers\Admin\AdminController;

class UserController extends AdminController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    public function create(Request $request) {
        $roles = Role::where('name', '<>', 'administrator')->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request) {
        $data = $request->input();
        try {
            $user = User::create([
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
            ]);
            $user_detail = \App\Models\UserDetail::where('user_id', $user->id)->first();
            if ($user_detail) {
                $user_detail->update([
                    'first_name' => $data['name'],
                ]);
            } else {
                $user_detail = \App\Models\UserDetail::create([
                            'first_name' => $data['name'],
                            'user_id' => $user->id,
                ]);
            }
            $user->name = $data['name'];
            $user->save();
            $user->roles()->attach(Role::whereIn('name', $data['roles'])->get());

            return response()->json(['status' => 'success', 'msg' => 'Tambah user success', 'redirect' => route('user.index')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'msg' => 'Tambah user success gagal error:' . $e->getMessage(), 'redirect' => route('user.index')]);
        }
    }

    public function show($id) {
        $user = User::find($id);
        $roles = Role::where('name', '<>', 'administrator')->get();
        return view('admin.user.view', compact('user', 'roles'));
    }

    public function edit($id) {
        $user = User::find($id);
        $roles = Role::where('name', '<>', 'administrator')->get();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
            if ($request->has('password')) {
                $user->password = bcrypt($request->input('password'));
                $user->save();
            }
            $user->roles()->attach(Role::whereIn('id', $request->input('roles'))->get());
            return response()->json(['status' => 'success', 'msg' => 'Update user success', 'redirect' => route('user.index')]);
        }
        return response()->json(['status' => 'success', 'msg' => 'Update user success', 'redirect' => route('user.index')]);
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user) {
            $employee = \App\Models\Employee::where('user_id', $id)->first();
            if ($employee) {
                $employee->delete();
            } else {
                $customer = \App\Models\Customer::where('user_id', $id)->first();
                if ($customer) {
                    $customer->delete();
                }
            }
            $user->roles()->detach();
            return response()->json(['success' => $user->delete(), 'redirect' => 'user'], 200);
        }
        abort(404);
    }

}
