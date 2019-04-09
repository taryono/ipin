<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $purchase_orders = \App\Models\PurchaseOrder::all();
        return view('employee.purchase_order.list', compact('purchase_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $suppliers = \App\Models\Supplier::all();
        $goods = \App\Models\Goods::all(); 
        return view('employee.purchase_order.create', compact('suppliers', 'goods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $purchase_order = \App\Models\PurchaseOrder::create([
                    'code' => $request->input('code'),
                    'supplier_id' => $request->input('supplier_id'),
                    'request_receive_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('request_receive_date')))),
                    'user_id' => \Auth::user()->id,
                    'description' => $request->input('description'),
                    'status_id' => 6,
                    'approved_by' => $request->input('approved_by'),
                    'approval_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('approval_date')))),
                    'purchase_date'=> date('Y-m-d', strtotime(str_replace('/', '-', $request->input('purchase_date')))),
        ]);
        $total = 0;
        if ($purchase_order) {
            foreach ($request->input('goods_ids') as $goods_id) {
                if($request->input('request_amounts')[$goods_id] > 0){
                    $purchase_order_detail = \App\Models\PurchaseOrderDetail::create([
                                'purchase_order_id' => $purchase_order->id,
                                'goods_id' => $goods_id,
                                'amount' => $request->input('request_amounts')[$goods_id],
                                'price' => $request->input('prices')[$goods_id],
                                'subtotal' => ($request->input('request_amounts')[$goods_id] * $request->input('prices')[$goods_id]),                                
                    ]);
                    $total += $purchase_order_detail->subtotal;
                }
                
            }
            $purchase_order->total = $total;
            $purchase_order->save();
        }
        return response()->json(['status' => 'success', 'msg' => 'Tambah data pemesanan barang berhasil', 'redirect' => route('purchase_order.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $purchase_order = \App\Models\PurchaseOrder::find($id); 
        return view('employee.purchase_order.view', compact('purchase_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $purchase_order = \App\Models\PurchaseOrder::find($id);
        $purchase_order_details = $purchase_order->purchase_order_detail;
        $selected_goods = [];
        foreach($purchase_order_details as $purchase_order_detail){
            $selected_goods[] = $purchase_order_detail->goods_id;
        }
        $statutes = \App\Models\Status::where('type',3)->get();
        $goods = \App\Models\Goods::whereNotIn('id',$selected_goods)->get();
        return view('employee.purchase_order.edit', compact('purchase_order','selected_goods','goods','statutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $purchase_order = \App\Models\PurchaseOrder::find($id);
        if ($purchase_order) {
            $purchase_order->update([
                'code' => $request->input('code'),
                'supplier_id' => $request->input('supplier_id'),
                'purchase_date'=> date('Y-m-d', strtotime(str_replace('/', '-', $request->input('purchase_date')))),
                'request_receive_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('request_receive_date')))),
                'description' => $request->input('description'),
                'approved_by' => $request->input('approved_by'),
                'approval_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('approval_date')))),
                'status_id' => $request->input('status_id'),
            ]);

            if ($purchase_order) {
                $purchase_order_details = $purchase_order->purchase_order_detail; 
                foreach ($purchase_order_details as $purchase_order_detail) {
                    $purchase_order_detail->delete();
                }
            }
            $total = 0;
            if ($purchase_order) {
                foreach ($request->input('goods_ids') as $goods_id) {
                    if($request->input('request_amounts')[$goods_id] > 0){                        
                        if($request->has('received_amounts')){
                            if(array_key_exists($goods_id, $request->input('request_amounts'))){
                                $received_amount = $request->input('request_amounts')[$goods_id];
                            }
                        }
                        
                        if(!$request->has('received_amounts')){
                            if(array_key_exists($goods_id, $request->input('request_amounts'))){
                                $received_amount = $request->input('request_amounts')[$goods_id];
                            } 
                        }
                        
                        if($received_amount && $received_amount > 0  && (int)$request->input('status_id') == 8){
                             $goods = \App\Models\Goods::find($goods_id);
                             $goods->amount = $goods->amount+$received_amount;
                             $goods->save();
                             $subtotal = ($received_amount * $request->input('prices')[$goods_id]);
                        }else{
                            $subtotal = ($request->input('request_amounts')[$goods_id] * $request->input('prices')[$goods_id]);
                        }
                        $purchase_order_detail = \App\Models\PurchaseOrderDetail::create([
                                    'purchase_order_id' => $purchase_order->id,
                                    'goods_id' => $goods_id,
                                    'amount' => $request->input('request_amounts')[$goods_id],
                                    'price' => $request->input('prices')[$goods_id],
                                    'subtotal' => $subtotal,
                                    'received_amount' => $received_amount, 
                        ]);
                        $total += $purchase_order_detail->subtotal;
                    } 
                }
                $purchase_order->total = $total;
                $purchase_order->save();
            }
            return response()->json(['status' => 'success', 'msg' => 'Update data pemesanan barang berhasil', 'redirect' => route('purchase_order.index')], 200);
        }
    }

    public function list_by_supplier(Request $request) {
        $goods = \App\Models\Goods::where('supplier_id', $request->input('id'))->get();
        $supplier = \App\Models\Supplier::find($request->input('id'));
        return view('employee.purchase_order.list_by_supplier', compact('goods','supplier'));
    }

    public function getDetail(Request $request) {
        $purchase_details = \App\Models\PurchaseOrderDetail::where('purchase_order_id', $request->input('id'))->get();
        return view('employee.purchase_order.getDetail', compact('purchase_details'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $po = \App\Models\PurchaseOrder::find($id);
        if ($po) {
            $purchase_details = \App\Models\PurchaseOrderDetail::where('purchase_order_id', $po->id)->get();
            foreach ($purchase_details as $purchase_detail) {
                $purchase_detail->delete();
            }
            $po->delete();
        }
        return response()->json(['status' => 'success', 'msg' => 'Hapus data pemesanan barang berhasil', 'redirect' => route('purchase_order.index')], 200);
    }
    
    public function search(Request $request) {
        try {
            $sql = \App\Models\PurchaseOrder::select('purchase_orders.*');
            if ($request->has('code')) {
                $code = $request->input('code');
                $sql->where('purchase_orders.code', 'LIKE', '%' . $code . '%');
            }
            
            if ($request->has('status_id')) {
                $status_id = $request->input('status_id');
                $sql->where('purchase_orders.status_id',$status_id);
            }
 
            if ($request->has('name')) {
                $name = $request->input('name');
                $sql->whereHas('purchase_order_detail', function($q)use($name){
                    $q->whereHas('goods', function($q)use($name){
                        $q->where('name',$name);
                    });
                });
            }

            if ($request->has('purchase_date_from') && $request->has('purchase_date_to')) {
                $sql->whereBetween('purchase_orders.created_at', [$request->input('purchase_date_from'), $request->input('purchase_date_to')]);
            } else {
                if ($request->has('purchase_date_from')) {
                    $sql->where('purchase_orders.created_at', '>', $request->input('purchase_date_from'));
                }

                if ($request->has('purchase_date_to')) {
                    $sql->where('purchase_orders.created_at', '<', $request->input('purchase_date_to'));
                }
            }
            
            if ($request->has('receive_date_from') && $request->has('receive_date_to')) {
                $sql->whereBetween('purchase_orders.receive_date', [$request->input('receive_date_from'), $request->input('receive_date_to')]);
            } else {
                if ($request->has('purchase_date_from')) {
                    $sql->where('purchase_orders.receive_date', '>', $request->input('purchase_date_from'));
                }

                if ($request->has('purchase_date_to')) {
                    $sql->where('purchase_orders.receive_date', '<', $request->input('purchase_date_to'));
                }
            }
  
            if ($request->has('supplier')) {
                $sup = $request->input('supplier');
                $sql->leftJoin('suppliers', function($join) {
                    $join->on('purchase_orders.supplier_id', '=', 'suppliers.id');
                })->where('suppliers.name', 'LIKE', '%' . $sup . '%');
            }
            $params = $request->input();
            $purchase_orders = $sql->get();
            if ($request->has('print')) {
                $pdf = \PDF::loadView('employee.purchase_order.print_report', compact('purchase_orders','params'))->setPaper('a4', 'portrait');
                if (\App::environment('local')) {
                    return view('employee.purchase_order.print_report', compact('purchase_orders'));
                }

                return $pdf->download('Laporan pembelian barang.pdf');
            }

            return view('employee.purchase_order.list_search', compact('purchase_orders'));
        } catch (\Exception $e) {
            dump($e->getMessage(), $e->getLine());
        }
    }

}
