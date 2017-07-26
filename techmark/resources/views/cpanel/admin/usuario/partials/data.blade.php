<div class="row">
    <div class="col-lg-5">
        @include('cpanel.admin.usuario.partials.info')
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">

                <h3 class="panel-title">Permisos</h3>

            </div>
            <div class="panel-body">
                @include('cpanel.admin.usuario.partials.permisos')

            </div>
        </div>
    </div>

</div>
<div class="row">
   <div class="col-lg-12">
       <div class="pull-right">
           <button type="submit" class="btn btn-primary  waves-effect waves-light" target="_blank" >Asignar Permisos
               <span class="m-l-5"><i class=" icon-equalizer"></i></span>
           </button>
       </div>
   </div>
</div>


