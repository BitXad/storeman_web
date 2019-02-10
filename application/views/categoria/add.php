<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Categoria Add</h3>
            </div>
            <?php echo form_open('categoria/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoria_nombre" class="control-label">Categoria Nombre</label>
						<div class="form-group">
							<input type="text" name="categoria_nombre" value="<?php echo $this->input->post('categoria_nombre'); ?>" class="form-control" id="categoria_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoria_descripcion" class="control-label">Categoria Descripcion</label>
						<div class="form-group">
							<input type="text" name="categoria_descripcion" value="<?php echo $this->input->post('categoria_descripcion'); ?>" class="form-control" id="categoria_descripcion" />
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