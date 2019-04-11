<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByClassName('checkbox');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Rol Usuario de: <?php echo $tipo_usuario['tipousuario_descripcion'] ?></h3>
            </div>
            <?php echo form_open('tipo_usuario/edit/'.$tipo_usuario['tipousuario_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label class="control-label">
                            <input type="checkbox" id="select_all" onClick="toggle(this)" checked />Seleccionar Todos</label>
                        </div>
                    </div>
                    
                    <?php
                    $i = 0;
                    foreach ($all_rol as $rol) { ?>
                    <div class="col-md-4 text-right">
                        <label><?php echo $rol['rol_descripcion']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol<?php echo $i; ?>" id="rol<?php echo $i; ?>" value="1" checked/></label>
                        <input type="hidden" name="rolid<?php echo $i; ?>" id="rolid<?php echo $i; ?>" value="<?php echo $rol['rol_id']; ?>" />
                    </div>
                    <?php $i++; } ?>
                    <input type="hidden" name="cont_rol" id="cont_rol" value="<?php echo $i; ?>" />
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                 <a href="<?php echo site_url('tipo_usuario'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
                <?php echo form_close(); ?>
        </div>
    </div>
</div>