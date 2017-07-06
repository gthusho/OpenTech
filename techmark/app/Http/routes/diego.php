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
Route::post('confirmVentaArticulo/{id}',['as' => 'confirmVentaArticulo', 'uses' => 'VentaArticuloController@confirmVenta']);

//Route::get('service/getListArticulos',['as' => 'getListArticulos', 'uses' => 'ComprasController@getListArticulos']);


