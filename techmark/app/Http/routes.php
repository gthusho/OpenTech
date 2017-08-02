<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::auth();

Route::get('/dashboard', 'HomeController@index');
Route::resource('perfil','PerfilController');

Route::group(['prefix'=>'admin','middleware'=>['auth','is_admin','user_on'],'namespace'=>'Admin'], function(){
    /*
     * rutas usuarios
     */
    Route::resource('rol','RolController');
    Route::resource('usuario','UserController');

    /*
     * rutas agenda
     */
    Route::resource('agenda','AgendaController');

    /*
     * todo sucursal
     */
    Route::resource('sucursal','SucursalesController');
    Route::get('getAlmacenes',['as' => 'almacenes_disponibles', 'uses' => 'SucursalesController@getAlmacenes']);

    /*
     * todo compras
     */

    Route::resource('compra','ComprasController');
   // Route::get('addItemsCompra',['as' => 'addItemsCompra', 'uses' => 'ComprasController@addItemsCompra']);
    Route::post('deleteItemsCompra/{id}',['as' => 'deleteItemsCompra', 'uses' => 'IngresosController@deleteItemsCompra']);
    Route::post('confirmCompra/{id}',['as' => 'confirmCompra', 'uses' => 'ComprasController@confirmCompra']);

    Route::resource('compra-credito','ComprasCreditoController');

/*
 * todo ingresos egresos e inventario
 */
    Route::get('inventario/articulos',['as' => 'inventario.articulos', 'uses' => 'InventarioController@articulos']);
    Route::get('ingresos/articulos',['as' => 'ingresos.articulos.index', 'uses' => 'IngresosController@index']);
    Route::get('egresos/articulos',['as' => 'egresos.articulos.index', 'uses' => 'DetalleVentaArticuloController@index']);

    Route::get('ingresos/productos',['as' => 'ingresos.productos.index', 'uses' => 'IngresosProductosController@index']);
    Route::get('egresos/productos',['as' => 'egresos.productos.index', 'uses' => 'DetalleVentaArticuloController@index']);
    Route::get('inventario/productos',['as' => 'inventario.productos', 'uses' => 'InventarioController@productos']);

    require __DIR__ . '/routes/diego.php';
    require __DIR__ . '/routes/liss.php';

    /*
     * complementario a productos
     * Asignacion de tallas
     */
    Route::resource('producto/asignacion/talla','AsignacionTallaProducto');
    /*
     * Asignacion de permisos
     */

    Route::post('usuario/{id}/permiso',['as' => 'usuario.permiso', 'uses' => 'UserController@permiso']);
    /*
     * produccion ingresos
     */
    Route::resource('ingresar/productos','IngresosProductosController');
    Route::post('ingresar/productos/workProduccion/{id}/{action}',['as' => 'produccion.workProduccion', 'uses' => 'IngresosProductosController@workProduccion']);
    Route::post('ingresar/productos/changeStateP/{id}',['as' => 'produccion.changeStateP', 'uses' => 'IngresosProductosController@changeStateP']);
});

Route::group(['prefix'=>'reportes','middleware'=>['auth'],'namespace'=>'Report'], function(){

    // todo usuarios
    Route::get('usuarios','UserReport@index');
    Route::get('usuarios/excel','UserReport@excel');


    require __DIR__ . '/routes/reportdiego.php';
    require __DIR__ . '/routes/reportliss.php';

});



Route::group(['prefix'=>'sucursal','middleware'=>['auth'],'namespace'=>'BranchOffice'], function(){

});
Route::group(['prefix'=>'produccion','middleware'=>['auth'],'namespace'=>'Production'], function(){

});
Route::group(['prefix'=>'ventas','middleware'=>['auth'],'namespace'=>'Sales'], function(){

});

/*
 * servicios para articulos
 */
Route::get('service/getArticuloByCodigo',['as' => 'getArticuloByCodigo', 'uses' => 'ServiceArticulosController@getArticuloByCodigo']);
Route::get('service/getListArticulos',['as' => 'getListArticulos', 'uses' => 'ServiceArticulosController@getListArticulos']);
Route::get('service/showArticle',['as' => 'showArticle', 'uses' => 'ServiceArticulosController@showArticle']);
Route::get('service/showArticleByIngresoId/{id}',['as' => 'showArticleByIngresoId', 'uses' => 'ServiceArticulosController@showArticleByIngresoId']);

/*
 * servicios venta articulos
 */
Route::get('service/getArticuloForVenta',['as' => 'getArticuloForVenta', 'uses' => 'ServiceVentaArticulosController@getArticuloForVenta']);
Route::get('service/getClienteForVenta',['as' => 'getClienteForVenta', 'uses' => 'ServiceVentaArticulosController@getClienteForVenta']);
Route::get('service/showArticleByEgresoId/{id}',['as' => 'showArticleByEgresoId', 'uses' => 'ServiceVentaArticulosController@showArticleByEgresoId']);
Route::post('service/registrarCliente',['as' => 'registrarCliente', 'uses' => 'ServiceVentaArticulosController@registrarCliente']);

/*
 * servicios cotizacion productos
 */

Route::get('service/getListProductosBase',['as' => 'getListProductosBase', 'uses' => 'ServiceDetalleProductoBaseController@getListProductosBase']);
Route::get('service/showDetalleProducto',['as' => 'showDetalleProducto', 'uses' => 'ServiceDetalleProductoBaseController@showDetalleProducto']);
Route::get('service/productoById/{id}',['as' => 'productoById', 'uses' => 'ServiceDetalleProductoBaseController@productoById']);
/*
 * cotizacion
 */
Route::get('service/showArticleByCotizacionId/{id}',['as' => 'showArticleByCotizacionId', 'uses' => 'ServiceCotizacionArticulosController@showArticleByCotizacionId']);
/*
 * produccion
 */
Route::get('service/showArticleByProduccionId/{id}',['as' => 'showArticleByProduccionId', 'uses' => 'ServiceProduccionController@showArticleByProduccionId']);

/*
 * servicios ingresos productos producidos
 */
Route::get('service/productByCode',['as' => 'productByCode', 'uses' => 'ServiceProductosController@productByCode']);
Route::post('service/priceByIdProduct',['as' => 'priceByIdProduct', 'uses' => 'ServiceProductosController@priceByIdProduct']);
Route::get('service/productByRowId',['as' => 'productByRowId', 'uses' => 'ServiceProductosController@productByRowId']);
Route::get('service/getListProductos',['as' => 'getListProductos', 'uses' => 'ServiceProductosController@getListProductos']);
Route::get('service/showProductoSearch',['as' => 'showProductoSearch', 'uses' => 'ServiceProductosController@showProductoSearch']);
/*
 * rutas sucursal
 */
Route::group(['prefix'=>'s','middleware'=>['auth','user_on'],'namespace'=>'Sucursal'], function(){

    Route::resource('cliente','ClienteController');
    require __DIR__ . '/routes/sdiego.php';
   // require __DIR__ . '/routes/sliss.php';

});