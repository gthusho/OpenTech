<?php
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