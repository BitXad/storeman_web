<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/tablarepo.css'); ?>" rel="stylesheet">

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
        <div id="cabizquierda" style="font-size: 10px;">
        <?php

        $mimagen = "thumb_".$institucion['institucion_logo'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        echo $institucion['institucion_nombre']."<br>";
        echo $institucion['institucion_direccion']."<br>";
        echo $institucion['institucion_telef'];
        ?>
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            <div id="titulo">
                <u>SALIDA DE ALMACEN</u><br><br>
             <font size="1"> <?php echo date('d/m/Y H:i:s'); ?></font>  
                
            </div>
             <b style="font-size: 10px;">MATERIALES CON CARGO A: </b><?php echo $datos[0]['unidad_nombre']; ?><br>
               <b style="font-size: 10px;"> DE: </b><?php echo $datos[0]['programa_nombre']; ?>  
        </div>
        <div id="cabderecha" style="font-size: 10px;">
            <b style="font-size: 15px;">No.: <?php echo $datos[0]['salida_doc']; ?></b><br>
         <!--<b style="font-size: 10px;">FECHA DE SALIDA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['salida_fecha'])); ?><br>-->
        <b style="font-size: 10px;">FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['salida_fechasal'])); ?><br>
        
        </div>

    
</div>


<div class="row">
<div class="box-body">
<table class="table table-striped" id="mitabla" >
                    <tr>
                        <th style="<?php echo $color_fondo; ?>">ITEM</th>
                        <th style="<?php echo $color_fondo; ?>">DOC</th>
                        <th style="<?php echo $color_fondo; ?>">UNIDAD<BR>MANEJO</th>
                        <th style="<?php echo $color_fondo; ?>">CANT.</th>
                        <th style="<?php echo $color_fondo; ?>">DESCRIPCIÓN</th>
                        <th style="<?php echo $color_fondo; ?>">CÓDIGO</th>
                        <th style="<?php echo $color_fondo; ?>">TOTAL</th>
                    </tr>
                    <?php  $i = 0;
                    foreach($detalle_salida as $d) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i+1; ?></td>
                        <td style="text-align: center;"><?php echo $d['salida_id']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_unidad']; ?></td>
                        <td style="text-align: center;"><?php echo $d['detallesal_cantidad']; ?></td>
                        <td><?php echo $d['articulo_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_codigo']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detallesal_total'],'2','.',','); ?></td>
                        
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="7"> DESEMBOLSO A FAVOR DEL TITULAR DE LA FACTURA</td>   
                </tr>
                <tr>
                    <td colspan="7" style="text-align: right; <?php echo $color_fondo; ?>"><b style="font-size: 10px;"><font size="2"><?php echo number_format($datos[0]['salida_total'],'2','.',','); ?></font><br>SON:<?php echo num_to_letras($datos[0]['salida_total']);?> <b></td>
                   
                </tr>
                    </table>
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