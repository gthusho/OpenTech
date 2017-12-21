<?php

Route::resource('caja','CajaController');
Route::resource('cotizacion','CotizacionArticuloController');

Route::post('deleteItemsCotizacionArticulo/{id}',['as' => 's.deleteItemsCotizacionArticulo', 'uses' => 'DetalleCotAController@deleteItemsCotizacionArticulo']);
Route::post('confirmCotizacion/{id}',['as' => 's.confirmCotizacion', 'uses' => 'CotizacionArticuloController@confirmCotizacion']);

Route::resource('cot_producto','CotizacionProductoController');

Route::post('deleteItemsCotizacionProducto/{id}',['as' => 's.deleteItemsCotizacionProducto', 'uses' => 'DetalleCotizacionProductoController@deleteItemsCotizacionProducto']);
Route::post('confirmCotizacionProducto/{id}',['as' => 's.confirmCotizacionProducto', 'uses' => 'CotizacionProductoController@confirmCotizacionProducto']);

Route::resource('gasto','GastoController');

//Route::get('inventario/articulos',['as' => 'inventario.articulos', 'uses' => 'InventarioController@articulos']);

Route::resource('venta_art','VentaArticuloController');

Route::post('deleteItemsVentaArticulo/{id}',['as' => 's.deleteItemsVentaArticulo', 'uses' => 'DetalleVentaArticuloController@deleteItemsVentaArticulo']);
Route::post('confirmVentaArticulo/{id}',['as' => 's.confirmVentaArticulo', 'uses' => 'VentaArticuloController@confirmVenta']);

Route::resource('venta-credito-art','VentaCreditoArticuloController');
Route::resource('cajavistas','vistasCajaController');

Route::get('inventario/articulos',['as' => 's.inventario.articulos', 'uses' => 'InventarioController@articulos']);
Route::get('ingresos/articulos',['as' => 's.ingresos.articulos.index', 'uses' => 'IngresosController@index']);
Route::get('egresos/articulos',['as' => 's.egresos.articulos.index', 'uses' => 'DetalleVentaArticuloController@index']);

Route::resource('ventas/productos','VentasProductosController');
Route::post('confirmVentaProducto/{id}/{stado}',['as' => 's.confirmVentaProducto', 'uses' => 'VentasProductosController@confirmVenta']);
Route::delete('destroyItemCar/{id}',['as' => 's.destroyItemCar', 'uses' => 'VentasProductosController@destroyItemCar']);
Route::resource('ventas/creditos/productos','VentaProductoCreditoController');

Route::get('ingresos/productos',['as' => 's.ingresos.productos.index', 'uses' => 'IngresosProductosController@index']);
Route::get('egresos/productos',['as' => 's.egresos.productos.index', 'uses' => 'DetalleVentaProductoController@index']);
Route::get('inventario/productos',['as' => 's.inventario.productos', 'uses' => 'InventarioController@productos']);

Route::resource('medida','TomarMedidasController');
Route::resource('medida/detalle','DetalleMedidaController');