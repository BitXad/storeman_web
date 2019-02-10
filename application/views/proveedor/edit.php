<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Proveedor Edit</h3>
            </div>
			<?php echo form_open('proveedor/edit/'.$proveedor['proveedor_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="proveedor_nombre" class="control-label">Proveedor Nombre</label>
						<div class="form-group">
							<input type="text" name="proveedor_nombre" value="<?php echo ($this->input->post('proveedor_nombre') ? $this->input->post('proveedor_nombre') : $proveedor['proveedor_nombre']); ?>" class="form-control" id="proveedor_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_direccion" class="control-label">Proveedor Direccion</label>
						<div class="form-group">
							<input type="text" name="proveedor_direccion" value="<?php echo ($this->input->post('proveedor_direccion') ? $this->input->post('proveedor_direccion') : $proveedor['proveedor_direccion']); ?>" class="form-control" id="proveedor_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_telefono" class="control-label">Proveedor Telefono</label>
						<div class="form-group">
							<input type="text" name="proveedor_telefono" value="<?php echo ($this->input->post('proveedor_telefono') ? $this->input->post('proveedor_telefono') : $proveedor['proveedor_telefono']); ?>" class="form-control" id="proveedor_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_celular" class="control-label">Proveedor Celular</label>
						<div class="form-group">
							<input type="text" name="proveedor_celular" value="<?php echo ($this->input->post('proveedor_celular') ? $this->input->post('proveedor_celular') : $proveedor['proveedor_celular']); ?>" class="form-control" id="proveedor_celular" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_email" class="control-label">Proveedor Email</label>
						<div class="form-group">
							<input type="text" name="proveedor_email" value="<?php echo ($this->input->post('proveedor_email') ? $this->input->post('proveedor_email') : $proveedor['proveedor_email']); ?>" class="form-control" id="proveedor_email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_contacto" class="control-label">Proveedor Contacto</label>
						<div class="form-group">
							<input type="text" name="proveedor_contacto" value="<?php echo ($this->input->post('proveedor_contacto') ? $this->input->post('proveedor_contacto') : $proveedor['proveedor_contacto']); ?>" class="form-control" id="proveedor_contacto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_nit" class="control-label">Proveedor Nit</label>
						<div class="form-group">
							<input type="text" name="proveedor_nit" value="<?php echo ($this->input->post('proveedor_nit') ? $this->input->post('proveedor_nit') : $proveedor['proveedor_nit']); ?>" class="form-control" id="proveedor_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_razon" class="control-label">Proveedor Razon</label>
						<div class="form-group">
							<input type="text" name="proveedor_razon" value="<?php echo ($this->input->post('proveedor_razon') ? $this->input->post('proveedor_razon') : $proveedor['proveedor_razon']); ?>" class="form-control" id="proveedor_razon" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_autorizacion" class="control-label">Proveedor Autorizacion</label>
						<div class="form-group">
							<input type="text" name="proveedor_autorizacion" value="<?php echo ($this->input->post('proveedor_autorizacion') ? $this->input->post('proveedor_autorizacion') : $proveedor['proveedor_autorizacion']); ?>" class="form-control" id="proveedor_autorizacion" />
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