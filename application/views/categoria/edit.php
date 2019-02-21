<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoría</h3>
            </div>
			<?php echo form_open('categoria/edit/'.$categoria['categoria_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoria_nombre" class="control-label">Nombre</label>
						<div class="form-group">
							<input type="text" name="categoria_nombre" value="<?php echo ($this->input->post('categoria_nombre') ? $this->input->post('categoria_nombre') : $categoria['categoria_nombre']); ?>" class="form-control" id="categoria_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoria_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="categoria_descripcion" value="<?php echo ($this->input->post('categoria_descripcion') ? $this->input->post('categoria_descripcion') : $categoria['categoria_descripcion']); ?>" class="form-control" id="categoria_descripcion" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<!--<option value="">- ESTADO -</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $categoria['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('categoria'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>