<?php
/**
 * Created by PhpStorm.
 * User: Gthusho
 * Date: 29/6/2017
 * Time: 09:22
 */
namespace App;
use Carbon\Carbon;

/**
 * Class ATMBranchOffice
 * @package App
 */
class ATMBranchOffice
{
    /**
     * @var User
     */
    private $user;
    private $amtReady = false;
    private $atm = null;
    private $dateNow = null;
    private $dateAtm =  null;
    private $deserted = true;

    /**
     * ATMBranchOffice constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->dateNow = Carbon::now();
    }
    function desertedCheck(){
        $oldCaja = null;
        $query = Caja::where('sucursal_id',$this->user->sucursal_id)
            ->where('usuario_id',$this->user->id)
            ->where('estado','p')->get();

        if(Tool::existe($query)){
            $oldCaja =  $query->first();
            $oldCaja->fcierre = date('Y/m/d',strtotime($oldCaja->registro)).' 23:59';
            $oldCaja->estado = 't';
            $oldCaja->save();

        }else
            $this->deserted = false;
    }
    public function open($apertura,$obs){

        while ($this->deserted){
            $this->desertedCheck();
        }
        $this->atm = new Caja([
            'apertura'=>$apertura,
            'observaciones'=>$obs,
            'usuario_id'=>$this->user->id,
            'sucursal_id'=>$this->user->sucursal_id]);
        $this->atm->save();
    }

    public function close($obs){
        if($this->check()){
            $this->atm->estado = 't';
            $this->atm->observaciones = $obs;
            $this->atm->fcierre = date('Y/m/d H:i');
            $this->atm->save();
        }

    }

//    public function checkState(){
//       if($this->atm->estado =='t')
//           $this->amtReady = false;
//       else
//           $this->amtReady = true;
//    }

    public function check(){
        $query = Caja::where('sucursal_id',$this->user->sucursal_id)
            ->where('usuario_id',$this->user->id)
            ->where(\DB::raw("DATE(registro)"),$this->dateNow->toDateString())
            ->get();
        if(Tool::existe($query))
        {
            $this->atm = $query->first();
            $this->amtReady = true;
        }else
            $this->amtReady = false;
        return $this->amtReady;
    }
    function isClosed(){
        if($this->check()){
            if($this->atm->estado=='t'){
                return true;
            }
            return false;
        }else
            return false;
    }
    /**
     * @return null
     */
    public function getAtm()
    {
        return $this->atm;
    }


}