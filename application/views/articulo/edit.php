<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modificar: Artículo</h3>
            </div>
                    <?php echo form_open('articulo/edit/'.$articulo['articulo_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="articulo_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre(Artículo)</label>
						<div class="form-group">
							<input type="text" name="articulo_nombre" value="<?php echo ($this->input->post('articulo_nombre') ? $this->input->post('articulo_nombre') : $articulo['articulo_nombre']); ?>" class="form-control" id="articulo_nombre" required onKeyUp="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_marca" class="control-label">Marca</label>
						<div class="form-group">
							<input type="text" name="articulo_marca" value="<?php echo ($this->input->post('articulo_marca') ? $this->input->post('articulo_marca') : $articulo['articulo_marca']); ?>" class="form-control" id="articulo_marca" onKeyUp="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_industria" class="control-label">Industria</label>
						<div class="form-group">
							<input type="text" name="articulo_industria" value="<?php echo ($this->input->post('articulo_industria') ? $this->input->post('articulo_industria') : $articulo['articulo_industria']); ?>" class="form-control" id="articulo_industria" onKeyUp="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_codigo" class="control-label">Codigo</label>
						<div class="form-group">
							<input type="text" name="articulo_codigo" value="<?php echo ($this->input->post('articulo_codigo') ? $this->input->post('articulo_codigo') : $articulo['articulo_codigo']); ?>" class="form-control" id="articulo_codigo" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="articulo_precio" class="control-label">Precio</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="articulo_precio" value="<?php echo ($this->input->post('articulo_precio') ? $this->input->post('articulo_precio') : $articulo['articulo_precio']); ?>" class="form-control" id="articulo_precio" onclick="this.select();" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_saldo" class="control-label">Saldo</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="articulo_saldo" value="<?php echo ($this->input->post('articulo_saldo') ? $this->input->post('articulo_saldo') : $articulo['articulo_saldo']); ?>" class="form-control" id="articulo_saldo" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="categoria_id" class="control-label"><span class="text-danger">(*)</span>Categoria</label>
						<div class="form-group">
							<select name="categoria_id" class="form-control" required>
								<!--<option value="">select categoria</option>-->
								<?php 
								foreach($all_categoria as $categoria)
								{
									$selected = ($categoria['categoria_id'] == $articulo['categoria_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria['categoria_id'].'" '.$selected.'>'.$categoria['categoria_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="articulo_unidad" class="control-label"><span class="text-danger">(*)</span>Unidad de Manejo</label>
						<div class="form-group">
                                                    <select name="articulo_unidad" class="form-control" id="articulo_unidad" required>
								<!--<option value="">select categoria</option>-->
								<?php 
								foreach($all_unidadmanejo as $unidadmanejo)
								{
									$selected = ($unidadmanejo['umanejo_descripcion'] == $articulo['articulo_unidad']) ? ' selected="selected"' : "";

									echo '<option value="'.$unidadmanejo['umanejo_descripcion'].'" '.$selected.'>'.$unidadmanejo['umanejo_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<!--<option value="">select estado</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $articulo['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('articulo'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>