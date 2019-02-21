<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Gestión</h3>
            </div>
            <?php echo form_open('gestion/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					
					<div class="col-md-6">
						<label for="gestion_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="gestion_nombre" value="<?php echo $this->input->post('gestion_nombre'); ?>" class="form-control" id="gestion_nombre" required />
                                                        <span class="text-danger"><?php echo form_error('gestion_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="gestion_descripcion" value="<?php echo $this->input->post('gestion_descripcion'); ?>" class="form-control" id="gestion_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_inicio" class="control-label">Inicio</label>
						<div class="form-group">
							<input type="date" name="gestion_inicio" value="<?php echo $this->input->post('gestion_inicio'); ?>" class="form-control" id="gestion_inicio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gestion_fin" class="control-label">Fin</label>
						<div class="form-group">
							<input type="date" name="gestion_fin" value="<?php echo $this->input->post('gestion_fin'); ?>" class="form-control" id="gestion_fin" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="institucion_id" class="control-label">Institución</label>
						<div class="form-group">
							<select name="institucion_id" class="form-control">
								<!--<option value="">select institucion</option>-->
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
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('gestion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>