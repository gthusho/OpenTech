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
     * rutas Cliente y Proveedor
     */
    Route::resource('cliente','ClienteController');
    Route::resource('proveedor','ProveedorController');
    /*
     * rutas Almacen y ciudades
     */
    Route::resource('almacen','AlmacenController');
    Route::resource('ciudad','CiudadController');
    /*
     * rutas agenda
     */
    Route::resource('agenda','AgendaController');


});
Route::group(['prefix'=>'sucursal','middleware'=>['auth'],'namespace'=>'BranchOffice'], function(){

});
Route::group(['prefix'=>'produccion','middleware'=>['auth'],'namespace'=>'Production'], function(){

});
Route::group(['prefix'=>'ventas','middleware'=>['auth'],'namespace'=>'Sales'], function(){

});