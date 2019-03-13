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

  $(document).ready(function(){
    $("#mostrar").on( "click", function() {
      $('#target').show(); //muestro mediante id
      $('.target').show(); //muestro mediante clase
     });
    $("#ocultar").on( "click", function() {
      $('#target').hide(); //oculto mediante id
      $('.target').hide(); //muestro mediante clase
    });
  });

   $(document).ready(function(){
    $("#mostrar2").on( "click", function() {
      $('#target2').show(); //muestro mediante id
      $('.target2').show(); //muestro mediante clase
     });
    $("#ocultar2").on( "click", function() {
      $('#target2').hide(); //oculto mediante id
      $('.target2').hide(); //muestro mediante clase
    });
  });

</script>
<script>
      $(document).ready(function () {
          $("#darid").click(function () {
              var value = document.getElementById('proveedor_id').value;;
              $("#proveedor_id2").val(value);
          });
      });
</script>
<!--<div class="box-header">
    <h1 class="box-title"><b>DETALLE ingreso COD: <?php echo "000".$ingreso_id; ?></b></h1>
</div>-->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="ingreso_idie" id="ingreso_idie" value="<?php echo $ingreso_id; ?>">
<input type="hidden" name="ingreso_id" id="ingreso_id" value="<?php echo $ingreso_id; ?>">

<div class="container" style="padding-left:0px;">
   
    <div class="panel panel-primary col-md-4" >
      
        
        <b>UNIDAD:</b> <span id="unidadpedido"><?php echo $ingreso[0]['unidad_nombre']; ?></span> <br>
        
        <b>PROGRAMA:</b> <span id="programapedido" ><?php echo $ingreso[0]['programa_nombre']; ?></span> 
       
    </div>

    <div class="col-md-4">
    <div class="box-tools">
        <center>            
            
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Pedido</small></a>
       
        </center>
        <!--------------------------------- INICIO MODAL PEDIDOS ------------------------------------>
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
                                         <button  class="btn btn-success btn-xs" onclick="cambiarpedidos('<?php echo $ingreso_id; ?>','<?php echo $h['pedido_id']; ?>')"   data-dismiss="modal">
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
<!--------------------------------- FIN MODAL PEDIDOS ------------------------------------>  

    </div>

    <br>            
     </div>
     <div class="col-md-4">
            
              <div class="row" style="width: 90%;">
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
     
     <div class="input-group" style="width: 80%;">  
           <span  class="input-group-addon"><b>No. INGRESO</b></span>
              <input type="text" name="ingreso_numdoc" value="<?php echo $ingreso[0]['ingreso_numdoc']; ?>" class="form-control" id="ingreso_numdoc" required />
          </div>  
</div>     
   
</div>

<div class="col-md-4">
<label for="proveedor_id" class="control-label">Proveedor</label>
<div class="form-group">
  <?php if ($ingreso[0]['proveedor_id']=!null){ ?>
<input type="hidden" id="proveedor_id2" name="proveedor_id2" value="<?php echo $ingreso[0]['prove']; ?>">
<input type="hidden" id="factura_id" name="factura_id" value="<?php echo $ingreso[0]['factura_id']; ?>">
<input id="proveedor_id" list="proveedores"  class="form-control-xs" type="text" placeholder="Seleccione Proveedor" value="<?php echo $ingreso[0]['proveedor_nombre']; ?>" > 
            <datalist    id="proveedores" required="true" >
                <?php foreach($proveedor as $es){?>
                    <option value="<?php echo $es['proveedor_id']; ?>" ><?php echo $es['proveedor_nombre']; ?></option>
                <?php } ?>
            </datalist>
     </span><a onclick="seleccionar(1)" title="SELECCIONAR" id="darid" class="btn btn-warning btn-xs"><span class="fa fa-check"></span>ASIGNAR<br></a>
   </div></div>
<div class="col-md-2">
            <label for="ingreso_fecha_ing" class="control-label">Fecha Ing. Almacen</label>
            <div class="form-group">
              <input type="date" name="ingreso_fecha_ing" value="<?php echo $ingreso[0]['ingreso_fecha_ing']; ?>" class="form-control" id="ingreso_fecha_ing" required />
            </div>
</div>
<div class="col-md-2">
            <label for="factura_fecha" class="control-label">Fecha Factura</label>
            <div class="form-group">
              <input type="date" name="factura_fecha" value="<?php echo $ingreso[0]['factura_fecha']; ?>" class="form-control" id="factura_fecha" required />
            </div>
</div>

<div class="col-md-2">
            <label for="factura_numero" class="control-label">No. Factura</label>
            <div class="form-group">
              <input type="text" name="factura_numero" value="<?php echo $ingreso[0]['factura_numero']; ?>" class="form-control" id="factura_numero" required />
            </div>
</div>
<div class="col-md-1">
            <label for="ingreso_numdoc" class="control-label"></label>
            <div class="form-group" style="padding-top: 20px;">
              <a onclick="actualizarzaringreso('<?php echo $ingreso_id; ?>')" class="btn btn-success" >
                                            <i class="fa fa-check"></i> Guardar Cambios
                                        </a>
            </div>
</div>
<!--------------------- FIN CABERECA -------------------------->
<!--------------------- FORMULARIO PROVEEDOR -------------------------->

<div class="col-md-6" >
<input type="button" id="mostrar" name="boton1" value="+">Info. Proveedor
<input type="button" id="ocultar" name="boton2" value="-">
<div class="row" id="target" hidden>
       
          
          <div class="col-md-6">
            <label for="proveedor_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
            <div class="form-group">
              <input type="text" name="proveedor_nombre" value="<?php echo $ingreso[0]['proveedor_nombre']; ?>" class="form-control" id="proveedor_nombre" required />
              
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_codigo" class="control-label"><span class="text-danger">*</span>Código</label>
            <div class="form-group">
                            <input type="text" name="proveedor_codigo" value="<?php echo $ingreso[0]['proveedor_codigo']; ?>" class="form-control" id="proveedor_codigo" required />
              <span class="text-danger"><?php echo form_error('proveedor_codigo');?></span>
            </div>
          </div>
         
          <div class="col-md-6">
            <label for="proveedor_contacto" class="control-label">Contacto</label>
            <div class="form-group">
              <input type="text" name="proveedor_contacto" value="<?php echo $ingreso[0]['proveedor_contacto']; ?>" class="form-control" id="proveedor_contacto" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_direccion" class="control-label">Dirección</label>
            <div class="form-group">
              <input type="text" name="proveedor_direccion" value="<?php echo $ingreso[0]['proveedor_direccion']; ?>" class="form-control" id="proveedor_direccion" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_telefono" class="control-label">Teléfono</label>
            <div class="form-group">
              <input type="number" name="proveedor_telefono" value="<?php echo $ingreso[0]['proveedor_telefono']; ?>" class="form-control" id="proveedor_telefono" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_telefono2" class="control-label">Celular</label>
            <div class="form-group">
              <input type="number" name="proveedor_telefono2" value="<?php echo $ingreso[0]['proveedor_telefono2']; ?>" class="form-control" id="proveedor_telefono2" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_email" class="control-label">Email</label>
            <div class="form-group">
              <input type="email" name="proveedor_email" value="<?php echo $ingreso[0]['proveedor_email']; ?>" class="form-control" id="proveedor_email" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_nit" class="control-label">Nit</label>
            <div class="form-group">
              <input type="text" name="proveedor_nit" value="<?php echo $ingreso[0]['proveedor_nit']; ?>" class="form-control" id="proveedor_nit" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_razon" class="control-label">Razon</label>
            <div class="form-group">
              <input type="text" name="proveedor_razon" value="<?php echo $ingreso[0]['proveedor_razon']; ?>" class="form-control" id="proveedor_razon" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_autorizacion" class="control-label">Autorización</label>
            <div class="form-group">
              <input type="text" name="proveedor_autorizacion" value="<?php echo $ingreso[0]['proveedor_autorizacion']; ?>" class="form-control" id="proveedor_autorizacion" />
            </div>
          </div>
        </div>
</div>
<?php } ?>
<!------------------FIN FORMULARIO PROVEEDROR----------->
<!------------------ FORMULARIO FACTURA----------->
<div class="col-md-6" >
  <input type="button" id="mostrar2" name="boton1" value="+">Info. Factura
<input type="button" id="ocultar2" name="boton2" value="-">
<div class="row clearfix" id="target2" hidden>


          <div class="col-md-6">
            <label for="factura_importe" class="control-label">Factura Importe</label>
            <div class="form-group">
              <input type="text" name="factura_importe" value="<?php echo $ingreso[0]['factura_importe']; ?>" class="form-control" id="factura_importe" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_poliza" class="control-label">Factura Poliza</label>
            <div class="form-group">
              <input type="text" name="factura_poliza" value="<?php echo $ingreso[0]['factura_poliza']; ?>" class="form-control" id="factura_poliza" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_ice" class="control-label">Factura Ice</label>
            <div class="form-group">
              <input type="text" name="factura_ice" value="<?php echo $ingreso[0]['factura_ice']; ?>" class="form-control" id="factura_ice" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_exento" class="control-label">Factura Exento</label>
            <div class="form-group">
              <input type="text" name="factura_exento" value="<?php echo $ingreso[0]['factura_exento']; ?>" class="form-control" id="factura_exento" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_neto" class="control-label">Factura Neto</label>
            <div class="form-group">
              <input type="text" name="factura_neto" value="<?php echo $ingreso[0]['factura_neto']; ?>" class="form-control" id="factura_neto" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_creditofiscal" class="control-label">Factura Creditofiscal</label>
            <div class="form-group">
              <input type="text" name="factura_creditofiscal" value="<?php echo $ingreso[0]['factura_creditofiscal']; ?>" class="form-control" id="factura_creditofiscal" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_codigocontrol" class="control-label">Factura Codigocontrol</label>
            <div class="form-group">
              <input type="text" name="factura_codigocontrol" value="<?php echo $ingreso[0]['factura_codigocontrol']; ?>" class="form-control" id="factura_codigocontrol" />
            </div>
          </div>
        </div>
</div>
        <!--------------FIN FORMULARIO FACTURA->>>>>>>>>>>>>>>>----------------->
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
