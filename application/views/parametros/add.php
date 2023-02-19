<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametros</h3>
            </div>
            <?php echo form_open_multipart('parametros/add'); ?>
            <div class="box-body" style="margin-top: 0px;margin-bottom: 0px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
                <div class="col-md-4">
                    <label for="parametro_decimaleskardex" class="control-label"> # DECIMALES EN KARDEX</label>
                    <div class="form-group">
                        <input type="number" min="0" name="parametro_decimaleskardex" value="<?php echo ($this->input->post('parametro_decimaleskardex') ? $this->input->post('parametro_decimaleskardex') : 0); ?>" class="form-control" id="parametro_decimaleskardex" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="parametro_decimalesoperaciones" class="control-label"> # DECIMALES EN OPERACIONES</label>
                    <div class="form-group">
                        <input type="number" min="0" name="parametro_decimalesoperaciones" value="<?php echo ($this->input->post('parametro_decimalesoperaciones') ? $this->input->post('parametro_decimalesoperaciones') : 0); ?>" class="form-control" id="parametro_decimalesoperaciones" />
                    </div>
                </div>
                <!--<div class="col-md-4">
                    <label for="parametro_tamanio" class="control-label"> TAMAÑO</label>
                    <div class="form-group">
                        <input type="number" min="0" readonly name="parametro_tamanio" value="<?php echo ($this->input->post('parametro_tamanio') ? $this->input->post('parametro_tamanio') : 0); ?>" class="form-control" id="parametro_tamanio" />
                    </div>
                </div>-->
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('parametros'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>