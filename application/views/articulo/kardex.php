
<!--<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
    });
</script>-->
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/inventario.js'); ?>"></script> 

<style type="text/css">


p {
    font-family: Arial;
    font-size: 7pt;
    line-height: 120%;   /*esta es la propiedad para el interlineado*/
    /*color: #000;*/
    padding: 10px;
}

div {
margin-top: 1px;
margin-right: 1px;
margin-bottom: 1px;
margin-left: 10px;
margin: 1px;
}


table{
width : 17cm;
margin : 1 1 1px 1;
padding : 1 1 1 1;
border-spacing : 0 0;
border-collapse : collapse;
font-family: Arial narrow;
font-size: 7pt;  
}
td {
    border:hidden;

}

td#comentario {
vertical-align : bottom;
border-spacing : 1;
}

</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<!-------------------------------------------------------->
<div class="row micontenedorep" id="cabeceraprint">
    <div id="cabizquierda">
        <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
        <?php
        echo $institucion[0]['institucion_nombre']."<br>";
        echo $institucion[0]['institucion_direccion']."<br>";
        echo $institucion[0]['institucion_telef'];
        ?>
    </div>
    <div id="cabcentro">
        <div id="titulo">
            <u>KARDEX DE EXISTENCIA</u><br><BR>
            <font size="1" face="arial"><b>FISICO - VALORADO</b> <br>
                <?php echo date('d/m/Y H:i:s'); ?></font><BR><BR>
            <!--<span style="font-size: 9pt">INGRESOS DIARIOS</span><br>-->
            <font size="2" face="arial"><b>ACTIVIDAD/PROGRAMA: <?php echo $articulo[0]['programa_nombre']; ?></b></font><br>
            <font size="2" face="arial"><b>ARTICULO: <?php echo $articulo[0]['articulo_nombre']; ?></b></font><br>
            <font size="1" face="arial"><b>DESDE: <?php echo date('d/m/Y',strtotime($fecha_ini)); ?> HASTA: <?php echo date('d/m/Y',strtotime($fecha_fin)); ?></b></font>
        </div>
    </div>
    <div id="cabderecha">
        <p>
            <br>
            <font size="1" face="Arial">
            <br><b>GESTION: </b><?php echo date('Y'); ?>
            <br><b>CODIGO: </b><?php echo $articulo[0]['articulo_codigo']; ?>
            <br><b>UNIDAD: </b><?php echo $articulo[0]['articulo_unidad']; ?>
            
            </font>
        </p>
    </div>
</div>



<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<!--<form method="post" onclick="ventas_por_fecha()">-->
<!--<div class="panel panel-primary col-md-12 no-print" id='buscador_oculto'    >
    <br>
    <center>            
         <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        
       <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            Usuario:             
            <select  class="btn btn-warning btn-sm form-control" id="usuario_id">
                    <option value="0">-- TODOS --</option>
                <?php foreach($usuario as $us){?>
                    <option value="<?php echo $us['usuario_id']; ?>"><?php echo $us['usuario_nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <br>
        <div class="col-md-3">

            <button class="btn btn-sm btn-facebook btn-sm btn-block"  onclick="mostrar_kardex(<?php echo $articulo_id;?>)">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
          </button>
            <br>
        </div>
        
    </center>    
    <br>    
</div>-->
<!--</form>-->
<!------------------------------------------------------------------------------------------->



<!--<div class="box-body table-responsive">-->
    <!--<table class="table table-condensed" id="mitabla" style="font-size:10px" style="width: 17cm;">-->
<div class="container  table-responsive" >
    

    <table class="table table-responsive" id="mitabla" style="font-size:10px" style="width: 18cm;" >
    <tr style="font-family: Arial narrow">
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
    <tr style="font-family: Arial narrow">
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
         $saldo += $ar['unidad_comp'] - $ar['unidad_vend'];
                    $total_compras += $ar['unidad_comp'];
                    $total_ventas += $ar['unidad_vend'];
                    $total_precioventas += $ar['preciov_unit'];?>
                    <?php if ($ar['fecha'] >= $fecha_ini) { ?>
    <tr>
        
            
        
        <td align="center"><?php echo date('d/m/Y',strtotime($ar['fecha'])); ?></td>
        <td align="center"><?php echo $ar["num_ingreso"]; ?></td>
        <td align="right"><?php echo number_format($ar["unidad_comp"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["precioc_unit"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["importe_ingreso"], 2, ".", ","); ?></td>
        <td align="center"><?php echo $ar["num_salida"]; ?></td>
        <td align="right"><?php echo number_format($ar["unidad_vend"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["preciov_unit"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($ar["importe_salida"], 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format($saldo, 2, ".", ","); ?></td>
        <td align="right"><?php echo number_format(($saldo*$ar["precioc_unit"])+($saldo*$ar["preciov_unit"]), 2, ".", ","); ?></td>
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
</div>
<!--</div>-->

