<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/tablarepo.css'); ?>" rel="stylesheet">
<input type="text" id="decimales" value="<?php echo $parametros["parametro_decimalesoperaciones"]; ?>" hidden/>
<?php $decimales = $parametros["parametro_decimalesoperaciones"]; ?>

<?php
    $margen_izquierdo = 1;
    $margen_derecho = 1;
    $margen_superior = 1;
    $margen_inferior = 0;
    $ancho_pagina = 19;

    $color_fondo = "background-color: #B7B7B7 !important; color: black !important; -webkit-print-color-adjust: exact;";
?>

<div class="" style="margin-top: <?php echo $margen_superior; ?>cm; margin-left: <?php echo $margen_izquierdo; ?>cm; margin-right: <?php echo $margen_derecho; ?>cm; margin-bottom: <?php echo $margen_inferior; ?>cm; max-width: <?php echo $ancho_pagina; ?>cm;">
    
<div class="row micontenedorep"  id="cabeceraprint">
        <div id="cabizquierda" style="font-size: 7px;">
            <?php

            $mimagen = $institucion['institucion_logo'];
            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" width="50" height="50"/><br>';

            echo $institucion['institucion_nombre']."<br>";
            echo $institucion['institucion_direccion']."<br>";
            echo $institucion['institucion_telef'];
            ?>
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            
            <div id="titulo">
                <u>SALIDA DE ALMACEN</u><br>
             <font size="1"> <?php echo date('d/m/Y H:i:s'); ?></font>  
                
            </div>
            
            <div style="text-align: left;">
                <b style="font-size: 10px;">MATERIALES CON CARGO A: </b><?php echo $datos[0]['programa_nombre']; ?><br>
                <b style="font-size: 10px;"> DE: </b><?php echo $datos[0]['unidad_nombre']; ?>
            </div>
             
        </div>
    
        <div id="cabderecha" style="font-size: 10px;">
            <b style="font-size: 15px;">No.: <?php echo $datos[0]['salida_doc']; ?></b><br>
         <!--<b style="font-size: 10px;">FECHA DE SALIDA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['salida_fecha'])); ?><br>-->
         <?php if ($datos[0]['estado_id']==5) {  ?>
                 <b style="font-size: 15px;"> ANULADO</b><br>
                <?php } ?>
        <b style="font-size: 10px;">FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['salida_fechasal'])); ?><br>
        
        </div>

    
</div>


<div class="row">
<div class="box-body">
<table class="table table-striped" id="mitabla" >
                    <tr>
                        <th style="<?php echo $color_fondo; ?>">ITEM</th>
                        <th style="<?php echo $color_fondo; ?>">UNIDAD<BR>MANEJO</th>
                        <th style="<?php echo $color_fondo; ?>">CANT.</th>
                        <th style="<?php echo $color_fondo; ?>">DESCRIPCIÓN</th>
                        <th style="<?php echo $color_fondo; ?>">CÓDIGO</th>                        
                        <th style="<?php echo $color_fondo; ?>">PRECIO</th>
                        <th style="<?php echo $color_fondo; ?>">TOTAL</th>
                    </tr>
                    <?php  $i = 0;
                            $total = 0;
                    foreach($detalle_salida as $d) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i+1; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_unidad']; ?></td>
                        <td style="text-align: center;"><?php echo number_format($d['detallesal_cantidad'],$decimales,'.',',');  ?></td>
                        <td><?php echo $d['articulo_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_codigo']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detallesal_total']/$d['detallesal_cantidad'],$decimales,'.',','); ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detallesal_total'],$decimales,'.',','); ?></td>
                        
                        
                    </tr>
                <?php $i++; 
                      $total += $d['detallesal_total'];              
                    } ?>
               
                <tr>
                    <td colspan="7" style="text-align: right; <?php echo $color_fondo; ?>"><b style="font-size: 10px;"><font size="2"><?php echo number_format($datos[0]['salida_total'],$decimales,'.',','); ?></font><br>SON:<?php echo num_to_letras($datos[0]['salida_total']);?> <b></td>
                   
                </tr>
                    </table>
                    <?php if ( number_format($total,$decimales) <> number_format($datos[0]['salida_total'],$decimales))
                            {  
                                echo "<font style='color: red;'><b> EXISTE UN ERROR ENTRE EL DETALLE Y LA SUMATORIA FINAL. VERIFIQUE LA SALIDA POR FAVOR </b></font>"; 
                                echo "<br><font style='color: red;'><b> SUMATORIA FINAL: ".number_format($total,$decimales)."</b></font>"; 
                                echo "<br><font style='color: red;'><b> TOTAL FINAL: ".number_format($datos[0]['salida_total'],$decimales)."</b></font>"; 
                                echo "<br><a href='".$base_url."/salida/modificar_salida/".$datos[0]['salida_id']."' class='btn btn-info btn-xs' target='_blank'><fa class='fa fa-edit'></fa> Modificar Salida </a>"; 
                                
                            }
                            
                    ?>
</div></div>
    <br>
<div class="row micontenedorep"  id="cabeceraprint">
    <div id="cabizquierda" style="font-size: 10px;">
        ..............................................................<br>
        RESPONSABLE DE ALMACENES
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            ..............................................................<br>
        DIRECTOR ADM. FINANCIERO
        </div>
        <div id="cabderecha" style="font-size: 10px;">
           ..............................................................<br>
        H. ALCALDE MUNICIPAL
        </div>

    
</div>
    
</div>