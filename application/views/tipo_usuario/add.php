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
              	<h3 class="box-title">Añadir Tipo Usuario</h3>
            </div>
            <?php echo form_open('tipo_usuario/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="tipousuario_descripcion" class="control-label">Descripcion</label>
                        <div class="form-group">
                            <input type="text" name="tipousuario_descripcion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $this->input->post('tipousuario_descripcion'); ?>" class="form-control" id="tipousuario_descripcion" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label class="control-label">
                            <input type="checkbox" id="select_all" onClick="toggle(this)" checked />Seleccionar Todos</label>
                        </div>
                    </div>
                    
                    <?php
                    foreach ($all_rol as $rol) { ?>
                    <div class="col-md-4 text-right">
                        <label><?php echo $rol['rol_descripcion']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol" id="rol" value="" checked/></label>
                    </div>
                    <?php } ?>
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