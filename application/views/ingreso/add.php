<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/ingreso.js'); ?>" type="text/javascript"></script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--------------------- CABCERA -------------------------->
<script type="text/javascript">
  function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script>
<!--<div class="box-header">
    <h1 class="box-title"><b>DETALLE ingreso COD: <?php echo "000".$ingreso_id; ?></b></h1>
</div>-->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="ingreso_idie" id="ingreso_idie" value="<?php echo $ingreso_id; ?>">
<input type="hidden" name="ingreso_id" id="ingreso_id" value="<?php echo $ingreso_id; ?>">

<div class="container" style="padding-left:0px;">
   
    <div class="panel panel-primary col-md-4" >
      
        <b>UNIDAD:</b> <span id="provedordeingreso"></span> <br>
        
        <b>PROGRAMA:</b> <span id="provedorcodigo" ><?php/* echo $ingreso[0]['proveedor_codigo']; */?></span> <label id="prove_iden" ><input id="prove_id" type="hidden" style="padding: 0px;" value="<?php /*echo $ingreso[0]['proveedor_id']; */?>"></label><br>
        <b>PROVEEDOR:</b> <span id="fechaingreso" >
        <input id="proveedor_id" list="proveedores"  class="btn btn-default form-control" style=" width: 60%; font-size: 11px;" type="text" placeholder="Seleccione Proveedor" > 
            <datalist    id="proveedores" required="true" >
                <?php foreach($proveedor as $es){?>
                    <option value="<?php echo $es['proveedor_id']; ?>" ><?php echo $es['proveedor_nombre']; ?></option>
                <?php } ?>
            </datalist>
     </span><a onclick="seleccionar(1)" class="btn btn-warning btn-xs"><span class="fa fa-check"></span><br></a>
    </div>

    <div class="col-md-4">
    <div class="box-tools">
        <center>            
            
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Pedido</small></a>
       
        </center>
        <!--------------------------------- INICIO MODAL proveedores ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Pedido</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar2" type="text" class="form-control" placeholder="Ingresa el nombre">
      </div>
                                
            </div>
            <div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>#</th>
                                                        <th>UNIDAD</th>
                                                        <th>PROGRAMA</th>
<!--                                                        <th>Acción</th>-->
                            </tr>
                            <tbody class="buscar2">
                            <?php $i=1;
                            foreach($all_pedido as $h){ ?>
                            <tr>                                                           
                                    <td><?php echo $i++; ?></td> 
                                    <td>                                        
                                      <div class="col-md-12">

                                          <b> <?php echo $h['unidad_nombre']; ?></b>
                                         </td>
                                         <td>
                                          <b> <?php echo $h['programa_nombre']; ?></b>
                                        </td>
                                        <td>
                                         <button  class="btn btn-success btn-xs" onclick="cambiarproveedores('<?php echo $ingreso_id; ?>','<?php echo $h['pedido_id']; ?>')"   data-dismiss="modal">
                                            <i class="fa fa-check"></i> Añadir
                                        </button>

        
                                        </div>
                                        </div>
                                      </div>  
                                    
                                 </form>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                        <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
<!--------------------------------- FIN MODAL proveedorS ------------------------------------>  

    </div>

    <br>            
     </div>
     <div class="col-md-4">
            
              <div class="row">
           <div class="panel panel-primary col-md-12" id="detalleco" style="font-family: "Arial", Arial, Arial, arial;">
               <table>       
                
  <?php $total_ultimo=0;?>
                
                <tr>
                        <th><b>TOTAL FINAL:</b></th>
                        <td></td>
                        <th><font size="3"><b> <?php echo number_format($total_ultimo,2,'.',',');?></b></font></th>
                       
                </tr>

        </table>
        
        </div>
     </div> 
</div>
</div>
<!--------------------- FIN CABERECA -------------------------->

<div class="row">
    <div class="col-md-12">
        
        <div class="col-md-4" style="padding-left:0px;">
                        
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="articulobus" type="text" class="form-control" placeholder="Ingresa el nombre de articulo o código"  onkeypress="buscaarticulo(event,3)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>articulos encontrados</button>-->

                <span class="badge btn-primary" style="background: black;">Articulos encontrados: <span class="badge" ><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>

</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                                
         <div class="box" style="padding-left:0px;">
            
            <div class="box-body table-responsive" style="padding-left:0px;">
          
                <table class="table table-striped" id="mitabla">
                    
                     <tr>
                                                <th>#</th>
                                                <th>Articulo</th>
                    </tr>
                    <tbody class="buscar3" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div></div>
            </div>
         <div class="col-md-8" style="padding-left:0px;">
    <!--------------------- parametro de buscador --------------------->
              <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingresa el nombre de articulo o código"> 
              </div>
                
        <!--------------------- fin parametro de buscador --------------------->
  
       <div class="box" >
            
            <div class="box-body table-responsive" style="padding-left:0px;padding-right: 0px;">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>#</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cant.</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar" id="tabladetalleingreso">
                  
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div>
    </div>
</div> 
</div>
