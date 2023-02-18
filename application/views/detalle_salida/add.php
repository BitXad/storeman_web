<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Detalle Salida Add</h3>
            </div>
            <?php echo form_open('detalle_salida/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="salida_id" class="control-label">Salida</label>
						<div class="form-group">
							<select name="salida_id" class="form-control">
								<option value="">select salida</option>
								<?php 
								foreach($all_salida as $salida)
								{
									$selected = ($salida['salida_id'] == $this->input->post('salida_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$salida['salida_id'].'" '.$selected.'>'.$salida['salida_motivo'].'</option>';
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
						<label for="detallesal_cantidad" class="control-label">Detallesal Cantidad</label>
						<div class="form-group">
							<input type="text" name="detallesal_cantidad" value="<?php echo $this->input->post('detallesal_cantidad'); ?>" class="form-control" id="detallesal_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallesal_precio" class="control-label">Detallesal Precio</label>
						<div class="form-group">
							<input type="text" name="detallesal_precio" value="<?php echo $this->input->post('detallesal_precio'); ?>" class="form-control" id="detallesal_precio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallesal_total" class="control-label">Detallesal Total</label>
						<div class="form-group">
							<input type="text" name="detallesal_total" value="<?php echo $this->input->post('detallesal_total'); ?>" class="form-control" id="detallesal_total" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>