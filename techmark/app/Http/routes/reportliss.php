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

Route::get('ingresosa','IngresosReport@index');
Route::get('ingresosa/excel','IngresosReport@excel');

Route::get('egresosa','EgresosAReport@index');
Route::get('egresosa/excel','EgresosAReport@excel');

Route::get('compras/registradas','ComprasRegReport@index');
Route::get('compras/registradas/excel','ComprasRegReport@excel');

Route::get('compra','CompraReport@index');
Route::get('compra/excel','CompraReport@excel');

Route::get('compras/credito','ComprasCredReport@index');
Route::get('compras/credito/excel','ComprasCredReport@excel');

Route::get('pagos/compra','PagosCompReport@index');
Route::get('pagos/compra/excel','PagosCompReport@excel');

Route::get('ventas/registradas','VentasRegReport@index');
Route::get('ventas/registradas/excel','VentasRegReport@excel');

Route::get('venta','VentaReport@index');
Route::get('venta/excel','VentaReport@excel');

Route::get('cotizaciones/productos','CotizacionesProdReport@index');
Route::get('cotizaciones/productos/excel','CotizacionesProdReport@excel');

Route::get('cotizaciones/articulos','CotizacionesArtReport@index');
Route::get('cotizaciones/articulos/excel','CotizacionesArtReport@excel');

Route::get('cotizacion/producto','CotizacionPReport@index');
Route::get('cotizacion/producto/excel','CotizacionPReport@excel');

Route::get('cotizacion/articulo','CotizacionAReport@index');
Route::get('cotizacion/articulo/excel','CotizacionAReport@excel');

Route::get('gastos','GastosReport@index');
Route::get('gastos/excel','GastosReport@excel');

Route::get('cajas','CajasReport@index');
Route::get('cajas/excel','CajasReport@excel');

Route::get('caja/general','CajaGeneralReport@index');

Route::get('caja/detalle','CajaDetalleReport@index');

Route::get('pagos/venta','PagosVentaReport@index');

Route::get('producciones','ProduccionesReport@index');
Route::get('producciones/excel','ProduccionesReport@excel');

Route::get('produccion','ProduccionReport@index');

Route::get('inventario/articulo','InventarioAReport@index');
Route::get('inventario/articulo/excel','InventarioAReport@excel');

Route::get('productos','ProductosReport@index');
Route::get('productos/excel','ProductosReport@excel');

