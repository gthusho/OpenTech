<?php
/*
    * rutas Cliente y Proveedor
    */
Route::resource('cliente','ClienteController');
Route::resource('proveedor','ProveedorController');
Route::resource('trabajador','TrabajadorController');

/*
 * rutas Almacen y ciudades
 */
Route::resource('almacen','AlmacenController');
Route::resource('ciudad','CiudadController');

/*
     * todo cotizaciones articulos
     */

Route::resource('cotizacion','CotizacionArticuloController');
Route::post('deleteItemsCompra/{id}',['as' => 'deleteItemsCompra', 'uses' => 'IngresosController@deleteItemsCompra']);
Route::post('confirmCotizacion/{id}',['as' => 'confirmCotizacion', 'uses' => 'CotizacionArticuloController@confirmCotizacion']);
Route::get('service/getArticuloByCodigo',['as' => 'getArticuloByCodigo', 'uses' => 'ComprasController@getArticuloByCodigo']);
Route::get('service/getListArticulos',['as' => 'getListArticulos', 'uses' => 'ComprasController@getListArticulos']);
Route::get('service/showArticle',['as' => 'showArticle', 'uses' => 'ArticuloController@showArticle']);

Route::resource('cajavistas','vistasCajaController');

Route::get('informe/ingresos',['as' => 'informe.ingresos', 'uses' => 'vistasCajaController@ingresos']);