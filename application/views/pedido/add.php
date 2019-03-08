<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Pedido</h3>
            </div>
            <?php echo form_open_multipart('pedido/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="pedido_numero" class="control-label"><span class="text-danger">(*)</span>Número</label>
						<div class="form-group">
							<input type="text" name="pedido_numero" value="<?php echo $this->input->post('pedido_numero'); ?>" class="form-control" id="pedido_numero" requirede />
                                                        <span class="text-danger"><?php echo form_error('pedido_numero');?></span>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="pedido_archivo" class="control-label">Archivo</label>
						<div class="form-group">
                                                    <input type="file" name="pedido_archivo" value="<?php echo $this->input->post('pedido_archivo'); ?>" class="form-control" id="pedido_archivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_imagen" class="control-label">Imagen</label>
						<div class="form-group">
                                                        <input type="file" name="pedido_imagen" value="<?php echo $this->input->post('pedido_imagen'); ?>" class="form-control" id="pedido_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fechapedido" class="control-label"><span class="text-danger">(*)</span>Fecha Pedido</label>
						<div class="form-group">
							<input type="date" name="pedido_fechapedido" value="<?php echo ($this->input->post('pedido_fechapedido') ? $this->input->post('pedido_fechapedido') : date("Y-m-d") ); ?>" class="form-control" id="pedido_fecha" required />
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
									$selected = ($unidad['unidad_id'] == $this->input->post('unidad_id')) ? ' selected="selected"' : "";

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
									$selected = ($programa['programa_id'] == $this->input->post('programa_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>                            
                            
                            
                            
				        <!--<div class="col-md-6">
						<label for="pedido_hora" class="control-label">Pedido Hora</label>
						<div class="form-group">
							<input type="text" name="pedido_hora" value="<?php //echo $this->input->post('pedido_hora'); ?>" class="form-control" id="pedido_hora" />
						</div>
					</div>
					
					
					<div class="col-md-6">
						<label for="pedido_fechapedido" class="control-label">Pedido Fechapedido</label>
						<div class="form-group">
							<input type="text" name="pedido_fechapedido" value="<?php //echo $this->input->post('pedido_fechapedido'); ?>" class="has-datepicker form-control" id="pedido_fechapedido" />
						</div>
					</div>
                                        -->
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