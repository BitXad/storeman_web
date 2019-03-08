<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Pedido</h3>
            </div>
            <?php echo form_open_multipart('pedido/edit/'.$pedido['pedido_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="pedido_numero" class="control-label"><span class="text-danger">*</span>Número</label>
						<div class="form-group">
							<input type="text" name="pedido_numero" value="<?php echo ($this->input->post('pedido_numero') ? $this->input->post('pedido_numero') : $pedido['pedido_numero']); ?>" class="form-control" id="pedido_numero" required />
                                                        <span class="text-danger"><?php echo form_error('pedido_numero');?></span>
						</div>
					</div>
					<!--<div class="col-md-6">
						<label for="pedido_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="date" name="pedido_fecha" value="<?php //echo ($this->input->post('pedido_fecha') ? $this->input->post('pedido_fecha') : $pedido['pedido_fecha']); ?>" class="form-control" id="pedido_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_hora" class="control-label">Hora</label>
						<div class="form-group">
                                                    <input type="time" name="pedido_hora" value="<?php //echo ($this->input->post('pedido_hora') ? $this->input->post('pedido_hora') : $pedido['pedido_hora']); ?>" class="form-control" id="pedido_hora" />
						</div>
					</div>-->
					<div class="col-md-6">
						<label for="pedido_archivo" class="control-label">Archivo</label>
						<div class="form-group">
							<input type="file" name="pedido_archivo" value="<?php echo ($this->input->post('pedido_archivo') ? $this->input->post('pedido_archivo') : $pedido['pedido_archivo']); ?>" class="form-control" id="pedido_archivo" />
                                                        <input type="hidden" name="pedido_archivo1" value="<?php echo ($this->input->post('pedido_archivo') ? $this->input->post('pedido_archivo') : $pedido['pedido_archivo']); ?>" class="form-control" id="pedido_archivo1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="file" name="pedido_imagen" value="<?php echo ($this->input->post('pedido_imagen') ? $this->input->post('pedido_imagen') : $pedido['pedido_imagen']); ?>" class="form-control" id="pedido_imagen" />
                                                        <input type="hidden" name="pedido_imagen1" value="<?php echo ($this->input->post('pedido_imagen') ? $this->input->post('pedido_imagen') : $pedido['pedido_imagen']); ?>" class="form-control" id="pedido_imagen1" />
						</div>
					</div>
					
					<div class="col-md-6">
						<label for="pedido_fechapedido" class="control-label"><span class="text-danger">*</span>Fecha Pedido</label>
						<div class="form-group">
							<input type="date" name="pedido_fechapedido" value="<?php echo ($this->input->post('pedido_fechapedido') ? $this->input->post('pedido_fechapedido') : $pedido['pedido_fechapedido']); ?>" class="form-control" id="pedido_fechapedido" required />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="gestion_id" class="control-label">Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control">
								<!--<option value="">select gestion</option>-->
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $pedido['gestion_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
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
									$selected = ($estado['estado_id'] == $pedido['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<label for="unidad_id" class="control-label">Unidad</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control">
								<option value="">- UNIDAD -</option>
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $pedido['unidad_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="programa_id" class="control-label">Programa</label>
						<div class="form-group">
							<select name="programa_id" class="form-control">
								<option value="">- PROGRAMA -</option>
								<?php 
								foreach($all_programa as $programa)
								{
									$selected = ($programa['programa_id'] == $pedido['programa_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
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
                <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>