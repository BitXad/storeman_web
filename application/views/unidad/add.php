<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Unidad</h3>
            </div>
            <?php echo form_open('unidad/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="unidad_nombre" class="control-label">Unidad Nombre</label>
						<div class="form-group">
							<input type="text" name="unidad_nombre" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $this->input->post('unidad_nombre'); ?>" class="form-control" id="unidad_nombre" required/>
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_codigo" class="control-label">Unidad Codigo</label>
						<div class="form-group">
							<input type="text" name="unidad_codigo" value="<?php echo $this->input->post('unidad_codigo'); ?>" class="form-control" id="unidad_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_descripcion" class="control-label">Unidad Descripcion</label>
						<div class="form-group">
							<input type="text" name="unidad_descripcion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $this->input->post('unidad_descripcion'); ?>" class="form-control" id="unidad_descripcion" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            		<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                     <a href="<?php echo site_url('unidad'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>