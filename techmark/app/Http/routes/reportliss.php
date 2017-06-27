<?php

/*
 * aqui tus rutas para reportes
 */
Route::get('clientes','ClienteReport@index');
Route::get('clientes/excel','ClienteReport@excel');

Route::get('proveedores','ProveedorReport@index');
Route::get('proveedores/excel','ProveedorReport@excel');

Route::get('trabajadores','TrabajadorReport@index');
Route::get('trabajadores/excel','TrabajadorReport@excel');

Route::get('almacenes','AlmacenReport@index');
Route::get('almacenes/excel','AlmacenReport@excel');