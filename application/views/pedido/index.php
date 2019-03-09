<script src="<?php echo base_url('resources/js/funciones_pedido.js'); ?>" type="text/javascript"></script>
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
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!--<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">-->

<!--<link href="<?php echo base_url('resources/css/print_reportes.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<!--<style type="text/css">
    #contieneimg{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>-->

<div class="row micontenedorep no-margin" id="cabeceraprint">
    
    <table class="table no-margin" style="width: 19cm;">
        <tr>
            <td style="width: 7cm;">
                    
                <center>
                    <p>                        
                    <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
                    <font size="1px" face="Arial narrow"><b><?php echo $institucion[0]['institucion_nombre']; ?></b></font>
                    <font size="1px" face="Arial narrow"><br><?php echo $institucion[0]['institucion_direccion']; ?></font>
                    <font size="1px" face="Arial narrow"><br><?php echo $institucion[0]['institucion_telef']; ?></font>                
                    </p>
                </center>
            </td>
            
            <td style="width: 5cm;">
                <center>
                    <p>
                        
                    <br>
                    <font size="3" face="Arial"><b><?php echo "PEDIDOS"; ?></b></font>
                    <font size="1" face="Arial"><br><?php echo date('Y/m/d'); ?></font>
                    
                    </p>
                </center>                
            </td>
            <td style="width: 7cm;">
                <p>
                    
                <font size="1" face="Arial">                
                    <br><b>FECHA: </b><?php echo date('Y-m-d'); ?>
                    <br><b>USUARIO: </b><?php echo "JUan Perez"; ?>
                </font>
                </p>
            </td>
        </tr>
</table>


</div>

<div class="box-header no-print">
    <h3 class="box-title">Pedido</h3>
</div>
<div class="row no-print">
    
    <!--------------------- parametro de buscador --------------------->
    <div class="col-md-9">
        <div class="col-md-8">
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingresar Num. Pedido" onkeypress="buscarpedido(event)" autocomplete="off" >
        </div>
        </div>
        <div class="col-md-4">
            <span class="badge btn-danger">Pedidos encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="col-md-12">-->
            <!--<div class="box-tools">-->
                <a href="<?php echo base_url('pedido/add/'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Pedido"><font size="5"><span class="fa fa-file-text"></span></font><br><small>Registrar</small></a>
                <a onclick="tablaresultadospedido(3)" class="btn btn-info btn-foursquarexs" title="Muestra Todos los Pedidos"><font size="5"><span class="fa fa-eye"></span></font><br><small>Ver Todo</small></a>
                <a onclick="imprimirpedido()" class="btn btn-warning btn-foursquarexs" title="Imprimir Pedidos"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <!--</div>-->
        <!--</div>-->
    </div>
    <!--------------------- fin parametro de buscador --------------------->
</div>
<div class="row no-print">
    <div class="col-md-2">
        <div class="box-tools">
            <select name="unidad_id" class="btn-primary btn-sm btn-block" id="unidad_id" onchange="tablaresultadospedido(2)">
                <option value="" disabled selected >-- UNIDAD --</option>
                <option value="0"> Todas las Unidades </option>
                <?php 
                foreach($all_unidad as $unidad)
                {
                    echo '<option value="'.$unidad['unidad_id'].'">'.$unidad['unidad_nombre'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box-tools">
            <select name=programa_id" class="btn-primary btn-sm btn-block" id="programa_id" onchange="tablaresultadospedido(2)">
                <option value="" disabled selected >-- PROGRAMA --</option>
                <option value="0"> Todos los Programas </option>
                <?php 
                foreach($all_programa as $programa)
                {
                    echo '<option value="'.$programa['programa_id'].'">'.$programa['programa_nombre'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="box-tools">
            <select name=estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadospedido(2)">
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

<div class="row no-print" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Unidad</th>
                        <th>Pedido</th>            
                        <th>Fecha</th>
                        <th class='no-print'>Archivo</th>
                        <th class='no-print'>Imagen</th>
                        <th>Gestión</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php
                       /* $i = 0;
                        foreach($pedido as $p){  $colorbaja = "";
                           
                                $colorbaja = "style='background-color:".$p['estado_color']."'";?>
                           
                    <tr <?php echo $colorbaja; ?>>
                        
                        <td <?php echo $colorbaja; ?>><?php echo $i+1; ?></td>
                        <td <?php echo $colorbaja; ?>>
                            <font size="3"><b><?php echo $p['unidad_nombre']; ?></b></font>
                            <br><?php echo $p['programa_nombre']; ?>
                        </td>
                        <td <?php echo $colorbaja; ?>> 
                            <center>                        
                                <font size="3"><b><?php echo $p['pedido_numero']; ?></b></font>
                                <br><?php echo date("d/m/Y", strtotime($p['pedido_fechapedido'])); ?>
                            </center>
                        </td>
                        
                        
                        <td <?php echo $colorbaja; ?>>
                            <center>                            
                            <?php echo date("d/m/Y", strtotime($p['pedido_fecha']))." <br> ".$p['pedido_hora']; ?>
                            </center>
                        </td>
                        <td <?php echo $colorbaja; ?>><?php echo $p['pedido_archivo']; ?></td>
                        <td <?php echo $colorbaja; ?>>
                            
                            <div id="contieneimg">
                                <?php
                                $mimagen = "thumb_".$p['pedido_imagen'];
                                if($p['pedido_imagen']){
                                ?>
                                <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $i; ?>" style="padding: 0px;">
                                    <?php
                                    echo '<img src="'.site_url('/resources/images/pedidos/imagenes/'.$mimagen).'" />';
                                    ?>
                                </a>
                                <?php }
                                
                                ?>
                            </div>
                            
                        </td>
                        
                        <td style="background-color: <?php echo $p['estado_color']; ?>">
                            <center>
                                <?php echo $p['gestion_nombre']; ?><br>
                                <?php echo $p['estado_descripcion']; ?>

                            </center>
                        </td>
                        <td>
                            <a href="<?php echo site_url('pedido/edit/'.$p['pedido_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a>
                            <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
                                       ¿Desea eliminar el Pedido <b> <?php echo $p['pedido_numero']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('pedido/remove/'.$p['pedido_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $p['pedido_numero']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/pedidos/imagenes/'.$p['pedido_imagen']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                        </td>
                    </tr>
                    <?php $i++; } */ ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
