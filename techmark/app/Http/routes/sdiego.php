<?php

Route::resource('agenda','AgendaController');
Route::resource('caja','CajaController');
Route::resource('cotizacion','CotizacionArticuloController');

Route::post('confirmCotizacion/{id}',['as' => 'confirmCotizacion', 'uses' => 'CotizacionArticuloController@confirmCotizacion']);

Route::resource('cot_producto','CotizacionProductoController');

Route::post('deleteItemsCotizacionProducto/{id}',['as' => 'deleteItemsCotizacionProducto', 'uses' => 'DetalleCotizacionProductoController@deleteItemsCotizacionProducto']);
Route::post('confirmCotizacionProducto/{id}',['as' => 'confirmCotizacionProducto', 'uses' => 'CotizacionProductoController@confirmCotizacionProducto']);

Route::resource('gasto','GastoController');

//Route::get('inventario/articulos',['as' => 'inventario.articulos', 'uses' => 'InventarioController@articulos']);

Route::resource('venta_art','VentaArticuloController');

Route::post('deleteItemsVentaArticulo/{id}',['as' => 'deleteItemsVentaArticulo', 'uses' => 'DetalleVentaArticuloController@deleteItemsVentaArticulo']);
Route::post('confirmVentaArticulo/{id}',['as' => 'confirmVentaArticulo', 'uses' => 'VentaArticuloController@confirmVenta']);

Route::resource('venta-credito-art','VentaCreditoArticuloController');
Route::resource('cajavistas','vistasCajaController');

