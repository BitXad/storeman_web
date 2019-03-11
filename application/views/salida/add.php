<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Salida Add</h3>
            </div>
            <?php echo form_open('salida/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
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
					<div class="col-md-6">
						<label for="programa_id" class="control-label">Programa</label>
						<div class="form-group">
							<select name="programa_id" class="form-control">
								<option value="">select programa</option>
								<?php 
								foreach($all_programa as $programa)
								{
									$selected = ($programa['programa_id'] == $this->input->post('programa_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_id" class="control-label">Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control">
								<option value="">select unidad</option>
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
					<div class="col-md-6">
						<label for="gestion_id" class="control-label">Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control">
								<option value="">select gestion</option>
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $this->input->post('gestion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_motivo" class="control-label">Salida Motivo</label>
						<div class="form-group">
							<input type="text" name="salida_motivo" value="<?php echo $this->input->post('salida_motivo'); ?>" class="form-control" id="salida_motivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_fechasal" class="control-label">Salida Fechasal</label>
						<div class="form-group">
							<input type="text" name="salida_fechasal" value="<?php echo $this->input->post('salida_fechasal'); ?>" class="has-datepicker form-control" id="salida_fechasal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_acta" class="control-label">Salida Acta</label>
						<div class="form-group">
							<input type="text" name="salida_acta" value="<?php echo $this->input->post('salida_acta'); ?>" class="form-control" id="salida_acta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_obs" class="control-label">Salida Obs</label>
						<div class="form-group">
							<input type="text" name="salida_obs" value="<?php echo $this->input->post('salida_obs'); ?>" class="form-control" id="salida_obs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_fecha" class="control-label">Salida Fecha</label>
						<div class="form-group">
							<input type="text" name="salida_fecha" value="<?php echo $this->input->post('salida_fecha'); ?>" class="has-datetimepicker form-control" id="salida_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_doc" class="control-label">Salida Doc</label>
						<div class="form-group">
							<input type="text" name="salida_doc" value="<?php echo $this->input->post('salida_doc'); ?>" class="form-control" id="salida_doc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_hora" class="control-label">Salida Hora</label>
						<div class="form-group">
							<input type="text" name="salida_hora" value="<?php echo $this->input->post('salida_hora'); ?>" class="has-datetimepicker form-control" id="salida_hora" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>