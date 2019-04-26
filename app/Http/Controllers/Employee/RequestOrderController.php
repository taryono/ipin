<?php

namespace App\Http\Controllers\Employee;

use App\Models\RequestOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestOrderController extends Controller {

    public function __construct() {
        //$this->middleware(['auth','menu']);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth()->user()->isAdmin()) {
            $request_orders = RequestOrder::all();
        } else {
            $request_orders = RequestOrder::where('to_department_id', Auth()->user()->user_detail->department_id)->get();
        }


        return view('employee.request_order.list', compact('request_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (Auth()->user()->isAdmin()) {
            $departments = \App\Models\Department::where('id', '<>', 1)->get();
        } else {
            $departments = \App\Models\Department::where('id', '<>', 1)->get();
            $department_from = \App\Models\Department::where('id', Auth()->user()->user_detail->department_id)->get();
        }

        $goods = \App\Models\Goods::all();
        return view('employee.request_order.create', compact('goods', 'departments', 'department_from'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request_order = RequestOrder::create([
                    'department_id' => $request->input('department_id'),
                    'to_department_id' => $request->input('to_department_id'),
                    'request_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('request_date')))),
                    'send_date' => $request->input('send_date'),
                    'request_by' => $request->input('request_by'),
                    'approved_by' => $request->input('approved_by'),
                    'approval_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('approval_date')))),
                    'description' => $request->input('description'),
                    'status_id' => 3,
        ]);
        if ($request_order) {

            $request_amounts = $request->input('request_amounts');
            if ($request->has('request_amounts')) {
                $total_price = 0;
                foreach ($request_amounts as $goods_id => $amount) {
                    $prices = $request->input('prices');
                    $price = $prices[$goods_id];
                    $total_price += ($amount * $price);
                    \App\Models\RequestOrderDetail::create([
                        'request_order_id' => $request_order->id,
                        'goods_id' => $goods_id,
                        'amount' => $amount,
                        'price' => $price,
                        'subtotal' => ($amount * $price),
                    ]);
                }
                $request_order->total = $total_price;
                $request_order->save();
            }
        }

        return response()->json(['status' => 'success', 'msg' => 'Tambah data permintaan berhasil', 'redirect' => route('request_order.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestOrder  $request_order
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $request_order = \App\Models\RequestOrder::find($id);
        $departments = \App\Models\Department::where('id', $request_order->department_id)->get();
        $work_orders = \App\Models\WorkOrder::where('status', 1)->get();
        $request_order_details = $request_order->request_order_detail;
        return view('employee.request_order.view', compact('request_order', 'request_order_details', 'work_orders', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestOrder  $request_order
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (Auth()->user()->isAdmin()) {
            $departments = \App\Models\Department::where('id', '<>', 1)->get();
        } else {
            $departments = \App\Models\Department::where('id', '<>', 1)->get();
            $department_from = \App\Models\Department::where('id', Auth()->user()->user_detail->department_id)->get();
        }
        $request_order = \App\Models\RequestOrder::find($id);
        $purchase_order_details = $request_order->request_order_detail;
        $selected_goods = [];
        foreach ($purchase_order_details as $purchase_order_detail) {
            $selected_goods[] = $purchase_order_detail->goods_id;
        }
        $statutes = \App\Models\Status::where('type', 2)->get();
        $goods = \App\Models\Goods::whereNotIn('id', $selected_goods)->get();
        return view('employee.request_order.edit', compact('request_order', 'goods', 'statutes', 'departments', 'department_from'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestOrder  $request_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request_order = \App\Models\RequestOrder::find($id);
        if ($request_order) {
            $request_order->update([
                'user_id' => \Auth::user()->id,
                'request_date' => date('Y-m-d', strtotime($request->input('request_date'))),
                'request_by' => $request->input('request_by'),
                'approved_by' => $request->input('approved_by'),
                'approval_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('approval_date')))),
                'description' => $request->input('description'),
                'send_date' => $request->input('send_date'),
                'status_id' => $request->input('status_id'),
                'department_id' => $request->input('department_id'),
                'to_department_id' => $request->input('to_department_id'),
            ]);
            if ($request_order) {
                $request_order_details = $request_order->request_order_detail;
                foreach ($request_order_details as $request_order_detail) {
                    $request_order_detail->delete();
                }
                $request_amounts = $request->input('request_amounts');
                if ($request->has('request_amounts')) {
                    $total_price = 0;
                    $suppliers = [];
                    foreach ($request_amounts as $goods_id => $amount) {
                        $prices = $request->input('prices');
                        $price = $prices[$goods_id];
                        $total_price += ($amount * $price);
                        $request_order_detail = \App\Models\RequestOrderDetail::create([
                                    'request_order_id' => $request_order->id,
                                    'goods_id' => $goods_id,
                                    'amount' => $amount,
                                    'price' => $price,
                                    'subtotal' => ($amount * $price),
                        ]);
                        $suppliers[] = $request_order_detail->goods->supplier_id;
                        if ((int) $request->input('status_id') == 5) {
                            $goods = \App\Models\Goods::find($goods_id);
                            $goods->amount = $goods->amount - $amount;
                            $goods->save();
                        }
                    }
                    $request_order->total = $total_price;
                    $request_order->save();

                    if ((int) $request->input('status_id') == 10) {
                        foreach ($suppliers as $supplier_id) {
                            $request_order_details = \App\Models\RequestOrderDetail::where('request_order_id', $request_order->id) -> whereHas('goods', function($q)use($supplier_id) {
                                        $q->where('supplier_id', $supplier_id);
                                    })->get();
                            if ($request_order_details->count() > 0) {
                                $purchase_order = \App\Models\PurchaseOrder::create([
                                            'code' => \App\Libraries\MailLib::generatePOCode(),
                                            'supplier_id' => $supplier_id,
                                            'user_id' => \Auth::user()->id,
                                            'status_id' => 6,
                                            'approved_by' => $request->input('approved_by'),
                                            'approval_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('approval_date')))),
                                            'request_receive_date' => $request->input('send_date'),
                                            'description' => $request->input('description'),
                                ]);
                                $total = 0;
                                if ($purchase_order) {
                                    foreach ($request_order_details as $request_order_detail) {
                                        $purchase_order_detail = \App\Models\PurchaseOrderDetail::create([
                                                    'purchase_order_id' => $purchase_order->id,
                                                    'goods_id' => $request_order_detail->goods_id,
                                                    'amount' => $request_order_detail->amount,
                                                    'price' => $request_order_detail->price,
                                                    'subtotal' => $request_order_detail->subtotal,
                                        ]);
                                        $total += $purchase_order_detail->subtotal;
                                    }
                                    $purchase_order->total = $total;
                                    $purchase_order->save();
                                }
                                return response()->json(['status' => 'success', 'msg' => 'Tambah data pemesanan barang berhasil', 'redirect' => route('purchase_order.index')], 200);
                            }
                        }
                    }
                }
            }
            return response()->json(['status' => 'success', 'msg' => 'Update data permintaan berhasil', 'redirect' => route('request_order.index')], 200);
        }
    }

    public function by_supplier($supplier_id) {
        $request_order_details = NULL;
        if ($supplier_id) {
            $request_order_details = \App\Models\RequestOrderDetail::whereHas('goods', function($q) use($supplier_id) {
                        $q->where('supplier_id', $supplier_id);
                    })->where('status_id', '<', 1)->get();
            $supplier = \App\Models\Supplier::find($supplier_id);
        }

        return view('employee.request_order.by_supplier', compact('request_order_details', 'supplier'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestOrder  $request_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $request_order = \App\Models\RequestOrder::find($id);
        if ($request_order) {
            $request_order_details = \App\Models\RequestOrderDetail::where('request_order_id', $request_order->id)->get();
            if ($request_order_details->count()) {
                foreach ($request_order_details as $request_order_detail) {
                    $request_order_detail->delete();
                }
            }
            $request_order->delete();
            return response()->json(['status' => 'success', 'msg' => 'Hapus data permintaan berhasil', 'redirect' => route('request_order.index')], 200);
        }
        return response()->json(['status' => 'fail', 'msg' => 'Hapus data permintaan gagal', 'redirect' => route('request_order.index')], 200);
    }

    public function list_goods() {
        $goodies = \App\Models\Goods::all();
        return view('employee.goods.list', compact('goodies'));
    }

    public function getDetail(Request $request) {
        $request_details = \App\Models\RequestOrderDetail::where('request_order_id', $request->input('id'))->get();
        return view('employee.request_order.getDetail', compact('request_details'));
    }

    public function search(Request $request) {

        $sql = \App\Models\RequestOrder::select('request_orders.*');
        if ($request->has('department')) {
            $department = $request->input('department');
            $sql->whereHas('department', function($q) use($department) {
                $q->where('name', 'LIKE', '%' . trim($department) . '%');
            });
        }

        if ($request->has('name')) {
            $name = $request->input('name');
            $sql->whereHas('request_order_detail', function($q) use($name) {
                $q->whereHas('goods', function($q) use($name) {
                    $q->where('name', 'LIKE', '%' . trim($name) . '%');
                });
            });
        }

        if ($request->has('request_date_from') && $request->has('request_date_to')) {
            $sql->whereBetween('created_at', [$request->input('request_date_from'), $request->input('request_date_to')]);
        }


        if ($request->has('description')) {
            $sql->where('description', 'LIKE', '%' . $request->input('description') . '%');
        }

        $request_orders = $sql->get();
        if ($request->has('print')) {
            $pdf = \PDF::loadView('employee.request_order.print_report', compact('request_orders'))->setPaper('a4', 'landscape');
            if (\App::environment('local')) {
                return view('employee.request_order.print_report', compact('request_orders'));
            }

            return $pdf->download('Laporan permintaan barang.pdf');
        }
        return view('employee.request_order.list_search', compact('request_orders'));
    }

}
