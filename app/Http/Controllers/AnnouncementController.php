<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $announcements = \App\Models\Announcement::paginate(20);
        return view('employee.announcement.list', compact('announcements'));
    }

    public function create(Request $request) {
        $departments = \App\Models\Department::all(); 
        return view('employee.announcement.create', compact('departments'));
    }

    public function store(Request $request) {
        try {
            $announcement = \App\Models\Announcement::create($request->input());
            if ($announcement) {
                return response()->json(['status' => 'success', 'msg' => 'Hapus data pengumuman berhasil', 'redirect' => route('announcement.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'msg' => $e->getMessage(), 'redirect' => route('announcement.index')], 200);
        }
    }

    public function edit($id) {
        $announcement = \App\Models\Announcement::find($id);
        $departments = \App\Models\Department::all(); 
        return view('employee.announcement.edit', compact('departments',  'announcement'));
    }

    public function update(Request $request, $id) {
        $announcement = \App\Models\Announcement::find($id);

        if ($announcement) {
            $announcement->update($request->input()); 
            return response()->json(['status' => 'success', 'msg' => 'Update data pengumuman berhasil', 'redirect' => route('announcement.index')], 200);
        } 
        return response()->json(['status' => 'fail', 'msg' => 'Update data pengumuman gagal', 'redirect' => route('announcement.index')], 200);
    }

    public function destroy($id) {
        $announcement = \App\Models\Announcement::find($id);
        if ($announcement && $announcement->delete()) { 
            return response()->json(['status' => 'success', 'msg' => 'Hapus data pengumuman berhasil', 'redirect' => route('announcement.index')], 200);
        }
       return response()->json(['status' => 'fail', 'msg' => 'Hapus data pengumuman gagal', 'redirect' => route('announcement.index')], 200);
    }
}
