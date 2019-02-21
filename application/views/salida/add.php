<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Salida</h3>
            </div>
            <?php echo form_open('salida/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="salida_motivo" class="control-label"><span class="text-danger">*</span>Motivo</label>
						<div class="form-group">
							<input type="text" name="salida_motivo" value="<?php echo $this->input->post('salida_motivo'); ?>" class="form-control" id="salida_motivo" required />
                                                        <span class="text-danger"><?php echo form_error('salida_motivo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="date" name="salida_fecha" value="<?php echo $this->input->post('salida_fecha'); ?>" class="form-control" id="salida_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_acta" class="control-label">Acta</label>
						<div class="form-group">
							<input type="text" name="salida_acta" value="<?php echo $this->input->post('salida_acta'); ?>" class="form-control" id="salida_acta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_obs" class="control-label">Obs.</label>
						<div class="form-group">
							<input type="text" name="salida_obs" value="<?php echo $this->input->post('salida_obs'); ?>" class="form-control" id="salida_obs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_fechahora" class="control-label">Fecha/hora</label>
						<div class="form-group">
                                                    <input type="datetime-local" name="salida_fechahora" value="<?php echo $this->input->post('salida_fechahora'); ?>" class="form-control" id="salida_fechahora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salida_doc" class="control-label">Doc.</label>
						<div class="form-group">
							<input type="text" name="salida_doc" value="<?php echo $this->input->post('salida_doc'); ?>" class="form-control" id="salida_doc" />
						</div>
					</div>
				
                                <div class="col-md-6">
						<label for="unidad_id" class="control-label"><span class="text-danger">*</span>Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control" required>
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
					<div class="col-md-6">
						<label for="gestion_id" class="control-label"><span class="text-danger">*</span>Gestión</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control" required>
								<option value="">- GESTIÓN -</option>
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
						<label for="usuario_id" class="control-label"><span class="text-danger">*</span>Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control" required>
								<option value="">- USUARIO -</option>
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
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('salida'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>