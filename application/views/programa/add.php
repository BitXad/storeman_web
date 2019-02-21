<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Programa Add</h3>
            </div>
            <?php echo form_open('programa/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                            
					<div class="col-md-6">
						<label for="programa_nombre" class="control-label" required> (*) Nombre</label>
						<div class="form-group">
							<input type="text" name="programa_nombre" value="<?php echo $this->input->post('programa_nombre'); ?>" class="form-control" id="programa_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="programa_codigo" class="control-label" required> (*) Código</label>
						<div class="form-group">
							<input type="text" name="programa_codigo" value="<?php echo $this->input->post('programa_codigo'); ?>" class="form-control" id="programa_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="programa_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="programa_descripcion" value="<?php echo $this->input->post('programa_descripcion'); ?>" class="form-control" id="programa_descripcion" />
						</div>
					</div>                            
                            
					<div class="col-md-6">
						<label for="unidad_id" class="control-label" requieres>Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control"  required>
								<option value="">- UNIDAD -</option>
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $this->input->post('unidad_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control"  required>
								<option value="1">- ESTADO -</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

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
                <a href="<?php echo base_url('programa'); ?>" class="btn btn-danger">
					<i class="fa fa-times"></i> Cancelar
                </a>
                    
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>