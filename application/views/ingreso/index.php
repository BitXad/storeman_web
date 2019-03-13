<script src="<?php echo base_url('resources/js/ingreso_index.js'); ?>" type="text/javascript"></script>
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
<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<div class="box-header no-print">
    <h3 class="box-title">Ingreso</h3>
    
</div>
<div class="row micontenedorep" style="display: none" id="cabeceraprint">
    <div id="cabizquierda">
        <?php
        echo $institucion[0]['institucion_nombre']."<br>";
        echo $institucion[0]['institucion_direccion']."<br>";
        echo $institucion[0]['institucion_telef'];
        ?>
        </div>
        <div id="cabcentro">
            <div id="titulo">
                <u>INGRESOS</u><br><br>
                <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
                <span class="lahora" id="fhimpresion"></span><br>
                <span style="font-size: 8pt;" id="busquedacategoria"></span>
                <!--<span style="font-size: 8pt;">PRECIOS EXPRESADOS EN MONEDA BOLIVIANA (Bs.)</span>-->
            </div>
        </div>
        <div id="cabderecha">
            <?php
            /*
            $mimagen = "thumb_".$institucion[0]['institucion_logo'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
            */
            ?>

        </div>
        
</div><br>
<div class="row no-print">
    
    <!--------------------- parametro de buscador --------------------->
    <div class="col-md-9">
        <div class="col-md-8">
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingresar No. pedido, No. Documento" onkeypress="buscarnumero(event)" autocomplete="off" >
        </div>
        </div>
        <div class="col-md-4">
            <span class="badge btn-danger">Ingresos encontrados: <span class="badge btn-primary"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="col-md-12">-->
            <!--<div class="box-tools">-->
                <a href="<?php echo base_url('ingreso/crear/'); ?>" class="btn btn-success btn-foursquarexs" title="Registrar nuevo Ingreso"><font size="5"><span class="fa fa-file-text"></span></font><br><small>Registrar</small></a>
                <a onclick="tablaresultadosingreso(1)" class="btn btn-info btn-foursquarexs" title="Muestra Todos los Pedidos"><font size="5"><span class="fa fa-eye"></span></font><br><small>Ver Todo</small></a>
                <a onclick="imprimiringreso()" class="btn btn-warning btn-foursquarexs" title="Imprimir Ingresos"><font size="5"><span class="fa fa-print"></span></font><br><small>Imprimir</small></a>
            <!--</div>-->
        <!--</div>-->
    </div>
    <!--------------------- fin parametro de buscador --------------------->
</div>
<div class="row no-print">
    <div class="col-md-2">
        <div class="box-tools">
            <select name="unidad_id" class="btn-primary btn-sm btn-block" id="unidad_id" onchange="tablaresultadosingreso(2)">
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
            <select name=programa_id" class="btn-primary btn-sm btn-block" id="programa_id" onchange="tablaresultadosingreso(2)">
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
            <select name=estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadosingreso(2)">
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
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>UNIDAD/PROGRAMA</th>
                        <th>No. ING</th>
                        <th>No. DOC</th>
                        <th>PROVEEDOR</th> 
                        <th>TOTAL</th> 
                        <th>ESTADO</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <!--<?php
                        $i = 0;
                        foreach($ingreso as $in){ ?>
                   
                  
                        <td>
                            
                            
                              <a href="<?php echo site_url('ingreso/edit/'.$in['ingreso_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a>
                            
                             <a href="<?php echo site_url('ingreso/pdf/'.$in['ingreso_id']); ?>" target="_blank" class="btn btn-success btn-xs" title="IMPRIMIR"><span class="fa fa-print"></span></a>-->
                            <!--<a data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                           <!-- <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">--->
                                  <!---------------------------------------------------------
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea eliminar el Ingreso <b> <?php echo $in['ingreso_numdoc']; ?></b>?---------->
                                   </h3>
                                   <!----------------------------------------------------------
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('ingreso/remove/'.$in['ingreso_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>--------->
                                  </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                   <!-- <?php $i++; } ?> -->
                </table>
                                
            </div>
        </div>
    </div>
</div>
