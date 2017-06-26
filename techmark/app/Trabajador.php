<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $fillable = [
        'nombre', 'direccion', 'telefono',
        'email','fecha_ingreso','cargo','foto','ci','estado','referencia','tel_referencia',
        'sueldo','usuario_id','sucursal_id'
    ];


}