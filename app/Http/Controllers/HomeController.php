<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Form;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $about = \App\Models\Company::first();
        view::share('about', $about);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return view('home');
    }

    public function delete_all(Request $request) {
        try {
            $class = $request->input('object');
            $instance = new $class;
            $models = $instance::whereIn('id', $request->input('ids'))->get();
            if ($models) {
                foreach ($models as $model) {
                    $model->delete();
                }
            }
            return response()->json(['status' => 'success', 'msg' => 'Hapus ' . camel_case($this->getSnaked($class)) . ' Berhasil', 'redirect' => route($this->getSnaked($class) . '.index')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'success', 'msg' => 'Hapus error:' . $e->getMessage(), 'redirect' => route($this->getSnaked($class) . '.index')], 200);
        }
    }

    public function select_area(Request $request) {
        $id = $request->input('id');
        $type = $request->input('type');
        if ($type == "city") {
            $name = "city_id";
            $type = "district";
            $objects = \App\Models\City::where('region_id', $id)->orderBy('name', 'asc')->get();
        } elseif ($type == "district") {
            $name = "district_id";
            $type = "subdistrict";
            $objects = \App\Models\District::where('city_id', $id)->orderBy('name', 'asc')->get();
        } else {
            $name = "subdistrict_id";
            $type = "finish";
            $objects = \App\Models\Subdistrict::where('district_id', $id)->orderBy('name', 'asc')->get();
        }

        return view('area', compact('name', 'objects', 'type'));
    }

    protected function setTitle($name) {
        $text = explode('\\', $name);
        $converted = explode('_', snake_case($text[count($text) - 1]));
        return $converted[0];
    }

    protected function getSnaked($name) {
        $text = explode('\\', $name);
        $converted = snake_case($text[count($text) - 1]);
        return $converted;
    }

    public function search(Request $request) {
        $class = $request->input('object');
        $key = $request->input('key');
        $template = $request->input('template');
        $instance = new $class;
        \DB::enableQueryLog();
        try {
            $table1 = $instance->getTable();
            $fields = $instance->getConnection()->getSchemaBuilder()->getColumnListing($instance->getTable());
            $relations = [];
            foreach ($fields as $field) {
                if (strpos($field, "_id")) {
                    $relations[] = str_replace("_id", "", $field);
                }
            }
            $query = $instance::with($relations)->where($table1 . '.' . $fields[1], 'LIKE', '%' . $key . '%');

            foreach ($fields as $field) {
                $query->orWhere($table1 . '.' . $field, 'LIKE', '%' . $key . '%');
            }

            foreach ($relations as $relation) {
                $query->leftJoin(str_plural($relation), function($join) use($table1, $relation) {
                    $join->on($table1 . '.' . $relation . '_id', '=', str_plural($relation) . '.id');
                });
                $model_name = (ucfirst(camel_case(strtolower($relation))));
                $path = "\\App\\Models\\" . $model_name;
                $inst = new $path;
                $table = $inst->getTable();
                $fs = $inst->getConnection()->getSchemaBuilder()->getColumnListing($inst->getTable());
                $query->orWhere($table . '.' . $fs[1], 'LIKE', '%' . $key . '%');

                foreach ($fs as $f) {
                    $query->orWhere($table . '.' . $f, 'LIKE', '%' . $key . '%');
                }

                $query->whereHas($relation, function($q) use($key, $relation) {
                    $model_name = (ucfirst(camel_case(strtolower($relation))));
                    $path = "\\App\\Models\\" . $model_name;
                    $inst = new $path;
                    $table = $inst->getTable();
                    $fields = $inst->getConnection()->getSchemaBuilder()->getColumnListing($inst->getTable());
                    $q = $inst::where($table . '.' . $fields[1], 'LIKE', '%' . $key . '%');

                    foreach ($fields as $field) {
                        $q->orWhere($table . '.' . $field, 'LIKE', '%' . $key . '%');
                    }
                });
            }

            $response = $query->get();
            return response()->json(['success' => true, 'response' => $template], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'response' => NULL], 400);
        }
    }

}
