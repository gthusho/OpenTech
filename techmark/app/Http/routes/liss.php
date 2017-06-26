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