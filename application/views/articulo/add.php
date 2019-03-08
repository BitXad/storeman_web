<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Artículo</h3>
            </div>
            <?php echo form_open('articulo/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="articulo_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre(Artículo)</label>
						<div class="form-group">
                                                    <input type="text" name="articulo_nombre" value="<?php echo $this->input->post('articulo_nombre'); ?>" class="form-control" id="articulo_nombre" required onKeyUp="this.value = this.value.toUpperCase();" autofocus />
                                                        <span class="text-danger"><?php echo form_error('articulo_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_marca" class="control-label">Marca</label>
						<div class="form-group">
							<input type="text" name="articulo_marca" value="<?php echo $this->input->post('articulo_marca'); ?>" class="form-control" id="articulo_marca" onKeyUp="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_industria" class="control-label">Industria</label>
						<div class="form-group">
							<input type="text" name="articulo_industria" value="<?php echo $this->input->post('articulo_industria'); ?>" class="form-control" id="articulo_industria" onKeyUp="this.value = this.value.toUpperCase();" />
						</div>
					</div>
					<!--<div class="col-md-6">
						<label for="articulo_codigo" class="control-label">Código</label>
						<div class="form-group">
							<input type="text" name="articulo_codigo" value="<?php //echo $this->input->post('articulo_codigo'); ?>" class="form-control" id="articulo_codigo" />
						</div>
					</div> -->
					<div class="col-md-6">
						<label for="articulo_saldo" class="control-label">Saldo</label>
						<div class="form-group">
                                                        <input type="number" step="any" min="0" name="articulo_saldo" value="<?php if($this->input->post('articulo_saldo') >0){ echo $this->input->post('articulo_saldo'); }else{ echo "0";} ?>" class="form-control" id="articulo_saldo" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="categoria_id" class="control-label"><span class="text-danger">(*)</span>Categoría</label>
						<div class="form-group">
                                                    <select name="categoria_id" class="form-control" required>
								<option value="">- CATEGORÍA -</option>
								<?php 
								foreach($all_categoria as $categoria)
								{
									$selected = ($categoria['categoria_id'] == $this->input->post('categoria_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria['categoria_id'].'" '.$selected.'>'.$categoria['categoria_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="umanejo_id" class="control-label"><span class="text-danger">(*)</span>Unidad de Manejo</label>
						<div class="form-group">
                                                    <select name="umanejo_id" class="form-control" required>
								<option value="">- UNIDAD DE MANEJO -</option>
								<?php 
								foreach($all_unidadmanejo as $unidadmanejo)
								{
									$selected = ($unidadmanejo['umanejo_id'] == $this->input->post('umanejo_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$unidadmanejo['umanejo_id'].'" '.$selected.'>'.$unidadmanejo['umanejo_descripcion'].'</option>';
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
<?php if($resultado == 1){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        var esnombre = $("#articulo_nombre").val();
        alert("El Articulo '"+esnombre+"' \n ya se encuentra REGISTRADO");
    });
</script>
<?php } ?>