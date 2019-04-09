<?php

namespace App\Http\Controllers\Employee;

use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubdistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $subdistricts = \App\Models\Subdistrict::orderBy('name','asc')->paginate(20);
        $no = number($subdistricts);
        return view('employee.subdistrict.list', compact('subdistricts','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = \App\Models\District::orderBy('name','asc')->get();
        return view('employee.subdistrict.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subdistrict = \App\Models\Subdistrict::create([
                    'name' => $request->input('name'), 
                    'district_id' => $request->input('district_id'), 
        ]);
        if ($district) {
            return response()->json(['status'=> 'success','msg'=> 'Tambah data kelurahan berhasil','redirect'=> route('subdistrict.index')],200);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Tambah data kelurahan gagal','redirect'=> route('subdistrict.index')],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function show(Subdistrict $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subdistrict = \App\Models\Subdistrict::find($id);  
        $districts = \App\Models\District::orderBy('name')->get(); 
        return view('employee.subdistrict.edit', compact('subdistrict','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subdistrict $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subdistrict $district)
    {
        //
    }
}
