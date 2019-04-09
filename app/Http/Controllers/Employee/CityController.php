<?php

namespace App\Http\Controllers\Employee;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = \App\Models\City::orderBy('name')->paginate(20);
        return view('employee.city.list', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $regions = \App\Models\Region::orderBy('name')->get();
        return view('employee.city.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = \App\Models\City::create([
                    'name' => $request->input('name'), 
                    'region_id' => $request->input('region_id'), 
        ]);
        if ($city) {
            return response()->json(['status'=> 'success','msg'=> 'Tambah Kota Kabupaten berhasil','redirect'=> route('city.index')],200); 
        }
        return response()->json(['status'=> 'success','msg'=> 'Tambah Kota Kabupaten gagal','redirect'=> route('city.index')],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = \App\Models\City::find($id); 
        $regions = \App\Models\Region::orderBy('name')->get();
        return view('employee.city.edit', compact('city','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = \App\Models\City::find($id);
        $city->update([
                    'name' => $request->input('name'), 
                    'region_id' => $request->input('region_id'), 
        ]);
        if ($city) {
            return response()->json(['status'=> 'success','msg'=> 'Update Kota Kabupaten berhasil','redirect'=> route('city.index')],200); 
        }
        return response()->json(['status'=> 'success','msg'=> 'Update Kota Kabupaten gagal','redirect'=> route('city.index')],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
