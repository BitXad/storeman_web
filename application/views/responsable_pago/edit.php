<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modificar Responsable</h3>
            </div>
			<?php echo form_open('responsable_pago/edit/'.$responsable['responsable_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="responsable_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre</label>
						<div class="form-group">
                                                    <input type="text" name="responsable_nombre" value="<?php echo ($this->input->post('responsable_nombre') ? $this->input->post('responsable_nombre') : $responsable['responsable_nombre']); ?>" class="form-control" id="responsable_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div><span class="text-danger"><?php echo form_error('responsable_nombre');?></span>
					</div>
					<div class="col-md-6">
						<label for="estado_id" class="control-label"><span class="text-danger">(*)</span>Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control" required>
								<!--<option value="">- ESTADO -</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $responsable['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('responsable_pago'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>