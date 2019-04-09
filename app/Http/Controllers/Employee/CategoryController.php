<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends EmployeeController {

    private $redirectTo = 'category';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $categories = Category::all();
        return view('employee.category.list', compact('categories'));
    }

    public function create(Request $request) {
        return view('employee.category.create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function store(Request $request) {
        $data = $request->input();
        $category = Category::create([
                    'code' => $data['code'],
                    'name' => $data['name'],
        ]);
        return response()->json(['status'=> 'success','msg'=> 'Tambah Kategori berhasil','redirect'=> route('category.index')],200); 
    }

    public function show($id) {
        $category = Category::find($id);
        return view('employee.category.view', compact('category'));
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('employee.category.edit', compact('category'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(Request $request, $id) {
        $data = $request->input();
        $category = Category::find($id);
        if ($category) {
            $category->update([
                'code' => $data['code'],
                'name' => $data['name'], 
            ]);
        }
        return response()->json(['status'=> 'success','msg'=> 'Update Kategori berhasil','redirect'=> route('category.index')],200); 
    }

    public function destroy($id) {
        $category = Category::find($id);
        if ($category && $category->delete()) { 
            return response()->json(['status'=> 'success','msg'=> 'Hapus Kategori gagal','redirect'=> route('category.index')],200); 
        }
       return response()->json(['status'=> 'error','msg'=> 'Hapus Kategori gagal','redirect'=> route('category.index')],200); 
    }

}
