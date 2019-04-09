<?php

namespace App\Http\Controllers\Employee;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends EmployeeController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $departments = \App\Models\Department::paginate(20);
        return view('employee.department.list', compact('departments'));
    }

    public function create(Request $request) { 
        return view('employee.department.create');
    }

    public function store(Request $request) {
        try {
            $department = \App\Models\Department::create($request->input());
            if ($department) {
                return response()->json(['status' => 'success', 'msg' => 'Hapus data department berhasil', 'redirect' => route('department.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'msg' => $e->getMessage(), 'redirect' => route('department.index')], 200);
        }
    }

    public function edit($id) {
        $department = \App\Models\Department::find($id);
        
        return view('employee.department.edit', compact('department'));
    }

    public function update(Request $request, $id) {
        $department = \App\Models\Department::find($id);

        if ($department) {
            $department->update($request->input()); 
            return response()->json(['status' => 'success', 'msg' => 'Update data department berhasil', 'redirect' => route('department.index')], 200);
        } 
        return response()->json(['status' => 'fail', 'msg' => 'Update data department gagal', 'redirect' => route('department.index')], 200);
    }

    public function destroy($id) {
        $department = \App\Models\Department::find($id);
        if ($department && $department->delete()) { 
            return response()->json(['status' => 'success', 'msg' => 'Hapus data department berhasil', 'redirect' => route('department.index')], 200);
        }
       return response()->json(['status' => 'fail', 'msg' => 'Hapus data department gagal', 'redirect' => route('department.index')], 200);
    }
}
