<?php

Route::resource('categoria','CategoriaArticuloController');
Route::resource('marca','MarcaController');
Route::resource('material','MaterialController');
Route::resource('unidad','MedidaController');
Route::resource('articulo','ArticuloController');
Route::resource('talla','TallaController');
Route::resource('detprodbase','DetalleProductoBaseController');
Route::resource('prodbase','ProductoBaseController');
Route::resource('producto','ProductoController');
Route::resource('venta_art','VentaArticuloController');

Route::post('deleteItemsVentaArticulo/{id}',['as' => 'deleteItemsVentaArticulo', 'uses' => 'DetalleVentaArticuloController@deleteItemsVentaArticulo']);
Route::post('confirmVentaArticulo/{id}/{estado}',['as' => 'confirmVentaArticulo', 'uses' => 'VentaArticuloController@confirmVentaArticulo']);

Route::resource('cot_producto','CotizacionProductoController');

Route::post('deleteItemsCotizacionProducto/{id}',['as' => 'deleteItemsCotizacionProducto', 'uses' => 'DetalleCotizacionProductoController@deleteItemsCotizacionProducto']);
Route::post('confirmCotizacionProducto/{id}',['as' => 'confirmCotizacionProducto', 'uses' => 'CotizacionProductoController@confirmCotizacionProducto']);

Route::resource('venta-credito-art','VentaCreditoArticuloController');
Route::resource('caja','CajaController');
Route::resource('gasto','GastoController');

Route::post('archivoAgenda/{id}',['as'=>'archivoAgenda','uses'=>'AgendaController@archivoAgenda']);


