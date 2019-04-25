<script type="text/javascript">
    function cambiarcod(cod){
        var nombre = $("#unidad_nombre").val();
        var cad1 = nombre.substring(0,2);
        var cad2 = nombre.substring(nombre.length-1,nombre.length);
        var fecha = new Date();
        var pararand = fecha.getFullYear()+fecha.getMonth()+fecha.getDay();
        var cad3 = Math.floor((Math.random(1001,9999) * pararand));
        var cad = cad1+cad2+cad3;
        $('#unidad_codigo').val(cad);
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Unidad</h3>&nbsp;&nbsp;
                <button type="button" class="btn btn-success btn-sm" onclick="cambiarcod(this);" title="Volver a generar Código Unidad">
			<i class="fa fa-edit"></i>Codigo Unidad
		</button>
            </div>
                <?php echo form_open('unidad/edit/'.$unidad['unidad_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                                <label for="unidad_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre</label>
                                <div class="form-group">
                                        <input type="text" name="unidad_nombre" value="<?php echo ($this->input->post('unidad_nombre') ? $this->input->post('unidad_nombre') : $unidad['unidad_nombre']); ?>" class="form-control" id="unidad_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        <span class="text-danger"><?php echo form_error('unidad_nombre');?></span>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="unidad_codigo" class="control-label"><span class="text-danger">(*)</span>Codigo</label>
                                <div class="form-group">
                                    <input type="text" name="unidad_codigo" value="<?php echo ($this->input->post('unidad_codigo') ? $this->input->post('unidad_codigo') : $unidad['unidad_codigo']); ?>" class="form-control" id="unidad_codigo" required />
                                    <span class="text-danger"><?php echo form_error('unidad_codigo');?></span>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="unidad_descripcion" class="control-label">Descripción</label>
                                <div class="form-group">
                                        <input type="text" name="unidad_descripcion" value="<?php echo ($this->input->post('unidad_descripcion') ? $this->input->post('unidad_descripcion') : $unidad['unidad_descripcion']); ?>" class="form-control" id="unidad_descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jerarquia_id" class="control-label"><span class="text-danger">(*)</span>Nivel Jerárquico</label>
                            <div class="form-group">
                                <select name="jerarquia_id" class="form-control" id="jerarquia_id" required>
                                    <option value="">- NIVEL JERARQUICO -</option>
                                    <?php 
                                    foreach($all_jerarquia as $jerarquia)
                                    {
                                        $selected = ($jerarquia['jerarquia_id'] == $unidad['jerarquia_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$jerarquia['jerarquia_id'].'" '.$selected.'>'.$jerarquia['jerarquia_nombre'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <label for="estado_id" class="control-label">Estado</label>
                                <div class="form-group">
                                        <select name="estado_id" class="form-control" required>
                                                <option value="">- ESTADO -</option>
                                                <?php 
                                                foreach($all_estado as $estado)
                                                {
                                                        $selected = ($estado['estado_id'] == $unidad['estado_id']) ? ' selected="selected"' : "";

                                                        echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
                                                } 
                                                ?>
                                        </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Guardar
                </button>
                     <a href="<?php echo site_url('unidad'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>