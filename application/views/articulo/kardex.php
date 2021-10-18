
<script type="text/javascript">
    $(document).ready(function()
    {
        //window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
    
    function actualizar_sitio(){
      window.location.reload();
      //alert(window.location);
      return true;
    }
</script>
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php //echo base_url('resources/js/inventario.js'); ?>"></script>--> 
<!----------------------------- fin script buscador --------------------------------------->
<style type="text/css">
    @media print {
    #mitabla th {
        background-color: rgba(127,127,127,0.5) !important;
        color: black !important;
        -webkit-print-color-adjust: exact;
    }
}

</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<!-------------------------------------------------------->
<div class="row micontenedorep" id="cabeceraprint" style="padding-left: 15px;">
    <div id="cabizquierda">
        <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
        <div style="line-height: 12px;">
        <font size="1" face="Arial">
        <?php
        echo $institucion[0]['institucion_nombre']."<br>";
        echo $institucion[0]['institucion_direccion']."<br>";
        echo $institucion[0]['institucion_telef'];
        ?>
        </font>
        </div>
    </div>
    <div id="cabcentro" style="padding-left: 30px;">
        <div id="titulo">
            <u>KARDEX DE EXISTENCIA</u><br>
            <font size="1" face="Arial"><b>FISICO - VALORADO</b> <br>
            <b>DESDE: </b><?php echo date('d/m/Y',strtotime($fecha_ini)); ?><b> HASTA: </b><?php echo date('d/m/Y',strtotime($fecha_fin)); ?></font>
        </div>
        
        <div style="line-height: 12px; text-align: left;">
            <font size="1" face="Arial"><b>ACTIVIDAD/PROGRAMA:</b> <?php echo $articulo[0]['programa_nombre']; ?></font><br>
            <font size="1" face="Arial"><b>ARTICULO:</b> <?php echo $articulo[0]['articulo_nombre']; ?></font><br>
        </div>
    </div>
    <div id="cabderecha">
        <p>
            <font size="1" face="Arial">
            <br><b>GESTION: </b><?php echo $gestion_nombre; ?>
            <br><b>CODIGO: </b><?php echo $articulo[0]['articulo_codigo']; ?>
            <br><b>UNIDAD: </b><?php echo $articulo[0]['articulo_unidad']; ?>
            
            </font>
        </p>
    </div>
</div>


<!--<div class="box-body table-responsive">-->
    <!--<table class="table table-condensed" id="mitabla" style="font-size:10px" style="width: 17cm;">-->

    

    <table class="table table-condensed" id="mitabla"   >
    <tr>
        <th rowspan="2" style="font-size:9px">
            FECHA
        </th>
        <th colspan="4" style="font-size:9px">
            ENTRADAS
        </th>
        <th colspan="4" style="font-size:9px">
            SALIDAS 
        </th>
        <th colspan="2" style="font-size:9px">
           SALDOS   
        </th>
        <th rowspan="2" style="font-size:9px">
             OBSERV.                       
        </th>


    </tr>
    <tr>
        <th style="font-size:9px">
            Nº<br>INGRESO              
        </th>
        <th style="font-size:9px">
            CANTIDAD<br>ADQ.
        </th>
        <th style="font-size:9px">
            PRECIO<br>UNIT.                            
        </th>
        <th style="font-size:9px">
            IMPORTE<br>TOTAL Bs
        </th>
        <th style="font-size:9px">
            Nº<br>SALIDA
        </th>
        <th style="font-size:9px">
            CANTIDAD                      
        </th>
        <th style="font-size:9px">
            PRECIO<br>UNIT.                            
        </th>
        <th style="font-size:9px">
            IMPORTE<br>TOTAL Bs                            
        </th>
        <th style="font-size:9px">
            CANTIDAD               
        </th>
        <th style="font-size:9px">
            PRECIO<br>TOTAL Bs
        </th>


    </tr>
   <?php
   $saldo = 0;
   $total_compras = 0;
   $total_ventas = 0;
   $total_precioventas = 0;
   $saldo_total = 0;
   
   $cantidad_total = 0;
   
   $precio_total = 0;
   
     foreach($kardex as $ar){ 
         
        if ($ar['cantidad_ingreso']>0) 
                $saldo_total += ($ar['saldo'] * $ar['precio_ingreso']);
         
        $saldo += $ar['cantidad_ingreso'] - $ar['cantidad_salida'];
                    $total_compras += $ar['cantidad_ingreso'];
                    $total_ventas += $ar['cantidad_salida'];
                    $total_precioventas += $ar['total_salida'];?>
                    <?php if ($ar['fecha'] >= $fecha_ini) {  ?>
        <tr>
        
            <td align="center"><?php echo date('d/m/Y',strtotime($ar['fecha'])); ?></td>
            <td align="center"><?php     
                    if($ar["numero_ingreso"]>=0){
                        
//                        if($ar["numero_ingreso"]>20000){ echo 'INV. INIC.'; }else{ echo $ar["numero_ingreso"]; }                         
                        //if($ar["numero_ingreso"]==0){ echo 'INV. INIC.'; }else{ echo $ar["numero_ingreso"]; } 
                        
                        if($ar["numero_ingreso"]>20000){ echo 'INV. INIC.'; }else{
                        
                            if($ar["numero_ingreso"]<=0){ echo ''; }else{
                                echo $ar["numero_ingreso"]; 
                            }
                            
                        } 
                        
                    }?>
            </td>
            
            <td align="right"> 
                    <?php 
                        if($ar["cantidad_ingreso"]){
                            
                            if ($ar["cantidad_ingreso"] % 1 == 0){
                                echo number_format($ar["cantidad_ingreso"], 0, ".", ",");
                            }else{
                                echo number_format($ar["cantidad_ingreso"], 2, ".", ",");    
                            }
                            
                        }
                    ?>
                
                    <?php if ($ar["cantidad_ingreso"]>0){ ?>    
                        <sub class="no-print">[<?php echo $ar["detalleing_id"]; ?>]</sub>
                    <?php } ?>    
            </td>
            
            <td align="right">
                    
                    <?php 
                        if($ar["precio_ingreso"]>0){
                            echo number_format($ar["precio_ingreso"], 2, ".", ","); 
                        }
                    ?>
            
            </td>
            
            
            <td align="right">
                <?php 
                    if($ar["total_ingreso"]>0){
                        echo number_format($ar["total_ingreso"], 2, ".", ",");
                    }
                ?>
            
            </td>
            
            
            <td align="center">
                <?php                 
                    if($ar["numero_salida"]>0){
                        echo $ar["numero_salida"]; 
                    }                    
                ?>
                
                        
            </td>
            
            <td align="right">
                <?php
                
                if($ar["cantidad_salida"]>0){
                
                    if($ar["cantidad_salida"] % 1 == 0){
                        echo number_format($ar["cantidad_salida"], 0, ".", ","); 
                    }else{
                        echo number_format($ar["cantidad_salida"], 2, ".", ",");                         
                    }
                    
                
                     
                }
                
                ?>
                
                <?php if ($ar["cantidad_salida"]>0){ ?>    
                    <sub class="no-print">[<?php echo $ar["detalleing_id"]; ?>]</sub>
                <?php } ?>   
            </td>
            
            <td align="right"><?php 
                if($ar["precio_salida"]>0){
                    echo number_format($ar["precio_salida"], 2, ".", ","); 
                }
                    
            ?></td>
            
            <td align="right"><?php 
                if($ar["total_salida"]>0){         
                        echo number_format($ar["total_salida"], 2, ".", ","); 
                }
            ?></td>
            
<!--            <td align="right"><?php echo number_format($saldo, 2, ".", ","); ?></td>  TOTALES ORIGINALES
            <td align="right"><?php echo number_format(($saldo*$ar["precio_ingreso"])+($saldo*$ar["precio_salida"]), 2, ".", ","); ?></td>-->


            <?php $precio_total += ($ar["total_ingreso"] - $ar["total_salida"]); ?> 
            
            <td align="right"><?php echo number_format($saldo, 2, ".", ","); ?></td>            
            <td align="right"><?php echo number_format($precio_total, 2, ".", ","); ?></td>
            
            <td><?php echo $ar["unidad_nombre"]; /* aqui  debemos poner quien sacaa y listo */?></td>
            
            <td class="no-print"> 
                
                <!--<td align="right"><?php echo number_format($saldo, 2, ".", ","); ?></td>-->
                <?php if ($ar["cantidad_ingreso"]>0){ ?>
                        <a href="<?php echo base_url("ingreso/editar/".$ar["operacion_id"]);  ?>" class="btn btn-warning btn-xs" target="_BLANK"> <fa class="fa fa-pencil"></fa> ingreso</a> 
                        <a href="<?php echo base_url("detalle_ingreso/edit/".$ar["detalle_id"]);  ?>" class="btn btn-facebook btn-xs" target="_BLANK"> <fa class="fa fa-edit"></fa> </a> 
                <?php }else{ ?>
                        <a href="<?php echo base_url("salida/modificar_salida/".$ar["operacion_id"]);  ?>" class="btn btn-info btn-xs" target="_BLANK"> <fa class="fa fa-pencil"></fa> salida</a> 
                        <a href="<?php echo base_url("detalle_salida/edit/".$ar["detalle_id"]);  ?>" class="btn btn-facebook btn-xs" target="_BLANK"> <fa class="fa fa-edit"></fa> </a> 
                <?php } ?>
           
            </td>
        </tr>
    <?php } } ?>
    <tr>
    
        <th>SUMAS</th>
        <th></th>
        <th><?php echo number_format($total_compras, 2, ".", ","); ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th align="right" style="text-align: right;"><?php echo number_format($total_ventas, 2, ".", ","); ?></th>
        <th></th>
        <th align="right" style="text-align: right;"><?php echo number_format($total_precioventas, 2, ".", ","); ?></th>
        <th><?php echo number_format($total_compras - $total_ventas, 2, ".", ","); ?></th>
        <th><?php echo number_format($precio_total, 2, ".", ","); ?></th>
        <th></th>
        <!--<th colspan="2"></th>-->
    </tr>
    <tr style="padding: 0;" >
        <td style="padding: 0; border: 0; " colspan="12">Impreso el: <?php echo date('d/m/Y H:i:s'); ?>
        </td>
    </tr>
</table>

<div class="no-print">
    <button class="btn btn-facebook btn-sx" onclick="actualizar_sitio()"><fa class="fa fa-refresh"></fa> Actualizar</button>
</div>
<!--</div>-->

