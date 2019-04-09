<?php

namespace App\Http\Controllers\Employee;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkOrderController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $work_orders = WorkOrder::all();
       return view('employee.work_order.list', compact('work_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    $customers = \App\Models\Customer::all();
         return view('employee.work_order.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        try{
        $work_order = WorkOrder::create([
                    'code' => $request->input('code'), 
                    'description' => trim($request->input('description')),
                    'date' => $request->input('date'),
                    'customer_id' => $request->input('customer_id'),
                    'request_by' => $request->input('request_by'),
                    'target_date' => $request->input('target_date'),
                    'is_used' =>0,
                    'status' => $request->input('status'),
                    'user_id' =>Auth()->user()->id,
        ]);
        return response()->json(['status'=> 'success','msg'=> 'Tambah data work order berhasil','redirect'=> route('work_order.index')]);
        }catch(\Exception $e){
            return response()->json(['status'=> 'success','msg'=> 'Input data work order gagal '.$e->getMessage(),'redirect'=> route('work_order.index')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $work_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $work_order = \App\Models\WorkOrder::find($id);
        $customers = \App\Models\Customer::all();
        return view('employee.work_order.edit', compact('work_order','customers'));
    }
    
    public function list_by_customer(Request $request)
    {   $work_orders = \App\Models\WorkOrder::where('customer_id',$request->input('id'))->where('is_used',0)->get(); 
        return view('employee.work_order.list_by_customer', compact('work_orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $work_order = \App\Models\WorkOrder::find($id);
        if($work_order){
            try{
            $work_order->update([
                'code' => $request->input('code'), 
                'description' => trim($request->input('description')),
                'date' => $request->input('date'),
                'customer_id' => $request->input('customer_id'),
                'request_by' => $request->input('request_by'),
                'target_date' => $request->input('target_date'),
                'is_used' =>0,
                'status' => $request->input('status'),
                'user_id' =>Auth()->user()->id,
            ]);
            
            if($work_order){
                return response()->json(['status'=> 'success','msg'=> 'Update data work order berhasil','redirect'=> route('work_order.index')]);
            }
            }catch(\Exception $e){
                return response()->json(['status' => 'fail', 'msg' => 'Update data work order gagal ' . $e->getMessage(), 'redirect' => route('work_order.index')]);
            } 
        }else{
            return response()->json(['status'=> 'info','msg'=> 'Data work order tidak ditemukan ','redirect'=> route('work_order.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work_order = \App\Models\WorkOrder::find($id);
        if ($work_order) { 
            try{
                if($work_order->delete()){
                    return response()->json(['status'=> 'success','msg'=> 'Hapus data work order berhasil','redirect'=> route('work_order.index')], 200);
                } 
            }catch(\Exception $e){
                return response()->json(['status'=> 'success','msg'=> $e->getMessage(),'redirect'=> route('work_order.index')],400);
            }
        }
    }
}
