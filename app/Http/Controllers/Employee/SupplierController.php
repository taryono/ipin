<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $suppliers = \App\Models\Supplier::paginate(20);
        return view('employee.supplier.list', compact('suppliers'));
    }

    public function create(Request $request) {
        $countries = \App\Models\Country::where('id', 100)->get();
        $regions = \App\Models\Region::orderBy('name', 'asc')->get();
        $cities = \App\Models\City::where('region_id', 1)->orderBy('name', 'asc')->get();
        $districts = \App\Models\District::where('city_id', 1492)->orderBy('name', 'asc')->get();
        $subdistricts = \App\Models\Subdistrict::where('district_id', 1672)->orderBy('name', 'asc')->get();
        return view('employee.supplier.create', compact('countries', 'regions', 'cities', 'districts', 'subdistricts'));
    }

    public function store(Request $request) {
        try {
            $supplier = \App\Models\Supplier::create([
                        'code' => $request->input('code'),
                        'name' => $request->input('name'),
                        'address' => $request->input('address'),
                        'cellphone' => $request->input('cellphone'),
                        'phone' => $request->input('phone'),
                        'subdistrict_id' => $request->input('subdistrict_id'),
                        'district_id' => $request->input('district_id'),
                        'city_id' => $request->input('city_id'),
                        'region_id' => $request->input('region_id'),
                        'country_id' => $request->input('country_id'),
            ]);
            if ($supplier) {
                return response()->json(['status' => 'success', 'msg' => 'Hapus data supplier berhasil', 'redirect' => route('supplier.index')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'msg' => $e->getMessage(), 'redirect' => route('supplier.index')], 200);
        }
    }

    public function edit($id) {
        $supplier = \App\Models\Supplier::find($id);
        $countries = \App\Models\Country::where('id', 100)->get();
        $regions = \App\Models\Region::orderBy('name', 'asc')->get();
        $cities = \App\Models\City::where('region_id', $supplier->region_id)->orderBy('name', 'asc')->get();
        $districts = \App\Models\District::where('city_id', $supplier->city_id)->orderBy('name', 'asc')->get();
        $subdistricts = \App\Models\Subdistrict::where('district_id', $supplier->district_id)->orderBy('name', 'asc')->get();
        return view('employee.supplier.edit', compact('countries', 'regions', 'cities', 'districts', 'subdistricts', 'supplier'));
    }

    public function update(Request $request, $id) {
        $supplier = \App\Models\Supplier::find($id);

        if ($supplier) {
            $supplier->update([
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'cellphone' => $request->input('cellphone'),
                'phone' => $request->input('phone'),
                'subdistrict_id' => $request->input('subdistrict_id'),
                'district_id' => $request->input('district_id'),
                'city_id' => $request->input('city_id'),
                'region_id' => $request->input('region_id'),
                'country_id' => $request->input('country_id'),
            ]); 
            return response()->json(['status' => 'success', 'msg' => 'Update data supplier berhasil', 'redirect' => route('supplier.index')], 200);
        } 
        return response()->json(['status' => 'fail', 'msg' => 'Update data supplier gagal', 'redirect' => route('supplier.index')], 200);
    }

    public function destroy($id) {
        $supplier = \App\Models\Supplier::find($id);
        if ($supplier && $supplier->delete()) { 
            return response()->json(['status' => 'success', 'msg' => 'Hapus data supplier berhasil', 'redirect' => route('supplier.index')], 200);
        }
       return response()->json(['status' => 'fail', 'msg' => 'Hapus data supplier gagal', 'redirect' => route('supplier.index')], 200);
    }

}
