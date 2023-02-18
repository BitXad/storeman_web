<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/saldo_articulo.js'); ?>"></script>

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera_print.css'); ?>" rel="stylesheet">
<input type="text" id="decimales" value="<?php echo $parametros["parametro_decimalesoperaciones"]; ?>" hidden/>
<?php $decimales = $parametros["parametro_decimalesoperaciones"]; ?>

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#elarticulo').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>  

<script type="text/javascript">
    function imprimir(){
        var estafh = new Date();
        $('#fechaimpresion').html(formatohora(estafh));
        window.print();
    }
    /*aumenta un cero a un digito; es para las horas*/
    function aumentar_cero(num){
        if (num < 10) {
            num = "0" + num;
        }
        return num;
    }
    /* recibe Date y devuelve en formato dd/mm/YYYY hh:mm:ss ampm */
    function formatohora(string){
        var mifh = new Date(string);
        var info = "";
        var am_pm = mifh.getHours() >= 12 ? "p.m." : "a.m.";
        var hours = mifh.getHours() > 12 ? mifh.getHours() - 12 : mifh.getHours();
        if(string != null){
           info = aumentar_cero(mifh.getDate())+"/"+aumentar_cero((mifh.getMonth()+1))+"/"+mifh.getFullYear()+" "+aumentar_cero(hours)+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds())+" "+am_pm;
       }
        return info;
    }
</script>
<style type="text/css">
    .estdline {
        border-bottom: 1px solid #ddd;
    }
    @media print {
        #mitabla th {
            background-color: rgba(127,127,127,0.5) !important;
            color: black !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $gestion_inicio; ?>" id="gestion_inicio" hidden>
<input type="text" value="<?php echo $gestion_id; ?>" id="gestion_id" hidden>

<div class="row" style="width: 21.59cm; font-family: Arial !important">
    <center class="no-print"><h4 style="font-family: Arial;"><b>SALDOS POR ARTICULOS</b></h4></center>
<div class="row micontenedorep" id="cabeceraprint">
    <div id="cabizquierda" style="width: 250px; font-size: 8px">
        <img src="<?php echo base_url('resources/images/empresas/').$institucion[0]['institucion_logo']; ?>" width="80" height="60"><br>
        <?php
        echo $institucion[0]['institucion_nombre']."<br>";
        echo $institucion[0]['institucion_direccion']."<br>";
        echo $institucion[0]['institucion_telef'];
        ?>
    </div>
    <div id="cabcentro">
        <div id="titulo" style="line-height: 20px !important">
            <br><br>
            <u id="elprograma"></u><br>
            <span style="font-size: 11px"><b> <span id="lafecha"></span></b></span><br>
        </div>
    </div>
    
    <div id="cabderecha">
        <div style="font-size: 10px">
            <br>
            <br>
            <br><b>GESTION: </b><span class="text-red text-bold"><?php echo $gestion_nombre; ?></span>
                <br><b>CODIGO: </b><span id="elcodigo"></span>
                <br><span id="elmantenimiento"></span>
        </div>
    </div>
    
</div>
    
<div class="box-header" style="font-size: 10px">
    Impreso el <span id="fechaimpresion"></span>
</div>
<!--<div class="col-md-4 no-print">
    <label for="fecha_hasta" class="control-label">Hasta:</label>
     <input type="date" class="btn btn-danger btn-sm form-control" id="fecha_hasta" value="<?php //echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
</div>
<div class="col-md-4 no-print">
    <label><input type="radio" value="Sin mant. de valor" name="mantenimiento" id="mantenimineto" checked><span style="font-weight: normal">Sin mantenimiento de valor</span></label>
    <br><label><input type="radio" value="Con mant. de valor" name="mantenimiento" id="mantenimineto"><span style="font-weight: normal">Con mantenimiento de valor</span></label>
</div>-->
    
                
<div class="col-md-12 no-print">
    <label for="programa_id" class="control-label">Programa:</label>
    <div class="form-group">
        <select name="programa_id" id="programa_id" class="form-control" onselect="obtenercodigo()" style="font-size: 8pt;">
            <option value="">- PROGRAMA -</option>
            <?php 
            foreach($all_programa as $programa)
            {
                $selected = ($programa['programa_id'] == $this->input->post('programa_id')) ? ' selected="selected"' : "";

                echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
            } 
            ?>
        </select>
    </div>
</div>

<div class="col-md-12 no-print text-center ">
    <!--<form class="form-inline ml-3">-->
<!--      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="buscar" placeholder="Buscar" aria-label="Buscar">
        <div class="input-group-append">

            
        </div>
      </div>-->

             <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">Art&iacute;culo</span>           
                    <input name="articulo_nombre" id="articulo_nombre" type="text" class="form-control" placeholder="...." onkeypress="paramodalarticulo(event)" autocomplete="off" readonly >
                    <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="modalarticulo()" title="buscar art&iacute;culo"><span class="fa fa-search"></span></div>
                    <input type="hidden" name="articulo_id" id="articulo_id" class="form-control" >
                </div>
            </div>

    <!--</form>-->
</div>
    
<div class="col-md-12 no-print text-center">
    &nbsp;
    <center>
        
        <a class="btn btn-success btn-sm" onclick="tablares_progart()">
            <i class="fa fa-check"></i> Mostrar
        </a>
        <a class="btn btn-facebook btn-sm" onclick="imprimir()">
            <i class="fa fa-print"></i> Imprimir
        </a>
        <a href="<?php echo site_url('programa'); ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-times"></i> Salir
        </a>
    
    </center>    
</div>

    <div class="col-md-12">
        <div class="box">
            <!--------------------- inicio loader ------------------------->
            <div class="row" id='loader'  style='display:none;'>
                <center>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                </center>
            </div> 
            <!--------------------- fin inicio loader ------------------------->
            <div class="box-body  table-responsive">
                <div id="tablaresultados"  style="font-family: Arial; font-size: 16pt">
                <!-------------------- aqui se muestra la tabla de productos del inventario--------------------->
                </div>
                <div id="tablaresultados1"></div>
            </div>
            <br>
            <br>
            <div>
                <table class="box-body text-center" style="width: 19.59cm; font-size: 10px">
                    <tr>
                        <td style="width: 6.53cm">______________________________<br>RESPONSABLE DE ALMACENES</td>
                        <td style="width: 6.53cm">______________________________<br>&nbsp;</td>
                        <td style="width: 6.53cm">______________________________<br>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!------------------------ INICIO modal para Seleccionar un Articulo ------------------->
<div class="modal fade" id="modalbuscararticulo" tabindex="-1" role="dialog" aria-labelledby="modalbuscararticulolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Buscar Art&iacute;culo</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input name="elarticulo" id="elarticulo" type="text" class="form-control" placeholder="Ingresa el nombre del art&iacute;culo o codigo"  onkeypress="buscar_elarticulo(event)">
                        <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tabla_rearticulo()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablarearticulo"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal" onclick="cerrarmodal()"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar un Articulo ------------------->
