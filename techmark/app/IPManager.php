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
class IPManager
{
    private $existencia = null;
    private $sucursal_id = null;
    private $almacen_id  = null;
    private $producto_id = null;
    private $talla_id = null;

    function __construct($producto_id, $talla_id, $sucursal_id )
    {
        $this->sucursal_id = $sucursal_id;
        $this->producto_id = $producto_id;
        $su = Sucursal::find($this->sucursal_id);
        $this->almacen_id = $su->almacen->id;
        $query = ExistenciaProducto::where('sucursal_id',$this->sucursal_id)
            ->where('almacen_id',$this->almacen_id)
            ->where('producto_id',$this->producto_id)
            ->where('talla_id',$this->talla_id)
            ->get();
        if(count($query)>0){
            $this->existencia = $query->first();
        }else{
            $newExistencia = new ExistenciaProducto();
            $newExistencia->producto_id =  $this->producto_id;
            $newExistencia->sucursal_id = $this->sucursal_id;
            $newExistencia->almacen_id = $this->almacen_id;
            $newExistencia->talla_id = $this->talla_id;
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