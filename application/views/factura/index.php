<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/factura.js'); ?>" type="text/javascript"></script>
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="text" id="base_url" value="<?php echo base_url();?>" hidden>

<div class="box-header">
                <!--<h3 class="box-title">Factura</h3>-->
<!--            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>-->
</div>
<div class="row">
    <div class="col-md-12">
                <h3 class="box-title">FACTURAS</h3>
        <div class="box">

            <div class="box-header">

                
                <div class="col-md-12">
                    <form action="<?php echo site_url('factura/generar_excel'); ?>" method="POST">
                        
                        <div class="col-md-2">
                            <label for="desde" class="control-label">Desde:</label>
                            <div class="form-group">
                                 <input type="date"class="btn btn-warning btn-xs form-control"  id="fecha_desde" name="fecha_desde" value="<?php echo date("Y-m-d");?>" >

                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="hasta" class="control-label">Hasta:</label>
                            <div class="form-group">
                                <input type="date" class="btn btn-warning btn-xs form-control"  id="fecha_hasta" name="fecha_hasta" value="<?php echo date("Y-m-d");?>" >
                        
                            </div>
                        </div>
                       
                        
                <!--------------------- parametro de buscador --------------------->
                <div class="col-md-4">
                  <div class="input-group">
                      <label for="hasta" class="control-label">Proveedor:</label>
                            <div class="form-group">
                                <select  class="btn btn-warning btn-xs form-control" id="proveedor">
                                   <option value="0">- TODOS -</option>
                                <?php 
                                foreach($proveedor as $prov)
                                {
                                    $selected = ($prov['proveedor_nombre'] == $this->input->post('proveedor_nombre')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$prov['proveedor_nombre'].'" '.$selected.'>'.$prov['proveedor_nombre'].'</option>';
                                } ?>
                                    
                                </select>
                        
                            </div>
                  </div>
                </div>
            <!--------------------- fin parametro de buscador --------------------->                        
                        
                       
                        
                    
                    </form>
                        <div class="col-md-2 no-print">
                           <label for="desde" class="control-label"> </label>
                           <div class="form-group">
              
                               <button  type="submit" class="btn btn-danger btn-xs form-control" onclick="mostrar_facturas()"><span class="fa fa-binoculars"> </span> BUSCAR</button>
      
                            </div>
                        </div>
                        <div class="col-md-2 no-print">
                           <label for="desde" class="control-label"> </label>
                           <div class="form-group">
              
                               <button  type="submit" class="btn btn-info btn-xs form-control" onclick="imprimir()"><span class="fa fa-print"> </span> IMPRIMIR</button>
      
                            </div>
                        </div>
                </div>
            </div>
            <div class="box-body table-responsive" id="tabla_factura" >
                
                    <!------------ aqui va la tabla JS con las facturas ----------------------->
            
                                
            </div>
        </div>
    </div>
</div>
    
