<?php
namespace App\Http\Controllers\Employee;

use App\Models\ShippingOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingOrderController extends Controller { 
    public function __construct() {
        //$this->middleware(['auth','menu']);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $shipping_orders = ShippingOrder::all();
        return view('employee.shipping_order.list', compact('shipping_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { 
        $customers = \App\Models\Customer::all();
        $goods = \App\Models\Goods::where('amount','>',0)->get(); 
        return view('employee.shipping_order.create', compact('goods', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $shipping_order = ShippingOrder::create([ 
                    'customer_id' => $request->input('customer_id'),
                    'request_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('request_date')))),
                    'send_date' => $request->input('send_date'),
                    'description' => $request->input('description'),
                    'work_order_id' => $request->input('work_order_id'),
                    'status_id' => 3,
        ]);
        if ($shipping_order) {
             
            $request_amounts = $request->input('request_amounts');
            if ($request->has('request_amounts')) {
                $total_price = 0;
                foreach ($request_amounts as $goods_id => $amount) {
                    $prices = $request->input('prices');
                    $price = $prices[$goods_id];
                    $total_price += ($amount * $price);
                    \App\Models\ShippingOrderDetail::create([
                        'shipping_order_id' => $shipping_order->id,
                        'goods_id' => $goods_id,
                        'amount' => $amount,
                        'price' => $price,
                        'subtotal' => ($amount * $price), 
                    ]);
                }
                $shipping_order->total = $total_price;
                $shipping_order->save();
            } 
        }

        return response()->json(['status' => 'success', 'msg' => 'Tambah data pengiriman berhasil', 'redirect' => route('shipping_order.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingOrder  $shipping_order
     * @return \Illuminate\Http\Response
     */
    public function show($id) { 
        $shipping_order = \App\Models\ShippingOrder::find(1);
        return view('employee.shipping_order.view', compact('shipping_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingOrder  $shipping_order
     * @return \Illuminate\Http\Response
     */
    public function edit($id) { 
        $shipping_order = \App\Models\ShippingOrder::find($id);
        $shipping_order_details = $shipping_order->shipping_order_detail;
        $selected_goods = [];
        foreach($shipping_order_details as $shipping_order_detail){
            $selected_goods[] = $shipping_order_detail->goods_id;
        }
        $statutes = \App\Models\Status::where('type',2)->get();
        $goods = \App\Models\Goods::whereNotIn('id',$selected_goods)->get(); 
        return view('employee.shipping_order.edit', compact('shipping_order','goods','statutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingOrder  $shipping_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) { 
        $shipping_order = \App\Models\ShippingOrder::find($id);
        if ($shipping_order) {
            $shipping_order->update([ 
                'user_id' => \Auth::user()->id,
                'request_date' => date('Y-m-d', strtotime($request->input('request_date'))),
                'description' => $request->input('description'),
                'work_order_id' => $request->input('work_order_id'),
                'send_date' => $request->input('send_date'),
                'status_id' => $request->input('status_id'),
            ]);
            if ($shipping_order) {
                $shipping_order_details = $shipping_order->shipping_order_detail;
                foreach($shipping_order_details as $shipping_order_detail){
                    $shipping_order_detail->delete();
                }
                $request_amounts = $request->input('request_amounts');
                if ($request->has('request_amounts')) {
                    $total_price = 0;
                    foreach ($request_amounts as $goods_id => $amount) {
                        $prices = $request->input('prices');
                        $price = $prices[$goods_id];
                        $total_price += ($amount * $price);
                        \App\Models\ShippingOrderDetail::create([
                            'shipping_order_id' => $shipping_order->id,
                            'goods_id' => $goods_id,
                            'amount' => $amount,
                            'price' => $price,
                            'subtotal' => ($amount * $price), 
                        ]);
                        
                        if((int)$request->input('status_id') == 5){
                            $goods = \App\Models\Goods::find($goods_id);
                            $goods->amount = $goods->amount - $amount;
                            $goods->save();
                        }
                    }
                    $shipping_order->total = $total_price;
                    $shipping_order->save();
                } 
            }
            return response()->json(['status' => 'success', 'msg' => 'Update data pengiriman berhasil', 'redirect' => route('shipping_order.index')], 200);
        }
    }

    public function by_supplier($supplier_id) {
        $shipping_order_details = NULL;
        if ($supplier_id) {
            $shipping_order_details = \App\Models\ShippingOrderDetail::whereHas('goods', function($q) use($supplier_id) {
                        $q->where('supplier_id', $supplier_id);
                    })->where('status_id', '<', 1)->get();
            $supplier = \App\Models\Supplier::find($supplier_id);
        }

        return view('employee.shipping_order.by_supplier', compact('shipping_order_details','supplier'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingOrder  $shipping_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $shipping_order = \App\Models\ShippingOrder::find($id);
        if ($shipping_order) {
            $shipping_order_details = \App\Models\ShippingOrderDetail::where('shipping_order_id', $shipping_order->id)->get();
            if ($shipping_order_details->count()) {
                foreach ($shipping_order_details as $shipping_order_detail) {
                    $shipping_order_detail->delete();
                }
            }
            $shipping_order->delete();
            return response()->json(['status' => 'success', 'msg' => 'Hapus data pengiriman berhasil', 'redirect' => route('shipping_order.index')], 200);
        }
        return response()->json(['status' => 'fail', 'msg' => 'Hapus data pengiriman gagal', 'redirect' => route('shipping_order.index')], 200);
    }

    public function list_goods() {
        $goodies = \App\Models\Goods::all();
        return view('employee.goods.list', compact('goodies'));
    }

    public function getDetail(Request $request) { 
        $shipping_order_details = \App\Models\ShippingOrderDetail::where('shipping_order_id', $request->input('id'))->get(); 
         
        return view('employee.shipping_order.getDetail', compact('shipping_order_details'));
    } 
    
    public function search(Request $request) {
        try {
            $sql = \App\Models\ShippingOrder::select('shipping_orders.*');
            if ($request->has('code')) {
                $code = $request->input('code');
                $sql->whereHas('wor_order',function($sql)use($code){
                    $sql->where('work_order.code', 'LIKE', '%' . $code . '%');
                });
                
            }
 
            if ($request->has('customer_name')) {
                $customer_name = $request->input('customer_name');
                $sql->whereHas('customer', function($q)use($customer_name){
                    $q->where('name','LIKE','%'.trim($customer_name).'%');
                });
            }

            if ($request->has('request_date_from') && $request->has('request_date_to')) {
                $sql->whereBetween('shipping_orders.request_date', [$request->input('request_date_from'), $request->input('request_date_to')]);
            } else {
                if ($request->has('request_date_from')) {
                    $sql->where('shipping_orders.request_date', '>=', $request->input('request_date'));
                }

                if ($request->has('request_date_to')) {
                    $sql->where('shipping_orders.request_date', '<=', $request->input('request_date_to'));
                }
            }
            
            if ($request->has('send_date_from') && $request->has('send_date_to')) {
                $sql->whereBetween('shipping_orders.send_date', [$request->input('send_date_from'), $request->input('send_date_to')]);
            } else {
                if ($request->has('send_date_from')) {
                    $sql->where('shipping_orders.send_date', '>=', $request->input('send_date_from'));
                }

                if ($request->has('send_date_to')) {
                    $sql->where('shipping_orders.send_date', '<=', $request->input('send_date_to'));
                }
            }
   
            $params = $request->input();
            $shipping_orders = $sql->get();
            if ($request->has('print')) {
                $pdf = \PDF::loadView('employee.shipping_order.print_report', compact('shipping_orders','params'))->setPaper('a4', 'landscape');
                if (\App::environment('local')) {
                    return view('employee.shipping_order.print_report', compact('shipping_orders'));
                }

                return $pdf->download('Laporan pembelian barang.pdf');
            }

            return view('employee.shipping_order.list_search', compact('shipping_orders'));
        } catch (\Exception $e) {
            dump($e->getMessage(), $e->getLine());
        }
    }

}
