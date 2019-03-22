<script src="<?php echo base_url('resources/js/pedido_nuevo.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrarp').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscarp tr').hide();
                    $('.buscarp tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Pedido</h3>
            </div>
            <?php echo form_open_multipart('pedido/add') ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                                <label for="pedido_numero" class="control-label"><span class="text-danger">(*)</span>Número</label>
                                <div class="form-group">
                                        <input type="text" name="pedido_numero" value="<?php echo $this->input->post('pedido_numero'); ?>" class="form-control" id="pedido_numero" requirede />
                                        <span class="text-danger"><?php echo form_error('pedido_numero');?></span>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="pedido_archivo" class="control-label">Archivo</label>
                                <div class="form-group">
                                    <input type="file" name="pedido_archivo" value="<?php echo $this->input->post('pedido_archivo'); ?>" class="form-control" id="pedido_archivo" />
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="pedido_imagen" class="control-label">Imagen</label>
                                <div class="form-group">
                                        <input type="file" name="pedido_imagen" value="<?php echo $this->input->post('pedido_imagen'); ?>" class="form-control" id="pedido_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="pedido_fechapedido" class="control-label"><span class="text-danger">(*)</span>Fecha Pedido</label>
                                <div class="form-group">
                                        <input type="date" name="pedido_fechapedido" value="<?php echo ($this->input->post('pedido_fechapedido') ? $this->input->post('pedido_fechapedido') : date("Y-m-d") ); ?>" class="form-control" id="pedido_fecha" required />
                                </div>
                        </div>
                        <div class="col-md-6">
                            <label for="unidad_id" class="control-label"><span class="text-danger">(*)</span>Unidad</label>
                            <div class="input-group">   
                                <input type="text" class="form-control" name="unidad_nombre" id="unidad_nombre" readonly required>
                                <a style="background: #1295bf" class="btn btn-soundcloud input-group-addon" data-toggle="modal" data-target="#modalbuscarunidad">Buscar</a>
                                <span class="text-danger"><?php echo form_error('unidad_nombre');?></span>
                                <input type="hidden" class="form-control" name="unidad_id" id="unidad_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="programa_id" class="control-label">Programa</label>
                            <div class="input-group">   
                                <input type="text" class="form-control" name="programa_nombre" id="programa_nombre" readonly>
                                <a style="background: #1295bf" class="btn btn-soundcloud input-group-addon" data-toggle="modal" data-target="#modalbuscarprograma">Buscar</a>
                                <input type="hidden" class="form-control" name="programa_id" id="programa_id">
                            </div>
                        </div>
                    </div>
                </div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('pedido'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>

<!-- ---------------------- Inicio modal para buscar UNIDAD ----------------- -->
    <div class="modal fade" id="modalbuscarunidad" tabindex="-1" role="dialog" aria-labelledby="modalbuscarunidadLabel">
      <div class="modal-dialog" role="document">
            <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <label>Buscar Unidad:</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
            <!-- --------------------------------------------------------------- -->
               <!--este es INICIO de input buscador-->
                            <div class="input-group">
                                <span class="input-group-addon"> 
                                    Buscar 
                                </span>           
                                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre" onkeypress="buscarconenter(event, 1)">
                            </div>
                            <!--este es FIN de input buscador-->
                            <div class="container" id="categoria">
                                <span class="badge btn-danger">Unidades encontradas: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                            </div>
                            <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-condensed table-striped" id="mitabla" >
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                            <tbody class="buscar" id="tablaresultados">
                                <!-- va a este lugar despues de generarse con el buscador  -->
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
           <!-- --------------------------------------------------------------- -->
          </div>
        </div>
      </div>
    </div>
<!-- ---------------------- Fin modal para buscar UNIDAD ----------------- -->
<!-- ---------------------- Inicio modal para buscar PROGRAMA ----------------- -->
    <div class="modal fade" id="modalbuscarprograma" tabindex="-1" role="dialog" aria-labelledby="modalbuscarprogramaLabel">
      <div class="modal-dialog" role="document">
            <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <label>Buscar Programa:</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
            <!-- --------------------------------------------------------------- -->
               <!--este es INICIO de input buscador-->
                            <div class="input-group">
                                <span class="input-group-addon"> 
                                    Buscar 
                                </span>           
                                <input id="filtrarp" type="text" class="form-control" placeholder="Ingrese el nombre" onkeypress="buscarconenter(event, 2)">
                            </div>
                            <!--este es FIN de input buscador-->
                            <div class="container" id="categoria">
                                <span class="badge btn-danger">Programas encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontradosp" type="text"  size="5" value="0" readonly="true"> </span></span>
                            </div>
                            <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-condensed table-striped" id="mitabla" >
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                            <tbody class="buscarp" id="tablaresultadosp">
                                <!-- va a este lugar despues de generarse con el buscador  -->
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
           <!-- --------------------------------------------------------------- -->
          </div>
        </div>
      </div>
    </div>
<!-- ---------------------- Fin modal para buscar PROGRAMA ----------------- -->