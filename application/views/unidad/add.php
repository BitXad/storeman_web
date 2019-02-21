<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Unidad Add</h3>
            </div>
            <?php echo form_open('unidad/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="unidad_nombre" class="control-label">Unidad Nombre</label>
						<div class="form-group">
							<input type="text" name="unidad_nombre" value="<?php echo $this->input->post('unidad_nombre'); ?>" class="form-control" id="unidad_nombre" />
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
							<input type="text" name="unidad_descripcion" value="<?php echo $this->input->post('unidad_descripcion'); ?>" class="form-control" id="unidad_descripcion" />
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