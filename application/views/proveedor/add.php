<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Proveedor Add</h3>
            </div>
            <?php echo form_open('proveedor/add'); ?>
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
						<label for="proveedor_codigo" class="control-label">Proveedor Codigo</label>
						<div class="form-group">
							<input type="text" name="proveedor_codigo" value="<?php echo $this->input->post('proveedor_codigo'); ?>" class="form-control" id="proveedor_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_nombre" class="control-label">Proveedor Nombre</label>
						<div class="form-group">
							<input type="text" name="proveedor_nombre" value="<?php echo $this->input->post('proveedor_nombre'); ?>" class="form-control" id="proveedor_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_direccion" class="control-label">Proveedor Direccion</label>
						<div class="form-group">
							<input type="text" name="proveedor_direccion" value="<?php echo $this->input->post('proveedor_direccion'); ?>" class="form-control" id="proveedor_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_telefono" class="control-label">Proveedor Telefono</label>
						<div class="form-group">
							<input type="text" name="proveedor_telefono" value="<?php echo $this->input->post('proveedor_telefono'); ?>" class="form-control" id="proveedor_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_celular" class="control-label">Proveedor Celular</label>
						<div class="form-group">
							<input type="text" name="proveedor_celular" value="<?php echo $this->input->post('proveedor_celular'); ?>" class="form-control" id="proveedor_celular" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_email" class="control-label">Proveedor Email</label>
						<div class="form-group">
							<input type="text" name="proveedor_email" value="<?php echo $this->input->post('proveedor_email'); ?>" class="form-control" id="proveedor_email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_contacto" class="control-label">Proveedor Contacto</label>
						<div class="form-group">
							<input type="text" name="proveedor_contacto" value="<?php echo $this->input->post('proveedor_contacto'); ?>" class="form-control" id="proveedor_contacto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_nit" class="control-label">Proveedor Nit</label>
						<div class="form-group">
							<input type="text" name="proveedor_nit" value="<?php echo $this->input->post('proveedor_nit'); ?>" class="form-control" id="proveedor_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_razon" class="control-label">Proveedor Razon</label>
						<div class="form-group">
							<input type="text" name="proveedor_razon" value="<?php echo $this->input->post('proveedor_razon'); ?>" class="form-control" id="proveedor_razon" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_autorizacion" class="control-label">Proveedor Autorizacion</label>
						<div class="form-group">
							<input type="text" name="proveedor_autorizacion" value="<?php echo $this->input->post('proveedor_autorizacion'); ?>" class="form-control" id="proveedor_autorizacion" />
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