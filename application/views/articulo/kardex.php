
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
</script>
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<!-------------------------------------------------------->
<div class="row micontenedorep" id="cabeceraprint" style="padding-left: 15px;">
    <div id="cabizquierda">
        <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
        <font size="1" face="Arial">
        <?php
        echo $institucion[0]['institucion_nombre']."<br>";
        echo $institucion[0]['institucion_direccion']."<br>";
        echo $institucion[0]['institucion_telef'];
        ?>
        </font>
    </div>
    <div id="cabcentro" style="padding-left: 30px;">
        <div id="titulo">
            <u>KARDEX DE EXISTENCIA</u><br>
            <font size="1" face="Arial"><b>FISICO - VALORADO</b> <br>
                <?php echo date('d/m/Y H:i:s'); ?></font><br><br>
        </div>
        <div style="line-height: 14px;">
            <font size="2" face="Arial"><b>ACTIVIDAD/PROGRAMA:</b> <?php echo $articulo[0]['programa_nombre']; ?></font><br>
            <font size="2" face="Arial"><b>ARTICULO:</b> <?php echo $articulo[0]['articulo_nombre']; ?></font><br>
            <font size="1" face="Arial"><b>DESDE: </b><?php echo date('d/m/Y',strtotime($fecha_ini)); ?><b> HASTA: </b><?php echo date('d/m/Y',strtotime($fecha_fin)); ?></font>
        </div>
    </div>
    <div id="cabderecha">
        <p>
            <font size="1" face="Arial">
            <br><b>GESTION: </b><?php echo date('Y'); ?>
            <br><b>CODIGO: </b><?php echo $articulo[0]['articulo_codigo']; ?>
            <br><b>UNIDAD: </b><?php echo $articulo[0]['articulo_unidad']; ?>
            
            </font>
        </p>
    </div>
</div>


<!--<div class="box-body table-responsive">-->
    <!--<table class="table table-condensed" id="mitabla" style="font-size:10px" style="width: 17cm;">-->

    

    <table class="table table-condensed" id="mitabla"   >
    <tr style="font-family: Arial">
        <th rowspan="2">
            FECHA
        </th>
        <th colspan="4">
            ENTRADAS
        </th>
        <th colspan="4">
            SALIDAS 
        </th>
        <th colspan="2">
           SALDOS   
        </th>
        <th rowspan="2">
             OBSERV.                       
        </th>


    </tr>
    <tr style="font-family: Arial">
        <th>
            Nº<br>INGRESO              
        </th>
        <th>
            UNIDAD<br>ADQ.
        </th>
        <th>
            COSTO<br>UNIT.                            
        </th>
        <th>
            IMPORTE<br>Bs.
        </th>
        <th>
            Nº PED<br>VALE                            
        </th>
        <th>
            UNIDAD                            
        </th>
        <th>
            COSTO<br>UNIT.                            
        </th>
        <th>
            IMPORTE<br>Bs.                            
        </th>
        <th>
            UNIDs.                            
        </th>
        <th>
            SALDO<br>Bs.
        </th>


    </tr>
   <?php
   $saldo = 0;
   $total_compras = 0;
   $total_ventas = 0;
   $total_precioventas = 0;
     foreach($kardex as $ar){ 
         $saldo += $ar['cantidad_ingreso'] - $ar['cantidad_salida'];
                    $total_compras += $ar['cantidad_ingreso'];
                    $total_ventas += $ar['cantidad_salida'];
                    $total_precioventas += $ar['total_salida'];?>
                    <?php if ($ar['fecha'] >= $fecha_ini) { ?>
    <tr>
        
            
        
        <td align="center"><?php echo date('d/m/Y',strtotime($ar['fecha'])); ?></td>
        <td align="center"><?php echo $ar["numero_ingreso"]; ?></td>
        <td align="right"><?php echo number_format($ar["cantidad_ingreso"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["precio_ingreso"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["total_ingreso"], 2, ".", ","); ?></td>
        <td align="center"><?php echo $ar["numero_salida"]; ?></td>
        <td align="right"><?php echo number_format($ar["cantidad_salida"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["precio_salida"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["total_salida"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($saldo, 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format(($saldo*$ar["precio_ingreso"])+($saldo*$ar["precio_salida"]), 2, ".", ","); ?></td>
        <td></td>
    </tr>
    <?php } } ?>
    <tr>
        <td colspan="5"></td>
        <td><font size="2"><b>SUMAS</b></font></td>
        <td align="right"><font size="2"><b><?php echo number_format($total_ventas, 2, ".", ","); ?></b></font></td>
        <td></td>
        <td align="right"><font size="2"><b><?php echo number_format($total_precioventas, 2, ".", ","); ?></b></font></td>
        <td colspan="3"></td>
    </tr>
</table>
<!--</div>-->

