<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modificar: Unidad de Manejo</h3>
            </div>
			<?php echo form_open('unidad_manejo/edit/'.$unidad_manejo['umanejo_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="umanejo_descripcion" class="control-label"><span class="text-danger">(*)</span>Descripción</label>
						<div class="form-group">
                                                    <input type="text" name="umanejo_descripcion" value="<?php echo ($this->input->post('umanejo_descripcion') ? $this->input->post('umanejo_descripcion') : $unidad_manejo['umanejo_descripcion']); ?>" class="form-control" id="umanejo_descripcion" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_id" class="control-label"><span class="text-danger">(*)</span>Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control" required>
								<!--<option value="">- ESTADO -</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $unidad_manejo['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('unidad_manejo'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>