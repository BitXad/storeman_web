<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Unidad Edit</h3>
            </div>
			<?php echo form_open('unidad/edit/'.$unidad['unidad_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="unidad_nombre" class="control-label">Unidad Nombre</label>
						<div class="form-group">
							<input type="text" name="unidad_nombre" value="<?php echo ($this->input->post('unidad_nombre') ? $this->input->post('unidad_nombre') : $unidad['unidad_nombre']); ?>" class="form-control" id="unidad_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_codigo" class="control-label">Unidad Codigo</label>
						<div class="form-group">
							<input type="text" name="unidad_codigo" value="<?php echo ($this->input->post('unidad_codigo') ? $this->input->post('unidad_codigo') : $unidad['unidad_codigo']); ?>" class="form-control" id="unidad_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_descripcion" class="control-label">Unidad Descripcion</label>
						<div class="form-group">
							<input type="text" name="unidad_descripcion" value="<?php echo ($this->input->post('unidad_descripcion') ? $this->input->post('unidad_descripcion') : $unidad['unidad_descripcion']); ?>" class="form-control" id="unidad_descripcion" />
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