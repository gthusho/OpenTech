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
   public $items;
   public $totalQty = 0;
   public $totalPrice = 0;
   public function __construct($oldCart)
   {
       if ($oldCart){
            $this->items = $oldCart->items;
//            $this->totalQty = $oldCart->totalQty;
//            $this->totalPrice = $oldCart->totalPrice;
       }else{

       }
   }
    public function add($item , $id,$cantidad,$costo){
        $storedItem = ['qty'=>$item->cantidad,'price'=>$item->precio,'item'=>$item];
        if($this->items){
            if (array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }else{
                $this->totalQty++;
            }
        }
        $storedItem['qty'] = $cantidad;
        $storedItem['price']= $costo;
        $this->items[$id] = $storedItem;
//        $this->totalQty++;
//        $this->totalPrice += $costo*$cantidad;
    }

    public function getTotalPrice(){

        $tQty = 0;
        foreach ($this->items as $item){
            $tQty += $item['qty'] * $item['price'];
        }
        return $tQty;

    }

//    public function add($item , $id){
//        $storedItem = ['qty'=>$item->cantidad,'price'=>$item->precio,'item'=>$item];
//        if($this->items){
//            if (array_key_exists($id,$this->items)){
//                $storedItem = $this->items[$id];
//            }
//        }
//        $storedItem['qty']++;
//        $storedItem['price']= $item->precio * $storedItem['qty'];
//        $this->items[$id] = $storedItem;
//        $this->totalQty++;
//        $this->totalPrice += $item->price;
//    }
}