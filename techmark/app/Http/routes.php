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
Route::resource('perfil','HomeController');

Route::group(['prefix'=>'admin','middleware'=>['auth'],'namespace'=>'Admin'], function(){


    /* todo  referente a almacen */
    Route::resource('almacen','AlmacenController');
    Route::resource('articulo','ArticuloController');
    Route::resource('egreso','EgresoController');
    Route::resource('ingreso','IngresoController');
    Route::resource('familia','FamiliaController');
    Route::resource('marca','MarcaController');
    Route::resource('medida','MedidaController');
    Route::resource('stock','StockController');
    Route::resource('tipoarticulo','TipoArticuloController');

    /*
     * rutas usuarios
     */
    Route::resource('rol','RolController');
    Route::resource('usuario','UserController');


    /*
     * rutas ventas
     */
    Route::resource('cliente','ClienteController');
    Route::resource('visita','VisitaController');

    /*
     * rutas proveedores
     */

    Route::resource('proveedor','ProveedorController');


});
