<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReligionController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $religions = \App\Models\Religion::paginate(10); 
        return view('employee.religion.list', compact('religions'));
    }

    public function create(Request $request) {
        return view('employee.religion.create');
    }

    public function store(Request $request) {
        $religion = \App\Models\Religion::create([
                    'name' => $request->input('name'), 
        ]);
        if ($religion) { 
            return response()->json(['status'=> 'success','msg'=> 'Tambah data Agama berhasil','redirect'=> route('religion.index')]);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Tambah data Agama gagal','redirect'=> route('religion.index')]);
    }

    public function edit($id) {
        $religion = \App\Models\Religion::find($id);
        if ($religion) {
            return view('employee.religion.edit', compact('religion'));
        }
    }
    
    public function update(Request $request, $id)
    {	$religion = \App\Models\Religion::find($id); 
        if($religion){
            $religion->update([
                'name'=>  $request->input('name'),
            ]); 
            return response()->json(['status'=> 'fail','msg'=> 'Update data Agama berhasil','redirect'=> route('religion.index')]);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Update data Agama gagal','redirect'=> route('religion.index')]);        
    }


    public function destroy($id) {
        $religion = \App\Models\Religion::find($id);
        if ($religion && $religion->delete()) {  
            return response()->json(['status'=> 'fail','msg'=> 'Hapus data Agama berhasil','redirect'=> route('religion.index')],200);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Hapus data Agama gagal','redirect'=> route('religion.index')],200);
    }

}
