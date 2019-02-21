<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Gestion Add</h3>
            </div>
            <?php echo form_open('gestion/add'); ?>
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
						<label for="institucion_id" class="control-label">Institucion</label>
						<div class="form-group">
							<select name="institucion_id" class="form-control">
								<option value="">select institucion</option>
								<?php 
								foreach($all_institucion as $institucion)
								{
									$selected = ($institucion['institucion_id'] == $this->input->post('institucion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$institucion['institucion_id'].'" '.$selected.'>'.$institucion['institucion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_nombre" class="control-label">Gestion Nombre</label>
						<div class="form-group">
							<input type="text" name="gestion_nombre" value="<?php echo $this->input->post('gestion_nombre'); ?>" class="form-control" id="gestion_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_descripcion" class="control-label">Gestion Descripcion</label>
						<div class="form-group">
							<input type="text" name="gestion_descripcion" value="<?php echo $this->input->post('gestion_descripcion'); ?>" class="form-control" id="gestion_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_inicio" class="control-label">Gestion Inicio</label>
						<div class="form-group">
							<input type="text" name="gestion_inicio" value="<?php echo $this->input->post('gestion_inicio'); ?>" class="has-datepicker form-control" id="gestion_inicio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_fin" class="control-label">Gestion Fin</label>
						<div class="form-group">
							<input type="text" name="gestion_fin" value="<?php echo $this->input->post('gestion_fin'); ?>" class="has-datepicker form-control" id="gestion_fin" />
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