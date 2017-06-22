<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App\Console;


use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
        'razon_social', 'nit', 'telefono',
        'celular','email','fax','direccion','registro'
    ];

}