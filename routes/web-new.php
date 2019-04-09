<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {  
    return view('auth.login');
})->name('login');

Auth::routes();
Route::get('welcome', '\HomeController@index')->name('welcome');
Route::get('logout', '\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\AdminController@index')->name('admin');
 
$menus = \App\Models\Menu::where('is_show',1)->get(); 
foreach ($menus as $m) {
    if(isset($m->controller)){
        if ($m->method == "get") {
            if($m->type == "destroy"){ 
                Route::delete($m->concat, $m->controller->name . $m->action)->name($m->route);
            }else{
                Route::get($m->concat, $m->controller->name . $m->action)->name($m->route);
            } 
        }else{
            if($m->type == "save"){
                Route::post($m->concat, $m->controller->name . $m->action)->name($m->route);
            }else{
                Route::put($m->concat, $m->controller->name . $m->action)->name($m->route);
            }  
        }
    }
}  

Route::get('profile/view_password/{user_id}', ['as'=> 'profile.view_password', 'uses'=> 'ProfileController@view_password']);
Route::post('profile/update_password/{user_id}', ['as'=> 'profile.update_password', 'uses'=> 'ProfileController@update_password']);
Route::post('home/delete_all', ['as'=> 'home.delete_all', 'uses'=> 'HomeController@delete_all']);
Route::get('/home/select_area', ['as'=> 'home.select_area', 'uses'=> 'HomeController@select_area']);
Route::get('/home/search', ['as'=> 'home.search', 'uses'=> 'HomeController@search']);
Route::get('/request_order/by_supplier/{id}', ['as'=> 'request_order.by_supplier', 'uses'=> 'Employee\RequestOrderController@by_supplier']);
Route::get('/request_order/getDetail/{id}', ['as'=> 'request_order.getDetail', 'uses'=> 'Employee\RequestOrderController@getDetail']);
Route::get('/purchase_order/getDetail/{id}', ['as'=> 'purchase_order.getDetail', 'uses'=> 'Employee\PurchaseOrderController@getDetail']);
Route::get('/purchase_order/list_by_supplier', ['as'=> 'purchase_order.list_by_supplier', 'uses'=> 'Employee\PurchaseOrderController@list_by_supplier']);
Route::get('/work_order/list_by_customer', ['as'=> 'work_order.list_by_customer', 'uses'=> 'Employee\WorkOrderController@list_by_customer']);
Route::post('goods/searching', ['as'=> 'goods.searching', 'uses'=> 'Employee\GoodsController@search']);

Route::get('acl', ['as' => 'acl.index', 'uses' => 'Admin\AclController@index']);
Route::get('acl/create', ['as' => 'acl.create', 'uses' => 'Admin\AclController@create']);
Route::post('acl', ['as' => 'acl.store', 'uses' => 'Admin\AclController@store']);
Route::get('acl/{acl}', ['as' => 'acl.show', 'uses' => 'Admin\AclController@show']);
Route::get('acl/{acl}/edit', ['as' => 'acl.edit', 'uses' => 'Admin\AclController@edit']);
Route::put('acl/{acl}', ['as' => 'acl.update', 'uses' => 'Admin\AclController@update']);
Route::patch('acl/{acl}', ['uses' => 'Admin\AclController@update']);
Route::delete('acl/{acl}', ['as' => 'acl.destroy', 'uses' => 'Admin\AclController@destroy']);


Route::get('category', ['as' => 'category.index', 'uses' => 'Employee\CategoryController@index']);
Route::get('category/create', ['as' => 'category.create', 'uses' => 'Employee\CategoryController@create']);
Route::post('category', ['as' => 'category.store', 'uses' => 'Employee\CategoryController@store']);
Route::get('category/{category}', ['as' => 'category.show', 'uses' => 'Employee\CategoryController@show']);
Route::get('category/{category}/edit', ['as' => 'category.edit', 'uses' => 'Employee\CategoryController@edit']);
Route::put('category/{category}', ['as' => 'category.update', 'uses' => 'Employee\CategoryController@update']);
Route::patch('category/{category}', ['uses' => 'Employee\CategoryController@update']);
Route::delete('category/{category}', ['as' => 'category.destroy', 'uses' => 'Employee\CategoryController@destroy']);

Route::get('city', ['as' => 'city.index', 'uses' => 'Employee\CityController@index']);
Route::get('city/create', ['as' => 'city.create', 'uses' => 'Employee\CityController@create']);
Route::post('city', ['as' => 'city.store', 'uses' => 'Employee\CityController@store']);
Route::get('city/{city}', ['as' => 'city.show', 'uses' => 'Employee\CityController@show']);
Route::get('city/{city}/edit', ['as' => 'city.edit', 'uses' => 'Employee\CityController@edit']);
Route::put('city/{city}', ['as' => 'city.update', 'uses' => 'Employee\CityController@update']);
Route::patch('city/{city}', ['uses' => 'Employee\CityController@update']);
Route::delete('city/{city}', ['as' => 'city.destroy', 'uses' => 'Employee\CityController@destroy']);

Route::get('controller', ['as' => 'controller.index', 'uses' => 'Admin\ControllerController@index']);
Route::get('controller/create', ['as' => 'controller.create', 'uses' => 'Admin\ControllerController@create']);
Route::post('controller', ['as' => 'controller.store', 'uses' => 'Admin\ControllerController@store']);
Route::get('controller/{controller}', ['as' => 'controller.show', 'uses' => 'Admin\ControllerController@show']);
Route::get('controller/{controller}/edit', ['as' => 'controller.edit', 'uses' => 'Admin\ControllerController@edit']);
Route::put('controller/{controller}', ['as' => 'controller.update', 'uses' => 'Admin\ControllerController@update']);
Route::patch('controller/{controller}', ['uses' => 'Admin\ControllerController@update']);
Route::delete('controller/{controller}', ['as' => 'controller.destroy', 'uses' => 'Admin\ControllerController@destroy']);

Route::get('customer', ['as' => 'customer.index', 'uses' => 'Employee\CustomerController@index']);
Route::get('customer/create', ['as' => 'customer.create', 'uses' => 'Employee\CustomerController@create']);
Route::post('customer', ['as' => 'customer.store', 'uses' => 'Employee\CustomerController@store']);
Route::get('customer/{customer}', ['as' => 'customer.show', 'uses' => 'Employee\CustomerController@show']);
Route::get('customer/{customer}/edit', ['as' => 'customer.edit', 'uses' => 'Employee\CustomerController@edit']);
Route::put('customer/{customer}', ['as' => 'customer.update', 'uses' => 'Employee\CustomerController@update']);
Route::patch('customer/{customer}', ['uses' => 'Employee\CustomerController@update']);
Route::delete('customer/{customer}', ['as' => 'customer.destroy', 'uses' => 'Employee\CustomerController@destroy']);

Route::get('district', ['as' => 'district.index', 'uses' => 'Employee\DistrictController@index']);
Route::get('district/create', ['as' => 'district.create', 'uses' => 'Employee\DistrictController@create']);
Route::post('district', ['as' => 'district.store', 'uses' => 'Employee\DistrictController@store']);
Route::get('district/{district}', ['as' => 'district.show', 'uses' => 'Employee\DistrictController@show']);
Route::get('district/{district}/edit', ['as' => 'district.edit', 'uses' => 'Employee\DistrictController@edit']);
Route::put('district/{district}', ['as' => 'district.update', 'uses' => 'Employee\DistrictController@update']);
Route::patch('district/{district}', ['uses' => 'Employee\DistrictController@update']);
Route::delete('district/{district}', ['as' => 'district.destroy', 'uses' => 'Employee\DistrictController@destroy']);

Route::get('employee', ['as' => 'employee.index', 'uses' => 'Admin\EmployeeController@index']);
Route::get('employee/create', ['as' => 'employee.create', 'uses' => 'Admin\EmployeeController@create']);
Route::post('employee', ['as' => 'employee.store', 'uses' => 'Admin\EmployeeController@store']);
Route::get('employee/{employee}', ['as' => 'employee.show', 'uses' => 'Admin\EmployeeController@show']);
Route::get('employee/{employee}/edit', ['as' => 'employee.edit', 'uses' => 'Admin\EmployeeController@edit']);
Route::put('employee/{employee}', ['as' => 'employee.update', 'uses' => 'Admin\EmployeeController@update']);
Route::patch('employee/{employee}', ['uses' => 'Admin\EmployeeController@update']);
Route::delete('employee/{employee}', ['as' => 'employee.destroy', 'uses' => 'Admin\EmployeeController@destroy']);

Route::get('goods', ['as' => 'goods.index', 'uses' => 'Employee\GoodsController@index']);
Route::get('goods/create', ['as' => 'goods.create', 'uses' => 'Employee\GoodsController@create']);
Route::post('goods', ['as' => 'goods.store', 'uses' => 'Employee\GoodsController@store']);
Route::get('goods/{goods}', ['as' => 'goods.show', 'uses' => 'Employee\GoodsController@show']);
Route::get('goods/{goods}/edit', ['as' => 'goods.edit', 'uses' => 'Employee\GoodsController@edit']);
Route::put('goods/{goods}', ['as' => 'goods.update.save', 'uses' => 'Employee\GoodsController@update']);
Route::patch('goods/{goods}', ['uses' => 'Employee\GoodsController@update']);
Route::delete('goods/{goods}', ['as' => 'goods.destroy', 'uses' => 'Employee\GoodsController@destroy']);

Route::get('goods_code', ['as' => 'goods_code.index', 'uses' => 'Employee\GoodsCodeController@index']);
Route::get('goods_code/create', ['as' => 'goods_code.create', 'uses' => 'Employee\GoodsCodeController@create']);
Route::post('goods_code', ['as' => 'goods_code.store', 'uses' => 'Employee\GoodsCodeController@store']);
Route::get('goods_code/{goods_code}', ['as' => 'goods_code.show', 'uses' => 'Employee\GoodsCodeController@show']);
Route::get('goods_code/{goods_code}/edit', ['as' => 'goods_code.edit', 'uses' => 'Employee\GoodsCodeController@edit']);
Route::put('goods_code/{goods_code}', ['as' => 'goods_code.update', 'uses' => 'Employee\GoodsCodeController@update']);
Route::patch('goods_code/{goods_code}', ['uses' => 'Employee\GoodsCodeController@update']);
Route::delete('goods_code/{goods_code}', ['as' => 'goods_code.destroy', 'uses' => 'Employee\GoodsCodeController@destroy']);

Route::get('goods_receive', ['as' => 'goods_receive.index', 'uses' => 'Employee\GoodsReceiveController@index']);
Route::get('goods_receive/create', ['as' => 'goods_receive.create', 'uses' => 'Employee\GoodsReceiveController@create']);
Route::post('goods_receive', ['as' => 'goods_receive.store', 'uses' => 'Employee\GoodsReceiveController@store']);
Route::get('goods_receive/{goods_receive}', ['as' => 'goods_receive.show', 'uses' => 'Employee\GoodsReceiveController@show']);
Route::get('goods_receive/{goods_receive}/edit', ['as' => 'goods_receive.edit', 'uses' => 'Employee\GoodsReceiveController@edit']);
Route::put('goods_receive/{goods_receive}', ['as' => 'goods_receive.update', 'uses' => 'Employee\GoodsReceiveController@update']);
Route::patch('goods_receive/{goods_receive}', ['uses' => 'Employee\GoodsReceiveController@update']);
Route::delete('goods_receive/{goods_receive}', ['as' => 'goods_receive.destroy', 'uses' => 'Employee\GoodsReceiveController@destroy']);

Route::get('goods_report', ['as' => 'goods_report.index', 'uses' => 'Employee\GoodsReportController@index']);
Route::get('goods_report/create', ['as' => 'goods_report.create', 'uses' => 'Employee\GoodsReportController@create']);
Route::post('goods_report', ['as' => 'goods_report.store', 'uses' => 'Employee\GoodsReportController@store']);
Route::get('goods_report/{goods_report}', ['as' => 'goods_report.show', 'uses' => 'Employee\GoodsReportController@show']);
Route::get('goods_report/{goods_report}/edit', ['as' => 'goods_report.edit', 'uses' => 'Employee\GoodsReportController@edit']);
Route::put('goods_report/{goods_report}', ['as' => 'goods_report.update', 'uses' => 'Employee\GoodsReportController@update']);
Route::patch('goods_report/{goods_report}', ['uses' => 'Employee\GoodsReportController@update']);
Route::delete('goods_report/{goods_report}', ['as' => 'goods_report.destroy', 'uses' => 'Employee\GoodsReportController@destroy']);

Route::get('group_menu', ['as' => 'group_menu.index', 'uses' => 'Admin\GroupMenuController@index']);
Route::get('group_menu/create', ['as' => 'group_menu.create', 'uses' => 'Admin\GroupMenuController@create']);
Route::post('group_menu', ['as' => 'group_menu.store', 'uses' => 'Admin\GroupMenuController@store']);
Route::get('group_menu/{group_menu}', ['as' => 'group_menu.show', 'uses' => 'Admin\GroupMenuController@show']);
Route::get('group_menu/{group_menu}/edit', ['as' => 'group_menu.edit', 'uses' => 'Admin\GroupMenuController@edit']);
Route::put('group_menu/{group_menu}', ['as' => 'group_menu.update', 'uses' => 'Admin\GroupMenuController@update']);
Route::patch('group_menu/{group_menu}', ['uses' => 'Admin\GroupMenuController@update']);
Route::delete('group_menu/{group_menu}', ['as' => 'group_menu.destroy', 'uses' => 'Admin\GroupMenuController@destroy']);

Route::get('menu', ['as' => 'menu.index', 'uses' => 'Admin\MenuController@index']);
Route::get('menu/create', ['as' => 'menu.create', 'uses' => 'Admin\MenuController@create']);
Route::post('menu', ['as' => 'menu.store', 'uses' => 'Admin\MenuController@store']);
Route::get('menu/{menu}', ['as' => 'menu.show', 'uses' => 'Admin\MenuController@show']);
Route::get('menu/{menu}/edit', ['as' => 'menu.edit', 'uses' => 'Admin\MenuController@edit']);
Route::put('menu/{menu}', ['as' => 'menu.update', 'uses' => 'Admin\MenuController@update']);
Route::patch('menu/{menu}', ['uses' => 'Admin\MenuController@update']);
Route::delete('menu/{menu}', ['as' => 'menu.destroy', 'uses' => 'Admin\MenuController@destroy']);

Route::get('package', ['as' => 'package.index', 'uses' => 'Employee\PackageController@index']);
Route::get('package/create', ['as' => 'package.create', 'uses' => 'Employee\PackageController@create']);
Route::post('package', ['as' => 'package.store', 'uses' => 'Employee\PackageController@store']);
Route::get('package/{package}', ['as' => 'package.show', 'uses' => 'Employee\PackageController@show']);
Route::get('package/{package}/edit', ['as' => 'package.edit', 'uses' => 'Employee\PackageController@edit']);
Route::put('package/{package}', ['as' => 'package.update', 'uses' => 'Employee\PackageController@update']);
Route::patch('package/{package}', ['uses' => 'Employee\PackageController@update']);
Route::delete('package/{package}', ['as' => 'package.destroy', 'uses' => 'Employee\PackageController@destroy']);

Route::get('position', ['as' => 'position.index', 'uses' => 'Employee\PositionController@index']);
Route::get('position/create', ['as' => 'position.create', 'uses' => 'Employee\PositionController@create']);
Route::post('position', ['as' => 'position.store', 'uses' => 'Employee\PositionController@store']);
Route::get('position/{position}', ['as' => 'position.show', 'uses' => 'Employee\PositionController@show']);
Route::get('position/{position}/edit', ['as' => 'position.edit', 'uses' => 'Employee\PositionController@edit']);
Route::put('position/{position}', ['as' => 'position.update', 'uses' => 'Employee\PositionController@update']);
Route::patch('position/{position}', ['uses' => 'Employee\PositionController@update']);
Route::delete('position/{position}', ['as' => 'position.destroy', 'uses' => 'Employee\PositionController@destroy']);

Route::get('position_category', ['as' => 'position_category.index', 'uses' => 'Employee\PositionCategoryController@index']);
Route::get('position_category/create', ['as' => 'position_category.create', 'uses' => 'Employee\PositionCategoryController@create']);
Route::post('position_category', ['as' => 'position_category.store', 'uses' => 'Employee\PositionCategoryController@store']);
Route::get('position_category/{position_category}', ['as' => 'position_category.show', 'uses' => 'Employee\PositionCategoryController@show']);
Route::get('position_category/{position_category}/edit', ['as' => 'position_category.edit', 'uses' => 'Employee\PositionCategoryController@edit']);
Route::put('position_category/{position_category}', ['as' => 'position_category.update', 'uses' => 'Employee\PositionCategoryController@update']);
Route::patch('position_category/{position_category}', ['uses' => 'Employee\PositionCategoryController@update']);
Route::delete('position_category/{position_category}', ['as' => 'position_category.destroy', 'uses' => 'Employee\PositionCategoryController@destroy']);

Route::get('profile', ['as' => 'profile.index', 'uses' => '\ProfileController@index']);
Route::get('profile/create', ['as' => 'profile.create', 'uses' => '\ProfileController@create']);
Route::post('profile', ['as' => 'profile.store', 'uses' => '\ProfileController@store']);
Route::get('profile/{profile}', ['as' => 'profile.show', 'uses' => '\ProfileController@show']);
Route::get('profile/{profile}/edit', ['as' => 'profile.edit', 'uses' => '\ProfileController@edit']);
Route::put('profile/{profile}', ['as' => 'profile.update', 'uses' => '\ProfileController@update']);
Route::patch('profile/{profile}', ['uses' => '\ProfileController@update']);
Route::delete('profile/{profile}', ['as' => 'profile.destroy', 'uses' => '\ProfileController@destroy']);

Route::get('purchase_order', ['as' => 'purchase_order.index', 'uses' => 'Employee\PurchaseOrderController@index']);
Route::get('purchase_order/create', ['as' => 'purchase_order.create', 'uses' => 'Employee\PurchaseOrderController@create']);
Route::post('purchase_order', ['as' => 'purchase_order.store', 'uses' => 'Employee\PurchaseOrderController@store']);
Route::get('purchase_order/{purchase_order}', ['as' => 'purchase_order.show', 'uses' => 'Employee\PurchaseOrderController@show']);
Route::get('purchase_order/{purchase_order}/edit', ['as' => 'purchase_order.edit', 'uses' => 'Employee\PurchaseOrderController@edit']);
Route::put('purchase_order/{purchase_order}', ['as' => 'purchase_order.update', 'uses' => 'Employee\PurchaseOrderController@update']);
Route::patch('purchase_order/{purchase_order}', ['uses' => 'Employee\PurchaseOrderController@update']);
Route::delete('purchase_order/{purchase_order}', ['as' => 'purchase_order.destroy', 'uses' => 'Employee\PurchaseOrderController@destroy']);

Route::get('region', ['as' => 'region.index', 'uses' => 'Employee\RegionController@index']);
Route::get('region/create', ['as' => 'region.create', 'uses' => 'Employee\RegionController@create']);
Route::post('region', ['as' => 'region.store', 'uses' => 'Employee\RegionController@store']);
Route::get('region/{region}', ['as' => 'region.show', 'uses' => 'Employee\RegionController@show']);
Route::get('region/{region}/edit', ['as' => 'region.edit', 'uses' => 'Employee\RegionController@edit']);
Route::put('region/{region}', ['as' => 'region.update', 'uses' => 'Employee\RegionController@update']);
Route::patch('region/{region}', ['uses' => 'Employee\RegionController@update']);
Route::delete('region/{region}', ['as' => 'region.destroy', 'uses' => 'Employee\RegionController@destroy']);

Route::get('religion', ['as' => 'religion.index', 'uses' => 'Employee\ReligionController@index']);
Route::get('religion/create', ['as' => 'religion.create', 'uses' => 'Employee\ReligionController@create']);
Route::post('religion', ['as' => 'religion.store', 'uses' => 'Employee\ReligionController@store']);
Route::get('religion/{religion}', ['as' => 'religion.show', 'uses' => 'Employee\ReligionController@show']);
Route::get('religion/{religion}/edit', ['as' => 'religion.edit', 'uses' => 'Employee\ReligionController@edit']);
Route::put('religion/{religion}', ['as' => 'religion.update', 'uses' => 'Employee\ReligionController@update']);
Route::patch('religion/{religion}', ['uses' => 'Employee\ReligionController@update']);
Route::delete('religion/{religion}', ['as' => 'religion.destroy', 'uses' => 'Employee\ReligionController@destroy']);

Route::get('request_order', ['as' => 'request_order.index', 'uses' => 'Employee\RequestOrderController@index']);
Route::get('request_order/create', ['as' => 'request_order.create', 'uses' => 'Employee\RequestOrderController@create']);
Route::post('request_order', ['as' => 'request_order.store', 'uses' => 'Employee\RequestOrderController@store']);
Route::get('request_order/{request_order}', ['as' => 'request_order.show', 'uses' => 'Employee\RequestOrderController@show']);
Route::get('request_order/{request_order}/edit', ['as' => 'request_order.edit', 'uses' => 'Employee\RequestOrderController@edit']);
Route::put('request_order/{request_order}', ['as' => 'request_order.update', 'uses' => 'Employee\RequestOrderController@update']);
Route::patch('request_order/{request_order}', ['uses' => 'Employee\RequestOrderController@update']);
Route::delete('request_order/{request_order}', ['as' => 'request_order.destroy', 'uses' => 'Employee\RequestOrderController@destroy']);

Route::get('role', ['as' => 'role.index', 'uses' => 'Admin\RoleController@index']);
Route::get('role/create', ['as' => 'role.create', 'uses' => 'Admin\RoleController@create']);
Route::post('role', ['as' => 'role.store', 'uses' => 'Admin\RoleController@store']);
Route::get('role/{role}', ['as' => 'role.show', 'uses' => 'Admin\RoleController@show']);
Route::get('role/{role}/edit', ['as' => 'role.edit', 'uses' => 'Admin\RoleController@edit']);
Route::put('role/{role}', ['as' => 'role.update', 'uses' => 'Admin\RoleController@update']);
Route::patch('role/{role}', ['uses' => 'Admin\RoleController@update']);
Route::delete('role/{role}', ['as' => 'role.destroy', 'uses' => 'Admin\RoleController@destroy']);

Route::get('status', ['as' => 'status.index', 'uses' => 'Employee\StatusController@index']);
Route::get('status/create', ['as' => 'status.create', 'uses' => 'Employee\StatusController@create']);
Route::post('status', ['as' => 'status.store', 'uses' => 'Employee\StatusController@store']);
Route::get('status/{status}', ['as' => 'status.show', 'uses' => 'Employee\StatusController@show']);
Route::get('status/{status}/edit', ['as' => 'status.edit', 'uses' => 'Employee\StatusController@edit']);
Route::put('status/{status}', ['as' => 'status.update', 'uses' => 'Employee\StatusController@update']);
Route::patch('status/{status}', ['uses' => 'Employee\StatusController@update']);
Route::delete('status/{status}', ['as' => 'status.destroy', 'uses' => 'Employee\StatusController@destroy']);

Route::get('subdistrict', ['as' => 'subdistrict.index', 'uses' => 'Employee\SubdistrictController@index']);
Route::get('subdistrict/create', ['as' => 'subdistrict.create', 'uses' => 'Employee\SubdistrictController@create']);
Route::post('subdistrict', ['as' => 'subdistrict.store', 'uses' => 'Employee\SubdistrictController@store']);
Route::get('subdistrict/{subdistrict}', ['as' => 'subdistrict.show', 'uses' => 'Employee\SubdistrictController@show']);
Route::get('subdistrict/{subdistrict}/edit', ['as' => 'subdistrict.edit', 'uses' => 'Employee\SubdistrictController@edit']);
Route::put('subdistrict/{subdistrict}', ['as' => 'subdistrict.update', 'uses' => 'Employee\SubdistrictController@update']);
Route::patch('subdistrict/{subdistrict}', ['uses' => 'Employee\SubdistrictController@update']);
Route::delete('subdistrict/{subdistrict}', ['as' => 'subdistrict.destroy', 'uses' => 'Employee\SubdistrictController@destroy']);

Route::get('supplier', ['as' => 'supplier.index', 'uses' => 'Employee\SupplierController@index']);
Route::get('supplier/create', ['as' => 'supplier.create', 'uses' => 'Employee\SupplierController@create']);
Route::post('supplier', ['as' => 'supplier.store', 'uses' => 'Employee\SupplierController@store']);
Route::get('supplier/{supplier}', ['as' => 'supplier.show', 'uses' => 'Employee\SupplierController@show']);
Route::get('supplier/{supplier}/edit', ['as' => 'supplier.edit', 'uses' => 'Employee\SupplierController@edit']);
Route::put('supplier/{supplier}', ['as' => 'supplier.update', 'uses' => 'Employee\SupplierController@update']);
Route::patch('supplier/{supplier}', ['uses' => 'Employee\SupplierController@update']);
Route::delete('supplier/{supplier}', ['as' => 'supplier.destroy', 'uses' => 'Employee\SupplierController@destroy']);

Route::get('user', ['as' => 'user.index', 'uses' => '\UserController@index']);
Route::get('user/create', ['as' => 'user.create', 'uses' => '\UserController@create']);
Route::post('user', ['as' => 'user.store', 'uses' => '\UserController@store']);
Route::get('user/{user}', ['as' => 'user.show', 'uses' => '\UserController@show']);
Route::get('user/{user}/edit', ['as' => 'user.edit', 'uses' => '\UserController@edit']);
Route::put('user/{user}', ['as' => 'user.update', 'uses' => '\UserController@update']);
Route::patch('user/{user}', ['uses' => '\UserController@update']);
Route::delete('user/{user}', ['as' => 'user.destroy', 'uses' => '\UserController@destroy']);

Route::get('work_order', ['as' => 'work_order.index', 'uses' => 'Employee\WorkOrderController@index']);
Route::get('work_order/create', ['as' => 'work_order.create', 'uses' => 'Employee\WorkOrderController@create']);
Route::post('work_order', ['as' => 'work_order.store', 'uses' => 'Employee\WorkOrderController@store']);
Route::get('work_order/{work_order}', ['as' => 'work_order.show', 'uses' => 'Employee\WorkOrderController@show']);
Route::get('work_order/{work_order}/edit', ['as' => 'work_order.edit', 'uses' => 'Employee\WorkOrderController@edit']);
Route::put('work_order/{work_order}', ['as' => 'work_order.update', 'uses' => 'Employee\WorkOrderController@update']);
Route::patch('work_order/{work_order}', ['uses' => 'Employee\WorkOrderController@update']);
Route::delete('work_order/{work_order}', ['as' => 'work_order.destroy', 'uses' => 'Employee\WorkOrderController@destroy']);