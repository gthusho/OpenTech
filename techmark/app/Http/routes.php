<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::auth();

Route::get('/dashboard', 'HomeController@index');
Route::resource('perfil','PerfilController');

Route::group(['prefix'=>'admin','middleware'=>['auth'],'namespace'=>'Admin'], function(){
    /*
     * rutas usuarios
     */
    Route::resource('rol','RolController');
    Route::resource('usuario','UserController');

    /*
     * rutas agenda
     */
    Route::resource('agenda','AgendaController');

    /*
     * todo sucursal
     */
    Route::resource('sucursal','SucursalesController');
    Route::get('getAlmacenes',['as' => 'almacenes_disponibles', 'uses' => 'SucursalesController@getAlmacenes']);

    require __DIR__ . '/routes/diego.php';
    require __DIR__ . '/routes/liss.php';
});

Route::group(['prefix'=>'reportes','middleware'=>['auth'],'namespace'=>'Report'], function(){

    // todo usuarios
    Route::get('usuarios','UserReport@index');
    Route::get('usuarios/excel','UserReport@excel');

    require __DIR__ . '/routes/reportdiego.php';
    require __DIR__ . '/routes/reportliss.php';
});



Route::group(['prefix'=>'sucursal','middleware'=>['auth'],'namespace'=>'BranchOffice'], function(){

});
Route::group(['prefix'=>'produccion','middleware'=>['auth'],'namespace'=>'Production'], function(){

});
Route::group(['prefix'=>'ventas','middleware'=>['auth'],'namespace'=>'Sales'], function(){

});