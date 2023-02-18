<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
                
              	<h3 class="box-title">Modificar - Detalle Ingreso</h3>
                
            </div>
			<?php echo form_open('detalle_ingreso/edit/'.$detalle_ingreso['detalleing_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="articulo_id" class="control-label">Articulo</label>
						<div class="form-group">
							<select name="articulo_id" class="form-control">
								<option value="">Ninguno</option>
								<?php 
								foreach($all_articulo as $articulo)
								{
									$selected = ($articulo['articulo_id'] == $detalle_ingreso['articulo_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$articulo['articulo_id'].'" '.$selected.'>'.$articulo['articulo_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="ingreso_id" class="control-label">Ingreso</label>
						<div class="form-group">
							<select name="ingreso_id" class="form-control">
								<option value="">Ninguno</option>
								<?php 
								foreach($all_ingreso as $ingreso)
								{
									$selected = ($ingreso['ingreso_id'] == $detalle_ingreso['ingreso_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$ingreso['ingreso_id'].'" '.$selected.'>'.$ingreso['ingreso_numdoc'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_cantidad" class="control-label"><span class="text-danger">*</span>Cantidad</label>
						<div class="form-group">
							<input type="text" name="detalleing_cantidad" value="<?php echo ($this->input->post('detalleing_cantidad') ? $this->input->post('detalleing_cantidad') : $detalle_ingreso['detalleing_cantidad']); ?>" class="form-control" id="detalleing_cantidad" />
							<span class="text-danger"><?php echo form_error('detalleing_cantidad');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_precio" class="control-label"><span class="text-danger">*</span>Precio</label>
						<div class="form-group">
							<input type="text" name="detalleing_precio" value="<?php echo ($this->input->post('detalleing_precio') ? $this->input->post('detalleing_precio') : $detalle_ingreso['detalleing_precio']); ?>" class="form-control" id="detalleing_precio" />
							<span class="text-danger"><?php echo form_error('detalleing_precio');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_total" class="control-label"><span class="text-danger">*</span>Total</label>
						<div class="form-group">
							<input type="text" name="detalleing_total" value="<?php echo ($this->input->post('detalleing_total') ? $this->input->post('detalleing_total') : $detalle_ingreso['detalleing_total']); ?>" class="form-control" id="detalleing_total" />
							<span class="text-danger"><?php echo form_error('detalleing_total');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_salida" class="control-label">Salida</label>
						<div class="form-group">
							<input type="text" name="detalleing_salida" value="<?php echo ($this->input->post('detalleing_salida') ? $this->input->post('detalleing_salida') : $detalle_ingreso['detalleing_salida']); ?>" class="form-control" id="detalleing_salida" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_saldo" class="control-label">Saldo</label>
						<div class="form-group">
							<input type="text" name="detalleing_saldo" value="<?php echo ($this->input->post('detalleing_saldo') ? $this->input->post('detalleing_saldo') : $detalle_ingreso['detalleing_saldo']); ?>" class="form-control" id="detalleing_saldo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Numero Factura</label>
						<div class="form-group">
							<input type="text" name="factura_numero" value="<?php echo ($this->input->post('factura_numero') ? $this->input->post('factura_numero') : $detalle_ingreso['factura_numero']); ?>" class="form-control" id="factura_numero" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
                            <button type="submit" class="btn btn-success">
					<i class="fa fa-floppy-o"></i> Guardar
                            </button>
                            
                            <button type="button" class="btn btn-danger" onclick="JavaScript:window.close()">
					<i class="fa fa-times"></i> Cerrar 
                            </button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>