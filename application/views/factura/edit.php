<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Factura Edit</h3>
            </div>
			<?php echo form_open('factura/edit/'.$factura['factura_id']); ?>
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
									$selected = ($usuario['usuario_id'] == $factura['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Factura Numero</label>
						<div class="form-group">
							<input type="text" name="factura_numero" value="<?php echo ($this->input->post('factura_numero') ? $this->input->post('factura_numero') : $factura['factura_numero']); ?>" class="form-control" id="factura_numero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_fecha" class="control-label">Factura Fecha</label>
						<div class="form-group">
							<input type="text" name="factura_fecha" value="<?php echo ($this->input->post('factura_fecha') ? $this->input->post('factura_fecha') : $factura['factura_fecha']); ?>" class="has-datepicker form-control" id="factura_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_nit" class="control-label">Factura Nit</label>
						<div class="form-group">
							<input type="text" name="factura_nit" value="<?php echo ($this->input->post('factura_nit') ? $this->input->post('factura_nit') : $factura['factura_nit']); ?>" class="form-control" id="factura_nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_razon" class="control-label">Factura Razon</label>
						<div class="form-group">
							<input type="text" name="factura_razon" value="<?php echo ($this->input->post('factura_razon') ? $this->input->post('factura_razon') : $factura['factura_razon']); ?>" class="form-control" id="factura_razon" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_importe" class="control-label">Factura Importe</label>
						<div class="form-group">
							<input type="text" name="factura_importe" value="<?php echo ($this->input->post('factura_importe') ? $this->input->post('factura_importe') : $factura['factura_importe']); ?>" class="form-control" id="factura_importe" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_autorizacion" class="control-label">Factura Autorizacion</label>
						<div class="form-group">
							<input type="text" name="factura_autorizacion" value="<?php echo ($this->input->post('factura_autorizacion') ? $this->input->post('factura_autorizacion') : $factura['factura_autorizacion']); ?>" class="form-control" id="factura_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_poliza" class="control-label">Factura Poliza</label>
						<div class="form-group">
							<input type="text" name="factura_poliza" value="<?php echo ($this->input->post('factura_poliza') ? $this->input->post('factura_poliza') : $factura['factura_poliza']); ?>" class="form-control" id="factura_poliza" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_ice" class="control-label">Factura Ice</label>
						<div class="form-group">
							<input type="text" name="factura_ice" value="<?php echo ($this->input->post('factura_ice') ? $this->input->post('factura_ice') : $factura['factura_ice']); ?>" class="form-control" id="factura_ice" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_exento" class="control-label">Factura Exento</label>
						<div class="form-group">
							<input type="text" name="factura_exento" value="<?php echo ($this->input->post('factura_exento') ? $this->input->post('factura_exento') : $factura['factura_exento']); ?>" class="form-control" id="factura_exento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_neto" class="control-label">Factura Neto</label>
						<div class="form-group">
							<input type="text" name="factura_neto" value="<?php echo ($this->input->post('factura_neto') ? $this->input->post('factura_neto') : $factura['factura_neto']); ?>" class="form-control" id="factura_neto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_creditofiscal" class="control-label">Factura Creditofiscal</label>
						<div class="form-group">
							<input type="text" name="factura_creditofiscal" value="<?php echo ($this->input->post('factura_creditofiscal') ? $this->input->post('factura_creditofiscal') : $factura['factura_creditofiscal']); ?>" class="form-control" id="factura_creditofiscal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_codigocontrol" class="control-label">Factura Codigocontrol</label>
						<div class="form-group">
							<input type="text" name="factura_codigocontrol" value="<?php echo ($this->input->post('factura_codigocontrol') ? $this->input->post('factura_codigocontrol') : $factura['factura_codigocontrol']); ?>" class="form-control" id="factura_codigocontrol" />
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