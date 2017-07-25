<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'usuarios';
    protected $fillable = [
        'username',
        'estado',
        'email',
        'password',
        'rol_id',
        'nombre',
        'telefono','celular','direccion',
        'read',
        'insert',
        'delete',
        'edit',
        'sucursal_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public  function  setPasswordAttribute($value){
        if(!empty($value)){
            $this->attributes['password']=\Hash::make($value);
        }

    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function rol(){
        return $this->belongsTo('App\Rol','rol_id','id');
    }

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    /*
    * metodos para los policy
    */
    function isSuperAdmin($rol){
        return (strtolower($rol->nombre)==strtolower('administrador'));

    }

    function isSucursal($rol){
        return (strtolower($rol->nombre)==strtolower('Sucursal'));

    }
    function allowEdit(){
        return $this->edit==1;
    }
    function allowInsert(){
        return $this->insert==1;
    }
    function allowDelete(){
        return $this->delete==1;
    }
    function allowRead(){
        return $this->read==1;
    }
    //definir si el susuario tiene relaciones
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        $num+= Ciudad::where('usuarios_id',$this->id)->count();
        $num+= Zona::where('usuarios_id',$this->id)->count();
        $num+= Departamento::where('usuarios_id',$this->id)->count();
        $num+= Empresa::where('usuarios_id',$this->id)->count();
        $num+= Galeria::where('usuarios_id',$this->id)->count();
        $num+=Responsable::where('usuarios_id',$this->id)->count();
        $num+=TipOfertas::where('usuarios_id',$this->id)->count();
        $num+=TipInmuebles::where('usuarios_id',$this->id)->count();
        $num+=News::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
            return true;
    }

    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
}
