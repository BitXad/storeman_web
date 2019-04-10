<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/kardex.js'); ?>"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

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
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });   

</script>   

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">

<!-------------------------------------------------------->



<div class="box-header">
            <h3 class="box-title">KARDEX DE EXISTENCIA POR PROGRAMA</h3>
            <div class="box-tools no-print">
            
                
                <button class="btn btn-primary btn-sm" onclick="tabla_inventario()"><span class="fa fa-list"></span> Todos los Articulos</button>
                

            </div>
</div>
<div class="col-md-2">
            Desde: <input type="date" class="btn btn-danger btn-sm form-control" id="fecha_desde" value="<?php echo date("Y-m-d");?>" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-danger btn-sm form-control" id="fecha_hasta" value="<?php echo date("Y-m-d");?>"  name="fecha_hasta" required="true">
        </div>
        <div hidden>
            <input type="date" name="gestion_inicio" id="gestion_inicio" value="2019-01-01"> 
        </div>
       
<div class="row">
    <div class="col-md-12">
                        <label for="programa_id" class="control-label">Programa</label>
                        <div class="form-group">
                            <select name="programa_id" id="programa_id" class="form-control">
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
    <div class="col-md-12">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="articulobus" type="text" class="form-control" placeholder="Ingresa el nombre de articulo o código"  onkeypress="buscaarticulo(event,3)">
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
            <div class="box">
           
                       <!--------------------- inicio loader ------------------------->
                    <div class="row" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                    
                <div class="box-body  table-responsive" >

                    <div id="tablaresultados">
                        
                    <!-------------------- aqui se muestra la tabla de productos del inventario--------------------->
                    
                    </div>
                </div>
            </div>
</div>
</div>
