<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
                
              	<h3 class="box-title">Detalle Ingreso Add</h3>
                 
            </div>
            <?php echo form_open('detalle_ingreso/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="proveedor_id" class="control-label">Proveedor</label>
						<div class="form-group">
							<select name="proveedor_id" class="form-control">
								<option value="">select proveedor</option>
								<?php 
								foreach($all_proveedor as $proveedor)
								{
									$selected = ($proveedor['proveedor_id'] == $this->input->post('proveedor_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_id" class="control-label">Factura</label>
						<div class="form-group">
							<select name="factura_id" class="form-control">
								<option value="">select factura</option>
								<?php 
								foreach($all_factura as $factura)
								{
									$selected = ($factura['factura_id'] == $this->input->post('factura_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$factura['factura_id'].'" '.$selected.'>'.$factura['factura_razon'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_id" class="control-label">Articulo</label>
						<div class="form-group">
							<select name="articulo_id" class="form-control">
								<option value="">select articulo</option>
								<?php 
								foreach($all_articulo as $articulo)
								{
									$selected = ($articulo['articulo_id'] == $this->input->post('articulo_id')) ? ' selected="selected"' : "";

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
						<label for="programa_id" class="control-label">Programa</label>
						<div class="form-group">
							<select name="programa_id" class="form-control">
								<option value="">select programa</option>
								<?php 
								foreach($all_programa as $programa)
								{
									$selected = ($programa['programa_id'] == $this->input->post('programa_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_cantidad" class="control-label">Detalleing Cantidad</label>
						<div class="form-group">
							<input type="text" name="detalleing_cantidad" value="<?php echo $this->input->post('detalleing_cantidad'); ?>" class="form-control" id="detalleing_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_precio" class="control-label">Detalleing Precio</label>
						<div class="form-group">
							<input type="text" name="detalleing_precio" value="<?php echo $this->input->post('detalleing_precio'); ?>" class="form-control" id="detalleing_precio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleing_total" class="control-label">Detalleing Total</label>
						<div class="form-group">
							<input type="text" name="detalleing_total" value="<?php echo $this->input->post('detalleing_total'); ?>" class="form-control" id="detalleing_total" />
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