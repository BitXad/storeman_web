<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/tablarepo.css'); ?>" rel="stylesheet">
<style type="text/css">
     img{
        width: 60px;
        height: 60px;
        margin-right: 5px;
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
</style>

<div class="row micontenedorep"  id="cabeceraprint">
    <div id="cabizquierda" style="font-size: 8px;padding-bottom: 0px;">
        <div id="horizontal">
        <?php

        $mimagen = $institucion['institucion_logo'];
        echo '<img  src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        echo $institucion['institucion_nombre']."<br>";
        echo $institucion['institucion_direccion']."<br>";
        echo $institucion['institucion_telef'];
        ?>
    </div>
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            <div id="titulo">
                <u>INGRESO A ALMACEN</u><br><br>
             <font size="1"> <?php echo date('d/m/Y H:i:s'); ?></font>  
                
            </div>
              
        </div>
        <div id="cabderecha">
            <b style="font-size: 15px;">No.: <?php echo $datos[0]['ingreso_numdoc']; ?></b><br>
       
     
        </div>

    
</div>

<div style="font-size: 9px;width: 80%;padding-left:20%;padding-top: 4px; font-family: 'Arial', Arial, Arial, arial; ">
<b>MATERIALES CON CARGO A: </b><?php echo $datos[0]['programa_nombre']; ?><br>
            <b> DE: </b><?php foreach($pedidos as $pe) { echo $pe['programa_nombre'];  ?> <b>|</b> <?php } ?><BR>
 <b >FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['ingreso_fecha_ing'])); ?><br>
        <b >FECHA DE FACTURA: </b><?php foreach($facturas as $fac) { echo  date('d/m/Y',strtotime($fac['factura_fecha'])); ?> | <?php } ?><br>
        <b >PEDIDO No.: </b><?php foreach($pedidos as $pe) { echo $pe['pedido_numero'];?> | <?php } ?>
</div>
<div class="row">
<div class="box-body">
<table class="table table-striped" id="mitabla">
                    <tr>
                        <th>ITEM</th>
                        <th>FACTURA</th>
                        <th>UNIDAD<BR>MANEJO</th>
                        <th>CANT.</th>
                        <th>DESCRIPCION</th>
                        <th>CODIGO</th>
                        <th>PRECIO<br>UNIT.</th>
                        <th>TOTAL</th>
                    </tr>
                    <?php  $i = 0;
                    foreach($detalle_ingreso as $d) { 
                        ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i+1; ?></td>
                        <td style="text-align: center;"><?php echo $d['factura_numero']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_unidad']; ?></td>
                        <td style="text-align: center;"><?php echo $d['detalleing_cantidad']; ?></td>
                        <td><?php echo $d['articulo_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_codigo']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detalleing_precio'],'2','.',','); ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detalleing_total'],'2','.',','); ?></td>
                        
                    </tr>
                <?php $i++;  } ?>
                <tr>
                    <td colspan="8"> DESEMBOLSO A FAVOR DE: <?php echo $datos[0]['responsable_nombre']; ?></td>   
                </tr>
                <tr>
                    <td colspan="8" style="text-align: right;"><b style="font-size: 10px;"><font size="2"><?php echo number_format($datos[0]['ingreso_total'],'2','.',','); ?></font><br>SON: <?php echo num_to_letras($datos[0]['ingreso_total']);?> <b></td>
                   
                </tr>
                    </table>
</div></div>
<div class="row micontenedorep"  id="cabeceraprint" style="padding-top: 5%;">
    <div id="cabizquierda" style="font-size: 10px;">
        ..............................................................<BR>
        RESPONSABLE DE ALMACENES
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            ..............................................................<BR>
        DIRECTOR ADM. FINANCIERO
        </div>
        <div id="cabderecha" style="font-size: 10px;">
           ..............................................................<BR>
        H. ALCALDE MUNICIPAL
        </div>

    
</div>