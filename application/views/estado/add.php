<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Estado Add</h3>
            </div>
            <?php echo form_open('estado/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_descripcion" class="control-label">Estado Descripcion</label>
						<div class="form-group">
							<input type="text" name="estado_descripcion" value="<?php echo $this->input->post('estado_descripcion'); ?>" class="form-control" id="estado_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_tipo" class="control-label">Estado Tipo</label>
						<div class="form-group">
							<input type="text" name="estado_tipo" value="<?php echo $this->input->post('estado_tipo'); ?>" class="form-control" id="estado_tipo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_color" class="control-label">Estado Color</label>
						<div class="form-group">
							<input type="text" name="estado_color" value="<?php echo $this->input->post('estado_color'); ?>" class="form-control" id="estado_color" />
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