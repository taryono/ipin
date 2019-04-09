<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PositionCategoryController extends EmployeeController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $position_categories = \App\Models\PositionCategory::paginate(20);
        return view('employee.position_category.list', compact('position_categories'));
    }

    public function create(Request $request) { 
        $position_categories = \App\Models\PositionCategory::all(); 
        return view('employee.position_category.create', compact('position_categories'));
    }

    public function store(Request $request) {
        $position_category = \App\Models\PositionCategory::create([
                    'name' => $request->input('name'),
                    'code' => $request->input('code'),
        ]);
        if ($position_category) {
            return redirect()->to(route('position_category.index'));
        }
    }

    public function edit($id) {
        $position_category = \App\Models\PositionCategory::find($id);
        $position_categories = \App\Models\PositionCategory::all(); 
        if ($position_category) {
            return view('employee.position_category.edit', compact('position_category','position_categories'));
        }
    }
    
    public function update(Request $request, $id)
    {	$position_category = \App\Models\PositionCategory::find($id);
    
        if($position_category){
            $position_category->update([
                'name'=>  $request->input('name'),
                'code'=> $request->input('code'),  
            ]);
            
            return redirect()->route('position_category.index');
        }
         
        abort(404);
        
    }


    public function destroy($id) {
        $position_category = \App\Models\PositionCategory::find($id);
        if ($position_category) { 
            return response()->json(['success'=> $position_category->delete(),'redirect'=> 'position_category'], 200);
        }
        abort(404);
    }

}
