<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Categoría</h3>
            </div>
            <?php echo form_open('categoria/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoria_nombre" class="control-label"><span class="text-danger">(*)</span>Nombre(Programa)</label>
						<div class="form-group">
                                                    <input type="text" name="categoria_nombre" value="<?php echo $this->input->post('categoria_nombre'); ?>" class="form-control" id="categoria_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus />
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoria_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="categoria_descripcion" value="<?php echo $this->input->post('categoria_descripcion'); ?>" class="form-control" id="categoria_descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
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
<?php if($resultado == 1){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        var esnombre = $("#categoria_nombre").val();
        alert("La Categoria '"+esnombre+"' \n ya se encuentra REGISTRADO");
    });
</script>
<?php } ?>