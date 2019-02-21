<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Unidad</h3>
            </div>
			<?php echo form_open('unidad/edit/'.$unidad['unidad_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
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
					<div class="col-md-6">
						<label for="unidad_nombre" class="control-label">Nombre</label>
						<div class="form-group">
							<input type="text" name="unidad_nombre" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo ($this->input->post('unidad_nombre') ? $this->input->post('unidad_nombre') : $unidad['unidad_nombre']); ?>" class="form-control" id="unidad_nombre" required/>
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_codigo" class="control-label">Codigo</label>
						<div class="form-group">
							<input type="text" name="unidad_codigo" value="<?php echo ($this->input->post('unidad_codigo') ? $this->input->post('unidad_codigo') : $unidad['unidad_codigo']); ?>" class="form-control" id="unidad_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_descripcion" class="control-label">Descripcion</label>
						<div class="form-group">
							<input type="text" name="unidad_descripcion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo ($this->input->post('unidad_descripcion') ? $this->input->post('unidad_descripcion') : $unidad['unidad_descripcion']); ?>" class="form-control" id="unidad_descripcion" />
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