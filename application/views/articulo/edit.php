<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Articulo Edit</h3>
            </div>
			<?php echo form_open('articulo/edit/'.$articulo['articulo_id']); ?>
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
									$selected = ($estado['estado_id'] == $articulo['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoria_id" class="control-label">Categoria</label>
						<div class="form-group">
							<select name="categoria_id" class="form-control">
								<option value="">select categoria</option>
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
						<label for="articulo_nombre" class="control-label">Articulo Nombre</label>
						<div class="form-group">
							<input type="text" name="articulo_nombre" value="<?php echo ($this->input->post('articulo_nombre') ? $this->input->post('articulo_nombre') : $articulo['articulo_nombre']); ?>" class="form-control" id="articulo_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_marca" class="control-label">Articulo Marca</label>
						<div class="form-group">
							<input type="text" name="articulo_marca" value="<?php echo ($this->input->post('articulo_marca') ? $this->input->post('articulo_marca') : $articulo['articulo_marca']); ?>" class="form-control" id="articulo_marca" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_industria" class="control-label">Articulo Industria</label>
						<div class="form-group">
							<input type="text" name="articulo_industria" value="<?php echo ($this->input->post('articulo_industria') ? $this->input->post('articulo_industria') : $articulo['articulo_industria']); ?>" class="form-control" id="articulo_industria" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_codigo" class="control-label">Articulo Codigo</label>
						<div class="form-group">
							<input type="text" name="articulo_codigo" value="<?php echo ($this->input->post('articulo_codigo') ? $this->input->post('articulo_codigo') : $articulo['articulo_codigo']); ?>" class="form-control" id="articulo_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_saldo" class="control-label">Articulo Saldo</label>
						<div class="form-group">
							<input type="text" name="articulo_saldo" value="<?php echo ($this->input->post('articulo_saldo') ? $this->input->post('articulo_saldo') : $articulo['articulo_saldo']); ?>" class="form-control" id="articulo_saldo" />
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