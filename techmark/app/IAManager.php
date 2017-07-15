<?php
/**
 * Created by PhpStorm.
 * User: Gthusho
 * Date: 29/6/2017
 * Time: 09:22
 */
namespace App;
/**
 * Class IAManager
 * @package App
 */
class IAManager
{
    private $existencia = null;
    private $sucursal_id = null;
    private $almacen_id  = null;
    private $articulo_id = null;

    function __construct($articulo_id,  $sucursal_id , $almacen_id)
    {
        $this->sucursal_id = $sucursal_id;
        $this->almacen_id = $almacen_id;
        $this->articulo_id = $articulo_id;

        $query = ExistenciaArticulo::where('sucursal_id',$this->sucursal_id)->where('almacen_id',$almacen_id)->where('articulo_id',$articulo_id)->get();
        if(Tool::existe($query)){
            $this->existencia = $query->first();
        }else{
            $newExistencia = new ExistenciaArticulo();
            $newExistencia->articulo_id =  $this->articulo_id;
            $newExistencia->sucursal_id = $this->sucursal_id;
            $newExistencia->almacen_id = $this->almacen_id;
            $newExistencia->save();
            $this->existencia = $newExistencia;
        }

    }

    public function down($qty){
         if($this->existencia != null){
             $this->existencia->cantidad -= $qty;
             $this->existencia->save();
         }
    }
    public function add($qty){
        if($this->existencia != null){
            $this->existencia->cantidad += $qty;
            $this->existencia->save();
        }
    }
    public  function UpdatePurchase($oldQty,$qty){
        if($this->existencia != null){
            $this->down($oldQty);
            $this->add($qty);
        }
    }
    public  function UpdateSale($oldQty,$qty){
        if($this->existencia != null){
            $this->add($oldQty);
            $this->down($qty);
        }
    }
}