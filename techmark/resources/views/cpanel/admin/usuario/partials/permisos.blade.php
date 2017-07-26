<div class="form-group col-lg-12">
    @foreach(\App\Modulos::all() as $modulo)
        <div class="checkbox checkbox-primary">
            <input name="modulo[]" value="{!! $modulo->id !!}" id="{!! $modulo->id !!}" type="checkbox"   {!! $user->checkAccess($modulo->nombre) !!}>
            <label for="{!! $modulo->id !!}"> {!! $modulo->nombre !!} </label>
        </div>
    @endforeach

</div>
