<?php

/*
 * aqui tus rutas para reportes
 */
Route::get('articulos','ArticuloReport@index');
Route::get('articulos/excel','ArticuloReport@excel');

Route::get('detprodbases','DetalleProductosBaseReport@index');
Route::get('detprodbases/excel','DetalleProductosBaseReport@excel');