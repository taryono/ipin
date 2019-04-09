<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PositionController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $positions = \App\Models\Position::paginate(20);
        return view('employee.position.list', compact('positions'));
    }

    public function create(Request $request) {
        $position_categories = \App\Models\PositionCategory::all();
        return view('employee.position.create', compact('position_categories'));
    }

    public function store(Request $request) {
        try {
            $position = \App\Models\Position::create([
                        'name' => $request->input('name'),
                        'code' => $request->input('code'),
                        'position_category_id' => $request->input('position_category_id'),
            ]);
            if ($position) {
                return response()->json(['status' => 'success', 'msg' => 'Tambah Jabatan Berhasil', 'redirect' => route('position.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage(), 'redirect' => route('position.index')], 200);
        }
    }

    public function edit($id) {
        $position = \App\Models\Position::find($id);
        $position_categories = \App\Models\PositionCategory::all();
        if ($position) {
            return view('employee.position.edit', compact('position', 'position_categories'));
        }
    }

    public function update(Request $request, $id) {
        $position = \App\Models\Position::find($id);
        try {
            if ($position) {
                $position->update([
                    'name' => $request->input('name'),
                    'code' => $request->input('code'),
                    'position_category_id' => $request->input('position_category_id'),
                ]);
                return response()->json(['status' => 'success', 'msg' => 'Update data jabatan berhasil.', 'redirect' => route('position.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage(), 'redirect' => route('position.index')], 200);
        }

        abort(404);
    }

    public function destroy($id) {
        $position = \App\Models\Position::find($id);
        try {
            if ($position) {
                $position->delete();
                return response()->json(['status' => 'success', 'msg' => 'Hapus data jabatan berhasil.', 'redirect' => route('position.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage(), 'redirect' => route('position.index')], 200);
        }
    }

}
