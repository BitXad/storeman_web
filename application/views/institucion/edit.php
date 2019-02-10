<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Institucion Edit</h3>
            </div>
			<?php echo form_open('institucion/edit/'.$institucion['institucion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="institucion_nombre" class="control-label">Institucion Nombre</label>
						<div class="form-group">
							<input type="text" name="institucion_nombre" value="<?php echo ($this->input->post('institucion_nombre') ? $this->input->post('institucion_nombre') : $institucion['institucion_nombre']); ?>" class="form-control" id="institucion_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_sucursal" class="control-label">Institucion Sucursal</label>
						<div class="form-group">
							<input type="text" name="institucion_sucursal" value="<?php echo ($this->input->post('institucion_sucursal') ? $this->input->post('institucion_sucursal') : $institucion['institucion_sucursal']); ?>" class="form-control" id="institucion_sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_direccion" class="control-label">Institucion Direccion</label>
						<div class="form-group">
							<input type="text" name="institucion_direccion" value="<?php echo ($this->input->post('institucion_direccion') ? $this->input->post('institucion_direccion') : $institucion['institucion_direccion']); ?>" class="form-control" id="institucion_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_ubicacion" class="control-label">Institucion Ubicacion</label>
						<div class="form-group">
							<input type="text" name="institucion_ubicacion" value="<?php echo ($this->input->post('institucion_ubicacion') ? $this->input->post('institucion_ubicacion') : $institucion['institucion_ubicacion']); ?>" class="form-control" id="institucion_ubicacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_telef" class="control-label">Institucion Telef</label>
						<div class="form-group">
							<input type="text" name="institucion_telef" value="<?php echo ($this->input->post('institucion_telef') ? $this->input->post('institucion_telef') : $institucion['institucion_telef']); ?>" class="form-control" id="institucion_telef" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_nit" class="control-label">Institucion Nit</label>
						<div class="form-group">
							<input type="text" name="institucion_nit" value="<?php echo ($this->input->post('institucion_nit') ? $this->input->post('institucion_nit') : $institucion['institucion_nit']); ?>" class="form-control" id="institucion_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_autorizacion" class="control-label">Institucion Autorizacion</label>
						<div class="form-group">
							<input type="text" name="institucion_autorizacion" value="<?php echo ($this->input->post('institucion_autorizacion') ? $this->input->post('institucion_autorizacion') : $institucion['institucion_autorizacion']); ?>" class="form-control" id="institucion_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="institucion_eslogan" class="control-label">Institucion Eslogan</label>
						<div class="form-group">
							<input type="text" name="institucion_eslogan" value="<?php echo ($this->input->post('institucion_eslogan') ? $this->input->post('institucion_eslogan') : $institucion['institucion_eslogan']); ?>" class="form-control" id="institucion_eslogan" />
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