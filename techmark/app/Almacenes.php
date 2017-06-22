<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:40 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Almacenes extends Model
{
    protected $table = 'almacenes';
    protected $fillable = [
        'nombre', 'direccion', 'ciudad_id',
        'registro',
        'estado'
    ];

}