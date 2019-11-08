<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Institución</h3>
            </div>
            <?php echo form_open_multipart('institucion/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="institucion_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="institucion_nombre" value="<?php echo $this->input->post('institucion_nombre'); ?>" class="form-control" id="institucion_nombre" required />
                                                        <span class="text-danger"><?php echo form_error('institucion_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_sucursal" class="control-label">Sucursal</label>
						<div class="form-group">
							<input type="text" name="institucion_sucursal" value="<?php echo $this->input->post('institucion_sucursal'); ?>" class="form-control" id="institucion_sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="institucion_direccion" value="<?php echo $this->input->post('institucion_direccion'); ?>" class="form-control" id="institucion_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_ubicacion" class="control-label">Ubicación</label>
						<div class="form-group">
							<input type="text" name="institucion_ubicacion" value="<?php echo $this->input->post('institucion_ubicacion'); ?>" class="form-control" id="institucion_ubicacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_telef" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="institucion_telef" value="<?php echo $this->input->post('institucion_telef'); ?>" class="form-control" id="institucion_telef" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_nit" class="control-label">Nit</label>
						<div class="form-group">
							<input type="text" name="institucion_nit" value="<?php echo $this->input->post('institucion_nit'); ?>" class="form-control" id="institucion_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="institucion_autorizacion" value="<?php echo $this->input->post('institucion_autorizacion'); ?>" class="form-control" id="institucion_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_logo" class="control-label">Logo</label>
						<div class="form-group">
							<input type="file" name="institucion_logo" value="<?php echo $this->input->post('institucion_logo'); ?>" class="form-control" id="institucion_logo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="institucion_eslogan" value="<?php echo $this->input->post('institucion_eslogan'); ?>" class="form-control" id="institucion_eslogan" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('institucion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>