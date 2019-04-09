<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $customers = \App\Models\Customer::paginate(20); 
        return view('employee.customer.list', compact('customers'));
    }

    public function create(Request $request) {
        $countries = \App\Models\Country::where('id',100)->get();
        $regions = \App\Models\Region::orderBy('name', 'asc')->get();  
        $cities = \App\Models\City::where('region_id',1)->orderBy('name', 'asc')->get();  
        $districts = \App\Models\District::where('city_id',1492)->orderBy('name', 'asc')->get();  
        $subdistricts = \App\Models\Subdistrict::where('district_id',1672)->orderBy('name', 'asc')->get(); 
        return view('employee.customer.create', compact('countries','regions', 'cities','districts','subdistricts'));
    }

    public function store(Request $request) {
        $customer = \App\Models\Customer::create([ 
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
        if ($customer) { 
             return response()->json(['status'=> 'success','msg'=> 'Input data pelanggan berhasil','redirect'=> route('customer.index')]);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Input data pelanggan gagal','redirect'=> route('customer.index')]);
    }

    public function edit($id) {
        $customer = \App\Models\Customer::find($id);
        $countries = \App\Models\Country::where('id',100)->get();
        $regions = \App\Models\Region::orderBy('name', 'asc')->get();  
        $cities = \App\Models\City::where('region_id',$customer->region_id)->orderBy('name', 'asc')->get();  
        $districts = \App\Models\District::where('city_id',$customer->city_id)->orderBy('name', 'asc')->get();  
        $subdistricts = \App\Models\Subdistrict::where('district_id',$customer->district_id)->orderBy('name', 'asc')->get();  
        return view('employee.customer.edit', compact('countries','regions', 'cities','districts','subdistricts','customer'));
    }
    
    public function update(Request $request, $id)
    {	$customer = \App\Models\Customer::find($id);
    
        if($customer){
            $customer->update([ 
                'name'=>  $request->input('name'),
                'address'=> $request->input('address'),  
                'cellphone' => $request->input('cellphone'),
                'phone' => $request->input('phone'),
                'subdistrict_id' => $request->input('subdistrict_id'),
                'district_id' => $request->input('district_id'),
                'city_id' => $request->input('city_id'),
                'region_id' => $request->input('region_id'),
                'country_id' => $request->input('country_id'),
            ]);
            
            return response()->json(['status'=> 'success','msg'=> 'Update data pelanggan berhasil','redirect'=> route('customer.index')]);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Update data pelanggan gagal','redirect'=> route('customer.index')]);
        
    }


    public function destroy($id) {
        $customer = \App\Models\Customer::find($id);
        if ($customer && $customer->delete()) {  
            return response()->json(['status'=> 'success','msg'=> 'Hapus data pelanggan berhasil','redirect'=> route('city.index')],200); 
        }
        return response()->json(['status'=> 'fail','msg'=> 'Hapus pelanggan gagal','redirect'=> route('customer.index')],200); 
    }

}
