<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ingreso Add</h3>
            </div>
            <?php echo form_open('ingreso/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="unidad_id" class="control-label">Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control">
								<option value="">select unidad</option>
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $this->input->post('unidad_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_id" class="control-label">Pedido</label>
						<div class="form-group">
							<select name="pedido_id" class="form-control">
								<option value="">select pedido</option>
								<?php 
								foreach($all_pedido as $pedido)
								{
									$selected = ($pedido['pedido_id'] == $this->input->post('pedido_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$pedido['pedido_id'].'" '.$selected.'>'.$pedido['pedido_numero'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
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
						<label for="ingreso_numdoc" class="control-label">Ingreso Numdoc</label>
						<div class="form-group">
							<input type="text" name="ingreso_numdoc" value="<?php echo $this->input->post('ingreso_numdoc'); ?>" class="form-control" id="ingreso_numdoc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ingreso_fecha" class="control-label">Ingreso Fecha</label>
						<div class="form-group">
							<input type="text" name="ingreso_fecha" value="<?php echo $this->input->post('ingreso_fecha'); ?>" class="has-datepicker form-control" id="ingreso_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ingreso_hora" class="control-label">Ingreso Hora</label>
						<div class="form-group">
							<input type="text" name="ingreso_hora" value="<?php echo $this->input->post('ingreso_hora'); ?>" class="form-control" id="ingreso_hora" />
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