<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/tablarepo.css'); ?>" rel="stylesheet">
<script type="text/javascript">
    function imprimir(){
    window.print();
}
</script>
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


@media print{
    @page {
  size: legal;
}
   div.saltopagina{
      display:block;
      page-break-before:always;
   }
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
                <u>INGRESO A ALMACEN</u><br><BR>
              <font size="2">   GESTION <?php echo $gestion['gestion_nombre']; ?></font><br>
             <font size="1"> <?php echo date('d/m/Y H:i:s'); ?></font>  
                
            </div>
              
        </div>
        <div id="cabderecha">
            <font size="1"> Pg. 1</font>  <br>
            <?php if ($datos[0]['ingreso_numdoc']>0){ ?>
                <b style="font-size: 15px;">No.: <?php echo $datos[0]['ingreso_numdoc']; ?></b><br>
            <?php }else{ ?>
                <b style="font-size: 15px;">INV.INIC.</b><br>                
            <?php } ?>
                
                <?php if ($datos[0]['estado']==2) {  ?>
                 <b style="font-size: 15px;"> ANULADO</b>
                <?php } ?>
                
     <a onclick="imprimir()" class="btn btn-warning no-print" title="Imprimir Ingresos"><span class="fa fa-print"></span><br><small>Imprimir</small></a>
        </div>

    
</div>

<div style="font-size: 12px;width: 100%;padding-left:6%;padding-top: 16px; font-family: 'Arial', Arial, Arial, arial; ">
<b>MATERIALES CON CARGO A: </b><?php echo $datos[0]['programa_nombre']; ?><br>
        <?php if ($datos[0]['ingreso_numdoc']>0){ ?>
            <b> DE: </b><?php foreach($pedidos as $pe) { echo $pe['unidad_nombre'];  ?> <b>|</b> <?php } ?><BR>
            <b >FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['ingreso_fecha_ing'])); ?><br>
            <b >NUMEROS DE FACTURAS: </b><?php foreach($facturas as $fac) { echo $fac['factura_numero']; ?> | <?php } ?><br>
            <b >PEDIDO No.: </b><?php foreach($pedidos as $pe) { echo $pe['pedido_numero'];?> | <?php } ?>
        <?php }else{ ?>
            <b> DE: </b>INVENTARIO INICIAL<br>
            <b >FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['ingreso_fecha_ing'])); ?><br>
            <b >NUMEROS DE FACTURAS: </b>N/A<br>
            <b >PEDIDO No.: </b>N/A
        <?php } ?>
</div>
<div class="row">
<div class="box-body">
<table class="table table-striped" id="mitabla" style="width: 100%;">
                    <tr>
                        <th style="width: 3%;">ITEM</th>
                        <th style="width: 7%;">FACTURA</th>
                        <th style="width: 7%;">UNIDAD<BR>MANEJO</th>
                        <th style="width: 5%;">CANT.</th>
                        <th style="width: 50%;">DESCRIPCION</th>
                        <th style="width: 8%;">CODIGO</th>
                        <th style="width: 10%;">PRECIO<br>UNIT.</th>
                        <th style="width: 10%;">TOTAL</th>
                    </tr>
                    <?php  $i = 0;
                    foreach($detalle_ingreso as $d) { 
                       if ($i<35) {
                           
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
                <?php  } $i++; }
                if (sizeof($detalle_ingreso)<35) {
                    
                 ?>
                 <tr>
                    <td colspan="8"> DESEMBOLSO A FAVOR DE: <?php echo $datos[0]['responsable_nombre']; ?></td>   
                </tr>
                <tr>
                    <td colspan="8" style="text-align: right;"><b style="font-size: 10px;"><font size="2"><?php echo number_format($datos[0]['ingreso_total'],'2','.',','); ?></font><br>SON: <?php echo num_to_letras($datos[0]['ingreso_total']);?> <b></td>
                   
                </tr>
            <?php    } ?>
                </table>
</div>
</div>
<?php  
                if (sizeof($detalle_ingreso)>=35) {
                    
                 ?>
              <div class="saltopagina"></div><br>
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
                <u>INGRESO A ALMACEN</u><br><BR>
              <font size="2">   GESTION <?php echo $gestion['gestion_nombre']; ?></font><br>
             <font size="1"> <?php echo date('d/m/Y H:i:s'); ?></font>  
                
            </div>
              
        </div>
        <div id="cabderecha">
            <font size="1"> Pg. 2</font>  <br>
            <?php if ($datos[0]['ingreso_numdoc']>0){ ?>
                <b style="font-size: 15px;">No.: <?php echo $datos[0]['ingreso_numdoc']; ?></b><br>
            <?php }else{ ?>
                <b style="font-size: 15px;">INV.INIC.</b><br>                
            <?php } ?>
            
            
                <?php if ($datos[0]['estado']==2) {  ?>
                 <b style="font-size: 15px;"> ANULADO</b>
                <?php } ?>
                
     <a onclick="imprimir()" class="btn btn-warning no-print" title="Imprimir Ingresos"><span class="fa fa-print"></span><br><small>Imprimir</small></a>
        </div>

    
</div>

<div style="font-size: 10px;width: 100%;padding-left:6%;padding-top: 16px; font-family: 'Arial', Arial, Arial, arial; ">
<b>MATERIALES CON CARGO A: </b><?php echo $datos[0]['programa_nombre']; ?><br>

        <?php if ($datos[0]['ingreso_numdoc']>0){ ?>
            <b> DE: </b><?php foreach($pedidos as $pe) { echo $pe['unidad_nombre'];  ?> <b>|</b> <?php } ?><BR>
            <b >FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['ingreso_fecha_ing'])); ?><br>
            <b >NUMEROS DE FACTURAS: </b><?php foreach($facturas as $fac) { echo $fac['factura_numero']; ?> | <?php } ?><br>
            <b >PEDIDO No.: </b><?php foreach($pedidos as $pe) { echo $pe['pedido_numero'];?> | <?php } ?>
        <?php }else{ ?>
            <b> DE: </b>INVENTARIO INICIAL<br>
            <b >FECHA: </b><?php echo  date('d/m/Y',strtotime($datos[0]['ingreso_fecha_ing'])); ?><br>
            <b >NUMEROS DE FACTURAS: </b>N/A<br>
            <b >PEDIDO No.: </b>N/A
        <?php } ?>
</div>
<div class="row">
<div class="box-body">
<table class="table table-striped" id="mitabla" style="width: 100%;">
                    <tr>
                        <th style="width: 3%;">ITEM</th>
                        <th style="width: 7%;">FACTURA</th>
                        <th style="width: 7%;">UNIDAD<BR>MANEJO</th>
                        <th style="width: 5%;">CANT.</th>
                        <th style="width: 50%;">DESCRIPCION</th>
                        <th style="width: 8%;">CODIGO</th>
                        <th style="width: 10%;">PRECIO<br>UNIT.</th>
                        <th style="width: 10%;">TOTAL</th>
                    </tr>
                <?php  $i1 = 0;
                    foreach($detalle_ingreso as $d) { 
                       if ($i1>=35) {
                           
                        ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i1+1; ?></td>
                        <td style="text-align: center;"><?php echo $d['factura_numero']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_unidad']; ?></td>
                        <td style="text-align: center;"><?php echo $d['detalleing_cantidad']; ?></td>
                        <td><?php echo $d['articulo_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $d['articulo_codigo']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detalleing_precio'],'2','.',','); ?></td>
                        <td style="text-align: right;"><?php echo number_format($d['detalleing_total'],'2','.',','); ?></td>
                        
                    </tr>
                <?php  } $i1++;  } ?>
                <tr>
                    <td colspan="8"> DESEMBOLSO A FAVOR DE: <?php echo $datos[0]['responsable_nombre']; ?></td>   
                </tr>
                <tr>
                    <td colspan="8" style="text-align: right;"><b style="font-size: 10px;"><font size="2"><?php echo number_format($datos[0]['ingreso_total'],'2','.',','); ?></font><br>SON: <?php echo num_to_letras($datos[0]['ingreso_total']);?> <b></td>
                   
                </tr>
                </table>
</div>
</div>
<?php } ?>
<div class="row micontenedorep"  id="cabeceraprint" style="padding-top: 15%;">
    <div id="cabizquierda" style="font-size: 10px;">
        ..............................................................<BR>
        RESPONSABLE DE ALMACENES
        </div>
        <div id="cabcentro" style="font-size: 10px;">
            ..............................................................<BR>
        DIRECTOR FINANCIERO
        </div>
        <div id="cabderecha" style="font-size: 10px;">
           ..............................................................<BR>
        ALCALDE MUNICIPAL
        </div>

    
</div>