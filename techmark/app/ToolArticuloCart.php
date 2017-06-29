<?php
/**
 * Created by PhpStorm.
 * User: Gthusho-PC
 * Date: 2/2/2017
 * Time: 22:02
 */

namespace App;


 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Config;

  class  ToolArticuloCart
{

   public static function getNombreById($id,$type){
       switch ($type){
           case 'material':{
               $query = Material::where('id',$id)->get();
                return self::genNombre($query);
           }
           case 'marca':{
               $query = Marca::where('id',$id)->get();
               return self::genNombre($query);
           }
           case 'categoria':{
               $query = CategoriaArticulo::where('id',$id)->get();
               return self::genNombre($query);
           }
           case 'unidad':{
               $query = Medida::where('id',$id)->get();
               return self::genNombre($query);
           }
           default: break;

       }

   }

     private static function genNombre($query)
     {
         if (Tool::existe( $query)) {
             $data =  $query->first();
             return $data->nombre;
         } else
             return "NO ENCONTRADO";

     }
 }