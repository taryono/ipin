<?php

namespace App\Http\Controllers\Employee;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = \App\Models\District::paginate(20);  
        $no = number($districts);
        return view('employee.district.list', compact('districts','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = \App\Models\City::orderBy('name')->get();
        return view('employee.district.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $district = \App\Models\District::create([
                    'name' => $request->input('name'), 
                    'city_id' => $request->input('city_id'), 
        ]);
        if ($district) { 
            return response()->json(['status'=> 'success','msg'=> 'Tambah data Kecamatan berhasil','redirect'=> route('district.index')]);
        }
        return response()->json(['status'=> 'faile','msg'=> 'Tambah data Kecamatan gagal','redirect'=> route('district.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = \App\Models\District::find($id); 
        $cities = \App\Models\City::orderBy('name')->get();
        return view('employee.district.edit', compact('cities','district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
