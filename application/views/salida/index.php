<script src="<?php echo base_url('resources/js/salida.js'); ?>" type="text/javascript"></script>
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
<!-------------------------------------------------------->
<div class="row micontenedorep no-margin" id="cabeceraprint" style="display:none">
    
    <table class="table no-margin" style="width: 19cm;">
        <tr>
            <td style="width: 7cm;">
                    
                <center>
                    <p>                        
                    <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
                    <font size="1px" face="Arial narrow"><b><?php echo $institucion[0]['institucion_nombre']; ?></b></font>
                    <br><font size="1px" face="Arial narrow"><?php echo $institucion[0]['institucion_direccion']; ?></font>
                    <br><font size="1px" face="Arial narrow"><?php echo $institucion[0]['institucion_telef']; ?></font>                
                    </p>
                </center>
            </td>
            
            <td style="width: 5cm;">
                <center>
                    <p>
                        
                    <br>
                    <font size="3" face="Arial"><b><?php echo "SALIDAS"; ?></b></font>
                    <font size="1" face="Arial"><br><?php echo date('d/m/Y H:n:s'); ?></font>
                    
                    </p>
                </center>                
            </td>
            <td style="width: 7cm;">
                <p>
                    <br>
                    <font size="1" face="Arial">
                    <br><b>FECHA: </b><?php echo date('d/m/Y'); ?>
                    <br><b>USUARIO: </b><?php echo $usuario_nombre; ?>
                    </font>
                </p>
            </td>
        </tr>
</table>
</div>

<!--------------------------------------------------------------------->

<div class="box-header no-print">
    <h3 class="box-title">Salida</h3>
</div>
<div class="row no-print">
    
    <!--------------------- parametro de buscador --------------------->
    <div class="col-md-9">
        <div class="col-md-8">
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingresar Num. Salida" onkeypress="buscarpedido(event)" autocomplete="off" >
        </div>
        </div>
        <div class="col-md-4">
            <span class="badge btn-danger">Salidas encontradas: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="col-md-12">-->
            <!--<div class="box-tools">-->
                <a href="<?php echo base_url('salida/registrar_salida/'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nueva salida"><font size="5"><span class="fa fa-file-text"></span></font><br><small>Salidas</small></a>
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
    <div class="col-md-2">
            <div class="box-tools">                    
                <select  class="btn-primary btn-sm btn-block" id="select_ventas" onclick="buscar_ventas()">
        <!--                        <option value="1">-- SELECCIONE UNA OPCION --</option>-->
                    <option value="1">Salidas de Hoy</option>
                    <option value="2">Salidas de Ayer</option>
                    <option value="3">Salidas de la semana</option>
                    <option value="4">Todos las salidas</option>
                        <option value="5">Salidas por fecha</option>
                </select>
<!--                <button class="btn btn-warning btn-sm" onclick="verificar_ventas()"><span class="fa fa-binoculars"></span> Verificar </button>
                <a href="<?php echo site_url('venta/ventas'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Ventas</a>-->
            </div>
    </div>
    
    
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<form method="post" onclick="ventas_por_fecha()">
<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto' style='display:block;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
<!--        <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>-->
<!--        
        <div class="col-md-2">
            Usuario:             
            <select  class="btn btn-warning btn-sm form-control" id="usuario_id">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>-->
        
        <br>
        <div class="col-md-3">

            <button class="btn btn-sm btn-facebook btn-sm btn-block"  type="submit">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
          </button>
            <br>
        </div>
        
    </center>    
    <br>    
</div>
</form>
<!------------------------------------------------------------------------------------------->
    
    

</div>

<div class="row no-print" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>

<!------------------------------------------------------------------------>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Motivo</th>
                        <th>Doc.</th>
                        <th>Fecha</th>
                        <th>Gestión</th>
                        <th>Usuario</th>
                        <th>Acta</th>
                        <th>Obs.</th>
                        <th>Estado</th>
                        <th class="no-print"></th>
                    </tr>
                     <tbody class="buscar" id="tablaresultados">
                    <?php
                        $i = 0;
                        
                        foreach($salida as $s){ 
                        $color ="  style='background-color: ".$s['estado_color']."'"; ?>
                    <tr>
                        <td <?php echo $color;?>><?php echo $i+1; ?></td>
                        
                        <td <?php echo $color;?>><font size="3" face="Arial"><b><?php echo $s['unidad_nombre']; ?></b></font>
                            <sub> <?php echo "[".$s['unidad_id']."]"; ?> </sub>
                            <br><?php echo $s['programa_nombre']; ?><sub> <?php echo "[".$s['programa_id']."]"; ?> </sub>
                        </td>
                        
                        <td <?php echo $color;?>>
                            <center>
                            <font size="3" face="Arial"><b><?php echo $s['salida_doc']; ?></b></font>
                            <br><?php echo $s['salida_fechasal']; ?>                            
                            </center>
                        </td>
                        
                        <td <?php echo $color;?>>
                            <center>
                                <?php if($s['salida_fecha']>0){echo date("d/m/Y", strtotime($s['salida_fecha']));} ?><br><?php echo $s['salida_hora']; ?>
                            </center>
                            </td>
                        <td <?php echo $color;?>>
                            <center>
                                <font size="3" face="Arial"><b><?php echo $s['gestion_nombre']; ?></b></font>
                                <sub> <?php echo "[".$s['salida_id']."]"; ?> </sub>
                            </center>
                        </td>
                        
                        <td <?php echo $color;?>><center><img src="<?php echo base_url('resources/images/usuarios/'.$s['usuario_imagen']); ?>" width="40" height="40" class="img-circle no-print">
                            <br><?php echo $s['usuario_nombre']; ?></td> 
                        </td>
                       
                        <td <?php echo $color;?>><?php echo $s['salida_acta']; ?></td>
                        <td <?php echo $color;?>><?php echo $s['salida_obs']; ?></td>
                       
                        <td <?php echo $color;?>><?php echo $s['estado_descripcion']; ?></td>
                        <td class="no-print" <?php echo $color;?> >
                            <a href="<?php echo site_url('salida/pdf/'.$s['salida_id']); ?>" class="btn btn-success btn-xs" target="_blank" title="Imprimir"><span class="fa fa-print"></span></a> 
                            <a href="<?php echo site_url('salida/modificar_salida/'.$s['salida_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a> 
                            <a data-toggle="modal" data-target="#myModal<?php echo $s['salida_id']; ?>"  title="Anular salida" class="btn btn-danger btn-xs"><span class="fa fa-ban"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                            <div class="modal fade" id="myModal<?php echo $s['salida_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $s['salida_id']; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea anular la Salida Nº: <b> <?php echo $s['salida_doc']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('salida/anular_salida/'.$s['salida_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>


<!--

  <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  </head>

  <div class="container">
    <div class="row">
      <h2>Bootstrap-select example</h2>
      <p>This uses <a href="https://silviomoreto.github.io/bootstrap-select/">https://silviomoreto.github.io/bootstrap-select/</a></p>
      <hr />
    </div>

    <div class="row-fluid">
      <select class="selectpicker" data-show-subtext="true" data-live-search="true">
        <option data-subtext="Rep California">Tom Foolery</option>
        <option data-subtext="Sen California">Bill Gordon</option>
        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
        <option data-subtext="Rep Alabama">Mario Flores</option>
        <option data-subtext="Rep Alaska">Don Young</option>
        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
      </select>
      <span class="help-inline">With <code>data-show-subtext="true" data-live-search="true"</code>. Try searching for california</span>
    </div>
  </div>

  <script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('resources/js/bootstrap-select.min.js'); ?>"></script>-->
