<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Nivel Jerárquico</h3>
            </div>
            <?php echo form_open('jerarquia/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                            <div class="col-md-6">
                                <label for="jerarquia_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre</label>
                                <div class="form-group">
                                    <input type="text" name="jerarquia_nombre" value="<?php echo $this->input->post('jerarquia_nombre'); ?>" class="form-control" id="jerarquia_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus />
                                    <span class="text-danger"><?php echo form_error('jerarquia_nombre');?></span>
                                </div>
                            </div>
                        </div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('jerarquia'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>