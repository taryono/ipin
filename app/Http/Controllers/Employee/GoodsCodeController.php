<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GoodsCodeController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $goods_codes = \App\Models\GoodsCode::all();
        return view('employee.goods_code.list', compact('goods_codes'));
    }

    public function create(Request $request) {
        $goods_types = \App\Models\GoodsType::all();
        return view('employee.goods_code.create', compact('goods_types'));
    }

    public function store(Request $request) {
        $goods_code = \App\Models\GoodsCode::create([
                    'name' => $request->input('name'),
                    'code' => $request->input('code'), 
                    'goods_type_id' => $request->input('goods_type_id'), 
        ]);
        if ($goods_code) {
           return response()->json(['status'=> 'success','msg'=> 'Input kode barang success','redirect'=> route('goods_code.index')]);
        }
        return response()->json(['status'=> 'fail','msg'=> 'Input kode barang gagal','redirect'=> route('goods_code.index')]);
    }

    public function edit($id) {
        $goods_code = \App\Models\GoodsCode::find($id); 
        $goods_types = \App\Models\GoodsType::all();
        if ($goods_code) {
            return view('employee.goods_code.edit', compact('goods_code','goods_types'));
        }
    }
    
    public function update(Request $request, $id)
    {	$goods_code = \App\Models\GoodsCode::find($id); 
        if($goods_code){
            $goods_code->update([
                'name'=>  $request->input('name'),
                'code'=> $request->input('code'),
                'goods_type_id' => $request->input('goods_type_id'), 
            ]); 
            return response()->json(['status'=> 'success','msg'=> 'Update kode barang berhasil','redirect'=> route('goods_code.index')],200);
        }else{
            return response()->json(['status'=> 'fail','msg'=> 'Kode Barang tidak ditemukan','redirect'=> route('goods_code.index')],400);
        } 
        
    }


    public function destroy($id) {
        $goods_code = \App\Models\GoodsCode::find($id);
        if ($goods_code) { 
            try{
                if($goods_code->delete()){
                    return response()->json(['status'=> 'success','msg'=> 'Hapus data kode barang berhasil','redirect'=> route('goods_code.index')], 200);
                } 
            }catch(\Exception $e){
                return response()->json(['status'=> 'success','msg'=> $e->getMessage(),'redirect'=> route('goods_code.index')],400);
            }
        } 
    }

}
