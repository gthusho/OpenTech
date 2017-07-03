<?php
/**
 * Created by PhpStorm.
 * User: Gthusho
 * Date: 29/6/2017
 * Time: 09:22
 */

namespace App;


class Cart
{
   public $items = null;
   public function __construct($oldCart)
   {
       if ($oldCart){
            $this->items = $oldCart->items;
       }else{

       }
   }
    public function add($item , $id,$cantidad,$costo){
        $storedItem = ['qty'=>$item->cantidad,'price'=>$item->precio,'item'=>$item];
        if($this->items){
            if (array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] = $cantidad;
        $storedItem['price']= $costo;
        $this->items[$id] = $storedItem;
    }

    public function getTotalPrice(){

        $tQty = 0;
        if($this->items!= null ){
            foreach ($this->items as $item){
                $tQty +=  $item['price'];
            }
        }
        return $tQty;

    }

    public function getTotalQty(){

        $tQty = 0;
        if($this->items != null ){
            foreach ($this->items as $item){
                $tQty ++;
            }
        }
        return $tQty;

    }

}