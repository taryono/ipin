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
    return redirect()->to('/login');
});

Auth::routes();
Route::get('welcome', '\App\Http\Controllers\HomeController@index')->name('welcome');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\AdminController@index')->name('admin');
//php artisan make:controller PhotoController --resource --model=Photo
/*
 * Actions Handled By Resource Controller
  Verb	URI                     Action      Route Name
  GET	/photos                 index       photos.index
  GET	/photos/create          create      photos.create
  POST	/photos                 store       photos.store
  GET	/photos/{photo}         show        photos.show
  GET	/photos/{photo}/edit	edit        photos.edit
  PUT/PATCH	/photos/{photo}	update      photos.update
  DELETE	/photos/{photo}         destroy     photos.destroy
 */
/*
 * Ini untuk generate menu tambahan selain crud yang diijinkan
 */
$menus = \App\Models\Menu::where('is_show', 1)->get();
foreach ($menus as $m) {
    if (isset($m->controller)) {
        if ($m->method == "get") {
            if ($m->type == "destroy") {
                Route::delete($m->concat, $m->controller->name . $m->action)->name($m->route);
            } else {
                Route::get($m->concat, $m->controller->name . $m->action)->name($m->route);
            }
        } else {
            if ($m->type == "save") {
                Route::post($m->concat, $m->controller->name . $m->action)->name($m->route);
            } else {
                Route::put($m->concat, $m->controller->name . $m->action)->name($m->route);
            }
        }
    }
}
Route::group(['middleware' => ['auth']], function() {
    Route::get('profile/view_password/{user_id}', ['as' => 'profile.view_password', 'uses' => 'ProfileController@view_password']);
    Route::post('profile/update_password/{user_id}', ['as' => 'profile.update_password', 'uses' => 'ProfileController@update_password']);
    Route::post('home/delete_all', ['as' => 'home.delete_all', 'uses' => 'HomeController@delete_all']);
    Route::get('/home/select_area', ['as' => 'home.select_area', 'uses' => 'HomeController@select_area']);
    Route::get('/home/search', ['as' => 'home.search', 'uses' => 'HomeController@search']);
    Route::get('/request_order/by_supplier/{id}', ['as' => 'request_order.by_supplier', 'uses' => 'Employee\RequestOrderController@by_supplier']);
    Route::get('/shipping_order/getDetail', ['as' => 'shipping_order.getDetail', 'uses' => 'Employee\ShippingOrderController@getDetail']);
    Route::get('/request_order/getDetail/{id}', ['as' => 'request_order.getDetail', 'uses' => 'Employee\RequestOrderController@getDetail']);
    Route::get('/purchase_order/getDetail/{id}', ['as' => 'purchase_order.getDetail', 'uses' => 'Employee\PurchaseOrderController@getDetail']);
    Route::get('/purchase_order/list_by_supplier', ['as' => 'purchase_order.list_by_supplier', 'uses' => 'Employee\PurchaseOrderController@list_by_supplier']);
    Route::get('/work_order/list_by_customer', ['as' => 'work_order.list_by_customer', 'uses' => 'Employee\WorkOrderController@list_by_customer']);
    Route::post('/goods/searching', ['as' => 'goods.searching', 'uses' => 'Employee\GoodsController@search']);
    Route::post('/request_order/searching', ['as' => 'request_order.searching', 'uses' => 'Employee\RequestOrderController@search']);
    Route::post('/purchase_order/searching', ['as' => 'purchase_order.searching', 'uses' => 'Employee\PurchaseOrderController@search']);
    Route::post('/shipping/searching', ['as' => 'shipping.searching', 'uses' => 'Employee\ShippingOrderController@search']);

    $controllers = \App\Models\Controller::all();
    foreach ($controllers as $controller) {
        //Route::resource($controller->title, $controller->name); 
        //Backend post resource
        $title = $controller->title;
        $name = $controller->name;
        // Frontend post resource
        /*
          Route::resource('user', 'UserController', [
          'names' => [
          'create' => 'user.buat',
          'store' => 'user.simpan'
          ]
          ]);
          Route::resource('users', 'UsersController', [
          'only' => ['index', 'show']
          ]);

          Route::resource('monkeys', 'MonkeysController', [
          'except' => ['edit', 'create']
          ]);
         * 
         */
        Route::resource($title, $name);
    }
});

