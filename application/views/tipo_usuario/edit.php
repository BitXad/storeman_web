<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tipo Usuario Edit</h3>
            </div>
			<?php echo form_open('tipo_usuario/edit/'.$tipo_usuario['tipousuario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="tipousuario_descripcion" class="control-label">Tipousuario Descripcion</label>
						<div class="form-group">
							<input type="text" name="tipousuario_descripcion" value="<?php echo ($this->input->post('tipousuario_descripcion') ? $this->input->post('tipousuario_descripcion') : $tipo_usuario['tipousuario_descripcion']); ?>" class="form-control" id="tipousuario_descripcion" />
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