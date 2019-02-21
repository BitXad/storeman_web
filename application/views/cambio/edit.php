<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Cambio</h3>
            </div>
			<?php echo form_open('cambio/edit/'.$cambio['cambio_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cambio_ufv" class="control-label"><span class="text-danger">*</span>Ufv</label>
						<div class="form-group">
							<input type="text" name="cambio_ufv" value="<?php echo ($this->input->post('cambio_ufv') ? $this->input->post('cambio_ufv') : $cambio['cambio_ufv']); ?>" class="form-control" id="cambio_ufv" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cambio_fecha" class="control-label"><span class="text-danger">*</span>Fecha</label>
						<div class="form-group">
                                                    <input type="date" name="cambio_fecha" value="<?php echo ($this->input->post('cambio_fecha') ? $this->input->post('cambio_fecha') : $cambio['cambio_fecha']); ?>" class="form-control" id="cambio_fecha" required />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="gestion_id" class="control-label"><span class="text-danger">*</span>Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control" required>
								<!--<option value="">select gestion</option>-->
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $cambio['gestion_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
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
                <a href="<?php echo site_url('cambio'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>