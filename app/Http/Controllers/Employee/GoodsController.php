<?php

namespace App\Http\Controllers\Employee;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\File;

class GoodsController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'menu']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        if(Auth()->user()->isAdmin()){
            $goodies = \App\Models\Goods::get();
        }else{
            $goodies = \App\Models\Goods::where('department_id',Auth()->user()->user_detail->department_id)->get();
        } 
        return view('employee.goods.list', compact('goodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { 
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        $packages = \App\Models\Package::all();
        $goods_codes = \App\Models\GoodsCode::all();
        $types = \App\Models\Type::all();
        $departments = \App\Models\Department::all();
        return view('employee.goods.create', compact('categories', 'suppliers', 'packages', 'goods_codes','departments','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $goods = Goods::create([
                        'goods_code_id' => $request->input('goods_code_id'),
                        'name' => $request->input('name'),
                        'description' => $request->input('description'),
                        'supplier_id' => $request->input('supplier_id'),
                        'category_id' => $request->input('category_id'),
                        'package_id' => $request->input('package_id'),
                        'department_id' => $request->input('department_id'),
                        'type_id' => $request->input('type_id'),
                        'amount' => $request->input('amount'),
                        'min_amount' => $request->input('min_amount'),
                        'price' => $request->input('price'),
                        'request_limit' => $request->input('request_limit'),
            ]);
            $this->validate($request, [
                'name' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                // image upload in public/upload folder. 
                $storage = base_path('public/uploads');
                $directory = $storage . "/" . $goods->category->name;
                $path = File::createLocalDirectory($directory);
                $info = File::storeLocalFile($file, $path);
                $goods->image = 'uploads/' . $goods->category->name . '/' . $info->getFilename();
                $goods->save();
            } else {
                return response()->json(['status' => 'error', 'msg' => 'Gambar terlalu besar :'], 200);
            }

            return response()->json(['status' => 'success', 'msg' => 'Tambah Data Barang Berhasil', 'redirect' => route('goods.index')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Tambah Data Barang error:' . $e->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $goods = \App\Models\Goods::find($id);
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        $packages = \App\Models\Package::all();
        $goods_codes = \App\Models\GoodsCode::where('id', $goods->goods_code_id)->get();
        return view('employee.goods.view', compact('categories', 'suppliers', 'packages', 'goods', 'goods_codes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $goods = \App\Models\Goods::find($id);
        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();
        $packages = \App\Models\Package::all();
        $goods_codes = \App\Models\GoodsCode::all();
        $types = \App\Models\Type::all();
        $departments = \App\Models\Department::all();
        return view('employee.goods.edit', compact('categories', 'suppliers', 'packages', 'goods', 'goods_codes','departments','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {
            $goods = Goods::find($id);
            $goods->update([
                'goods_code_id' => $request->input('goods_code_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'supplier_id' => $request->input('supplier_id'),
                'category_id' => $request->input('category_id'),
                'package_id' => $request->input('package_id'),
                'department_id' => $request->input('department_id'),
                'type_id' => $request->input('type_id'),
                'amount' => $request->input('amount'),
                'min_amount' => $request->input('min_amount'),
                'price' => $request->input('price'),
                'request_limit' => $request->input('request_limit'),
            ]);
            if ($request->file('image')) {
                $this->validate($request, [
                    'name' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                //$file = $request->file('image');
                // image upload in public/upload folder.
                //$file->move('uploads', $file->getClientOriginalName()); 

                if ($request->file('image')->isValid()) {
                    $file = $request->file('image');
                    // image upload in public/upload folder.
                    $storage = base_path('public/uploads');
                    $directory = $storage . "/" . $goods->category->name;
                    $path = File::createLocalDirectory($directory);
                    $info = File::storeLocalFile($file, $path);
                    $goods->image = 'uploads/' . $goods->category->name . '/' . $info->getFilename();
                    $goods->save();
                } else {
                    return response()->json(['status' => 'error', 'msg' => 'Gambar terlalu besar :'], 200);
                }
            }
            return response()->json(['status' => 'success', 'msg' => 'Update Barang Sukses', 'redirect' => route('goods.index')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Update Data Barang error:' . $e->getMessage()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $goods = \App\Models\Goods::find($id);
        if ($goods) {
            return response()->json(['success' => $goods->delete(), 'msg' => 'Hapus data barang berhasil', 'redirect' => route('goods.index')], 200);
        }
        abort(404);
    }

    public function search(Request $request) {
        try {
            $sql = \App\Models\Goods::select('goods.*');
            if ($request->has('code')) {
                $code = $request->input('code');
                $sql->whereHas('goods_code', function($q) use($code) {
                    $q->where('code', 'LIKE', '%' . trim($code) . '%');
                });
            }

            if ($request->has('name')) {
                $sql->where('goods.name', 'LIKE', '%' . $request->input('name') . '%');
            }

            if ($request->has('amount')) {
                $sql->where('goods.amount', $request->input('operator'), $request->input('amount'));
            }

            if ($request->has('price')) {
                $sql->where('goods.price', $request->input('price'));
            }


            if ($request->has('from') && $request->has('to')) {
                $sql->whereBetween('goods.created_at', [$request->input('from'), $request->input('to')]);
            } else {
                if ($request->has('from')) {
                    $sql->where('goods.created_at', '>', $request->input('from'));
                }

                if ($request->has('to')) {
                    $sql->where('goods.created_at', '<', $request->input('from'));
                }
            }

            if ($request->has('description')) {
                $sql->where('goods.description', 'LIKE', '%' . $request->input('description') . '%');
            }

            if ($request->has('category')) {
                $cat = $request->input('category');
                $sql->leftJoin('categories', function($join) {
                    $join->on('goods.category_id', '=', 'categories.id');
                })->where('categories.name', 'LIKE', '%' . $cat . '%');
            }

            if ($request->has('supplier')) {
                $sup = $request->input('supplier');
                $sql->leftJoin('suppliers', function($join) {
                    $join->on('goods.supplier_id', '=', 'suppliers.id');
                })->where('suppliers.name', 'LIKE', '%' . $sup . '%');
            }
            $params = $request->input();
            
            if(Auth()->user()->isAdmin()){
                $goodies = $sql->get();
            }else{
                $goodies = $sql->where('department_id',Auth()->user()->user_detail->department_id)->get(); 
            }
            
            if ($request->has('print')) {
                $pdf = \PDF::loadView('employee.goods.print_report', compact('goodies','params'))->setPaper('a3', 'portrait');
                if (\App::environment('local')) {
                    return view('employee.goods.print_report', compact('goodies'));
                }

                return $pdf->download('Laporan persediaan barang.pdf');
            }

            return view('employee.goods.list_search', compact('goodies'));
        } catch (\Exception $e) {
            dump($e->getMessage(), $e->getLine());
        }
    }

}
