<script src="<?php echo base_url('resources/js/funciones_articulo.js'); ?>" type="text/javascript"></script>
<!----------------------------- script buscador --------------------------------------->
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<div class="box-header">
    <h3 class="box-title">Artículos</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('articulo/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>

<div class="row">
    <!--------------------- parametro de buscador --------------------->
    <div class="col-md-8">
    <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingresar descripción, tipo" onkeypress="buscararticulo(event)" autocomplete="off" >
    </div>
    </div>
    <div class="col-md-4">
        <span class="badge btn-danger">Articulos encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
    </div>
    <!--------------------- fin parametro de buscador --------------------->
</div>
<div class="row">
    <div class="col-md-4">
        <div class="box-tools">
            <select name="categoria_id" class="btn-primary btn-sm btn-block" id="categoria_id" onchange="tablaresultadosarticulo(2)">
                <option value="" disabled selected >-- CATEGORIAS --</option>
                <option value="0"> Todas las Categorias </option>
                <?php 
                foreach($all_categoria as $categoria)
                {
                    echo '<option value="'.$categoria['categoria_id'].'">'.$categoria['categoria_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box-tools">
            <select name=umanejo_id" class="btn-primary btn-sm btn-block" id="umanejo_id" onchange="tablaresultadosarticulo(2)">
                <option value="" disabled selected >-- UNIDAD MANEJO --</option>
                <option value="0"> Todas las U. de Manejo </option>
                <?php 
                foreach($all_unidadmanejo as $unidadmanejo)
                {
                    echo '<option value="'.$unidadmanejo['umanejo_id'].'">'.$unidadmanejo['umanejo_descripcion'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="box-tools">
            <select name=estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadosarticulo(2)">
                <option value="" disabled selected >-- ESTADO --</option>
                <option value="0"> Todos los Estados </option>
                <?php 
                foreach($all_estado as $estado)
                {
                    echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>
</div>
<div class="row" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Industria</th>
                        <th>Código</th>
                        <th>Prec.</th>
                        <th>Saldo</th>
                        <th>Categoría</th>
                        <th>U. Manejo</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php
                      /*  $i = 0;
                        foreach($articulo as $a){
                            $colorbaja = "";
                            if($a['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$a['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $a['articulo_nombre']; ?></td>
                        <td><?php echo $a['articulo_marca']; ?></td>
                        <td><?php echo $a['articulo_industria']; ?></td>
                        <td><?php echo $a['articulo_codigo']; ?></td>
                        <td><?php echo $a['articulo_saldo']; ?></td>
                        <td><?php echo $a['categoria_nombre']; ?></td>
                        <td style="background-color: <?php echo $a['estado_color']; ?>"><?php echo $a['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('articulo/edit/'.$a['articulo_id']); ?>" class="btn btn-info btn-xs" title="Editar" ><span class="fa fa-pencil"></span></a> 
                            <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <a href="<?php echo site_url('articulo/inactivar/'.$a['articulo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                            <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea eliminar el Artículo <b> <?php echo $a['articulo_nombre']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('articulo/remove/'.$a['articulo_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; } */ ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
