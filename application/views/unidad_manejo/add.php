<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Unidad de Manejo</h3>
            </div>
            <?php echo form_open('unidad_manejo/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                            <div class="col-md-6">
                                <label for="umanejo_descripcion" class="control-label"><span class="text-danger">(*)</span>Descripción</label>
                                <div class="form-group">
                                    <input type="text" name="umanejo_descripcion" value="<?php echo $this->input->post('umanejo_descripcion'); ?>" class="form-control" id="umanejo_descripcion" required onKeyUp="this.value = this.value.toUpperCase();" autofocus />
                                    <span class="text-danger"><?php echo form_error('umanejo_descripcion');?></span>
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