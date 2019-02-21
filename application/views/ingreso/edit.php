<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Ingreso</h3>
            </div>
			<?php echo form_open('ingreso/edit/'.$ingreso['ingreso_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="ingreso_numdoc" class="control-label"><span class="text-danger">*</span>Num. Doc.</label>
						<div class="form-group">
							<input type="text" name="ingreso_numdoc" value="<?php echo ($this->input->post('ingreso_numdoc') ? $this->input->post('ingreso_numdoc') : $ingreso['ingreso_numdoc']); ?>" class="form-control" id="ingreso_numdoc" required />
                                                        <span class="text-danger"><?php echo form_error('ingreso_numdoc');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="ingreso_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="date" name="ingreso_fecha" value="<?php echo ($this->input->post('ingreso_fecha') ? $this->input->post('ingreso_fecha') : $ingreso['ingreso_fecha']); ?>" class="form-control" id="ingreso_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ingreso_hora" class="control-label">Hora</label>
						<div class="form-group">
                                                    <input type="time" name="ingreso_hora" value="<?php echo ($this->input->post('ingreso_hora') ? $this->input->post('ingreso_hora') : $ingreso['ingreso_hora']); ?>" class="form-control" id="ingreso_hora" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="unidad_id" class="control-label"><span class="text-danger">*</span>Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control" required>
								<!--<option value="">- UNIDAD -</option>-->
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $ingreso['unidad_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_id" class="control-label"><span class="text-danger">*</span>Pedido</label>
						<div class="form-group">
							<select name="pedido_id" class="form-control" required>
								<!--<option value="">- PEDIDO -</option>-->
								<?php 
								foreach($all_pedido as $pedido)
								{
									$selected = ($pedido['pedido_id'] == $ingreso['pedido_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$pedido['pedido_id'].'" '.$selected.'>'.$pedido['pedido_numero'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label"><span class="text-danger">*</span>Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control" required>
								<!--<option value="">- USUARIO -</option>-->
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $ingreso['usuario_id']) ? ' selected="selected"' : "";

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
								<!--<option value="">select estado</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $ingreso['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
                </button>
                <a href="<?php echo site_url('ingreso'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>