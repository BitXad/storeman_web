<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Pedido Add</h3>
            </div>
            <?php echo form_open('pedido/add'); ?>
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
						<label for="gestion_id" class="control-label">Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control">
								<option value="">select gestion</option>
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $this->input->post('gestion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fecha" class="control-label">Pedido Fecha</label>
						<div class="form-group">
							<input type="text" name="pedido_fecha" value="<?php echo $this->input->post('pedido_fecha'); ?>" class="has-datepicker form-control" id="pedido_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_hora" class="control-label">Pedido Hora</label>
						<div class="form-group">
							<input type="text" name="pedido_hora" value="<?php echo $this->input->post('pedido_hora'); ?>" class="form-control" id="pedido_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_archivo" class="control-label">Pedido Archivo</label>
						<div class="form-group">
							<input type="text" name="pedido_archivo" value="<?php echo $this->input->post('pedido_archivo'); ?>" class="form-control" id="pedido_archivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_imagen" class="control-label">Pedido Imagen</label>
						<div class="form-group">
							<input type="text" name="pedido_imagen" value="<?php echo $this->input->post('pedido_imagen'); ?>" class="form-control" id="pedido_imagen" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_numero" class="control-label">Pedido Numero</label>
						<div class="form-group">
							<input type="text" name="pedido_numero" value="<?php echo $this->input->post('pedido_numero'); ?>" class="form-control" id="pedido_numero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fechapedido" class="control-label">Pedido Fechapedido</label>
						<div class="form-group">
							<input type="text" name="pedido_fechapedido" value="<?php echo $this->input->post('pedido_fechapedido'); ?>" class="has-datepicker form-control" id="pedido_fechapedido" />
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