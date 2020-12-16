<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Factura Add</h3>
            </div>
            <?php echo form_open('factura/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
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
						<label for="ingreso_id" class="control-label">Ingreso</label>
						<div class="form-group">
							<select name="ingreso_id" class="form-control">
								<option value="">select ingreso</option>
								<?php 
								foreach($all_ingreso as $ingreso)
								{
									$selected = ($ingreso['ingreso_id'] == $this->input->post('ingreso_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$ingreso['ingreso_id'].'" '.$selected.'>'.$ingreso['ingreso_numdoc'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Factura Numero</label>
						<div class="form-group">
							<input type="text" name="factura_numero" value="<?php echo $this->input->post('factura_numero'); ?>" class="form-control" id="factura_numero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_fecha" class="control-label">Factura Fecha</label>
						<div class="form-group">
							<input type="text" name="factura_fecha" value="<?php echo $this->input->post('factura_fecha'); ?>" class="has-datepicker form-control" id="factura_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_nit" class="control-label">Factura Nit</label>
						<div class="form-group">
							<input type="text" name="factura_nit" value="<?php echo $this->input->post('factura_nit'); ?>" class="form-control" id="factura_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_razon" class="control-label">Factura Razon</label>
						<div class="form-group">
							<input type="text" name="factura_razon" value="<?php echo $this->input->post('factura_razon'); ?>" class="form-control" id="factura_razon" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_importe" class="control-label">Factura Importe</label>
						<div class="form-group">
							<input type="text" name="factura_importe" value="<?php echo $this->input->post('factura_importe'); ?>" class="form-control" id="factura_importe" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_autorizacion" class="control-label">Factura Autorizacion</label>
						<div class="form-group">
							<input type="text" name="factura_autorizacion" value="<?php echo $this->input->post('factura_autorizacion'); ?>" class="form-control" id="factura_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_poliza" class="control-label">Factura Poliza</label>
						<div class="form-group">
							<input type="text" name="factura_poliza" value="<?php echo $this->input->post('factura_poliza'); ?>" class="form-control" id="factura_poliza" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_ice" class="control-label">Factura Ice</label>
						<div class="form-group">
							<input type="text" name="factura_ice" value="<?php echo $this->input->post('factura_ice'); ?>" class="form-control" id="factura_ice" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_exento" class="control-label">Factura Exento</label>
						<div class="form-group">
							<input type="text" name="factura_exento" value="<?php echo $this->input->post('factura_exento'); ?>" class="form-control" id="factura_exento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_neto" class="control-label">Factura Neto</label>
						<div class="form-group">
							<input type="text" name="factura_neto" value="<?php echo $this->input->post('factura_neto'); ?>" class="form-control" id="factura_neto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_creditofiscal" class="control-label">Factura Creditofiscal</label>
						<div class="form-group">
							<input type="text" name="factura_creditofiscal" value="<?php echo $this->input->post('factura_creditofiscal'); ?>" class="form-control" id="factura_creditofiscal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_codigocontrol" class="control-label">Factura Codigocontrol</label>
						<div class="form-group">
							<input type="text" name="factura_codigocontrol" value="<?php echo $this->input->post('factura_codigocontrol'); ?>" class="form-control" id="factura_codigocontrol" />
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