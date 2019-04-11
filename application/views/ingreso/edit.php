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
                $('#articulobus').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

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
<script>
      function pedidotu(value) {
          $("#pedidosigue").val(value);
      }
</script>
<!--<div class="box-header">
    <h1 class="box-title"><b>DETALLE ingreso COD: <?php echo "000".$ingreso_id; ?></b></h1>
</div>-->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="ingreso_idie" id="ingreso_idie" value="<?php echo $ingreso_id; ?>">
<input type="hidden" name="ingreso_id" id="ingreso_id" value="<?php echo $ingreso_id; ?>">
<input type="hidden" name="pedidosigue" id="pedidosigue" value="0">

<div class="container" style="padding-left:0px;">
   <div class="col-md-5">
            <label for="programa_id" class="control-label">MATERIALES CON CARGO A:</label>
            <div class="form-group">
              <select name="programa_id" class="form-control" id="programa_id" >
                <option value="">- PROGRAMA -</option>
                <?php 
                foreach($all_programa as $programa)
                {
                  $selected = ($programa['programa_id'] == $ingreso[0]['esteprogra']) ? ' selected="selected"' : "";

                  echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
                } 
                ?>
              </select>
            </div>
            <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                
                                                        <th># PEDIDO</th>
                                                        <th>UNIDAD</th>
                                                        <th>PROGRAMA</th>
<!--                                                        <th>Acción</th>-->
                            </tr>
                            <tbody class="buscar4" id="pedidosdeingreso">
                              <?php $h=0;
                              foreach ($pedidos as $ped) { 
                                $h = $h+1;?>
  
                             <tr>
                                
                               <td><?php echo $ped['pedido_numero']; ?></td>   
                               <td><?php echo $ped['unidad_nombre']; ?></td>   
                               <td><?php echo $ped['programa_nombre']; ?></td>   
                               <td><a class="btn btn-danger btn-xs" onclick="quitarprograma('<?php echo $ped['pedido_id']; ?>')"><span class="fa fa-trash"></span></a></td>    
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
          </div>

<div class="col-md-2">
    <div class="box-tools">
        <center>            
            
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small> Pedidos </small></a>
            <a href="#" data-toggle="modal" data-target="#facturas" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Factura</small></a>
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
        <input id="filtrar" type="text" class="form-control" onkeypress="buscarpedidos(event)" placeholder="Ingresa el # de pedido o nombre de programa">
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
                            <tbody class="buscar" id="tabladepedido">
                            
                            </tbody>
                        </table>
                    </div>
                        <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
<!--------------------------------- FIN MODAL PEDIDOS ------------------------------------>  
<!--------------------------------- INICIO MODAL FACTURAS ------------------------------------>
<div class="modal fade" id="facturas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">FACTURA</h4>
                                
     
            <div class="modal-body">
              <label for="proveedor_id" class="control-label">Proveedor</label>
<div class="form-group">
<div class="col-md-12">
<input type="hidden" id="proveedor_id2" name="proveedor_id2" value="0">
<input id="proveedor_id" list="proveedores"  class="form-control-xs"  type="text" placeholder="Seleccione Proveedor" > 
            <datalist    id="proveedores" required="true" >
                <?php foreach($proveedor as $es){?>
                    <option value="<?php echo $es['proveedor_id']; ?>" ><?php echo $es['proveedor_nombre']; ?></option>
                <?php } ?>
            </datalist>
     <a onclick="seleccionar(1)" title="SELECCIONAR" id="darid" class="btn btn-warning btn-xs"><span class="fa fa-check">ASIGNAR</span><br></a>
     <span class="btn-info btn-sm"> <input type="checkbox" name="nuevopro" value="1" id="nuevopro"> Nuevo Proveedor</span>
</div>

<div class="col-md-3">
            <label for="proveedor_nit" class="control-label">Nit</label>
            <div class="form-group">
              <input type="text" name="proveedor_nit" class="form-control" id="proveedor_nit" />
            </div>
          </div>
          <div class="col-md-3">
            <label for="proveedor_razon" class="control-label">Razon Social</label>
            <div class="form-group">
              <input type="text" name="proveedor_razon" class="form-control" id="proveedor_razon" />
            </div>
          </div>
          <div class="col-md-3">
            <label for="proveedor_autorizacion" class="control-label">Autorización</label>
            <div class="form-group">
              <input type="text" name="proveedor_autorizacion"  class="form-control" id="proveedor_autorizacion" />
            </div>
          </div>
          <div class="col-md-3">
            <label for="proveedor_contacto" class="control-label">Responsable</label>
            <div class="form-group">
              <input type="text" name="proveedor_contacto"  class="form-control" id="proveedor_contacto" />
            </div>
          </div>
          <div class="col-md-3">
            <label for="factura_fecha" class="control-label">Fecha Factura</label>
            <div class="form-group">
              <input type="date" name="factura_fecha" style="font-size: 12px; padding-left: 0px;" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="factura_fecha" required />
            </div>
</div>
<div class="col-md-3">
            <label for="factura_numero" class="control-label">No. Factura</label>
            <div class="form-group">
              <input type="text" name="factura_numero" value="<?php echo ($this->input->post('factura_numero')); ?>" class="form-control" id="factura_numero" required />
            </div>
</div>
           <div class="col-md-3">
            <label for="factura_importe" class="control-label">Factura Importe</label>
            <div class="form-group">
              <input type="text" name="factura_importe" value="0" class="form-control" id="factura_importe" />
            </div>
          </div>
 <div class="col-md-3">
            <label for="factura_codigocontrol" class="control-label">Codigo Control</label>
            <div class="form-group">
              <input type="text" name="factura_codigocontrol" value="0" class="form-control" id="factura_codigocontrol" />
            </div>
          </div>
   </div>
   <div class="col-md-2">
            
            <div class="form-group" style="padding-top: 20px;">
              <a onclick="crearfactura('<?php echo $ingreso_id; ?>')" class="btn btn-success" data-dismiss="modal">
                                            <i class="fa fa-check"></i> Añadir
                                        </a>
            </div>
</div>
 </div>
         </div>
        </div>
    </div>
</div>

<!--------------------------------- FIN MODAL FACTURAS ------------------------------------>  
    </div>

    <br>            
     </div>
   

     <div class="col-md-5">
            
           
<div class="input-group" style="width: 80%;">  
           <span  class="input-group-addon"><b>No. INGRESO</b></span>
              <input type="text" name="ingreso_numdoc" value="<?php echo $ingreso[0]['ingreso_numdoc']; ?>" class="form-control" id="ingreso_numdoc" required />
          </div> 
          <div class="input-group" style="width: 80%;">  
           <span  class="input-group-addon"><b>FECHA ING.</b></span>
              <input type="date" name="ingreso_fecha_ing" value="<?php echo $ingreso[0]['ingreso_fecha_ing']; ?>" class="form-control" id="ingreso_fecha_ing" required />
               <input type="hidden" name="ingreso_total" value="" class="form-control" id="ingreso_total" />
               <?php $h=0;
                              foreach ($facturas as $fac) { 
                                $h += $fac['factura_importe'];?>
                <?php } ?>
               <input type="hidden" name="totalfacturas" value="<?php echo $h; ?>" class="form-control" id="totalfacturas" />
            </div>

</div>
<div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                
                                                        <th># FACTURA</th>
                                                        <th>NIT</th>
                                                        <th>RAZON SOCIAL</th>
                                                        <th>IMORTE</th>
                            </tr>
                            <tbody class="buscar" id="facturasdeingreso">
                             <?php $h=0;
                              foreach ($facturas as $fac) { 
                                $h += $fac['factura_importe'];?>
  
                             <tr>
                                
                               <td><?php echo $fac['factura_numero']; ?></td>   
                               <td><?php echo $fac['factura_nit']; ?></td>   
                               <td><?php echo $fac['factura_razon']; ?></td>   
                               <td><?php echo $fac['factura_importe']; ?></td>   
                               <td><a class="btn btn-danger btn-xs" onclick="quitarfactura('<?php echo $fac['factura_id']; ?>')"><span class="fa fa-trash"></span></a></td>
                            </tr>
                            
                            <?php } ?>
                            <tr>
                              <td><b>TOTAL;</b></td>
                              <td></td>
                              <td></td>
                              <td><?php echo $h; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
</div>

  <?php if ($ingreso[0]['proveedor_id']=!null){ ?>



<div class="col-md-12">
  <div class="col-md-5">
   <div class="input-group" >  
           <span  class="input-group-addon"><b>Pagar a favor de: </b></span>
              <select name="responsable_id" class="form-control" id="responsable_id">
                <option value="">- RESPONSABLE -</option>
                <?php 
                foreach($responsable as $resp)
                {
                 $selected = ($resp['responsable_id'] == $ingreso[0]['responsable_id']) ? ' selected="selected"' : "";

                  echo '<option value="'.$resp['responsable_id'].'" '.$selected.'>'.$resp['responsable_nombre'].'</option>';
                } 
                ?>
              </select>
          </div>  
  </div>
  <div class="col-md-3">
  </div>
  <div class="col-md-1" style="padding-left: 0px;">
            <label for="ingreso_numdoc" class="control-label"></label>
            <div class="form-group" >
              <a onclick="actualizarzaringreso('<?php echo $ingreso_id; ?>')" class="btn btn-danger" >
                                            <i class="fa fa-check"></i> Registrar<br> Ingreso
                                        </a>
            </div>

   </div>
   <div class="col-md-3">
           <div class="panel panel-primary" id="detalleco" style="font-family: 'Arial', Arial, Arial, arial;">
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
<!--------------------- FIN CABERECA -------------------------->
<!--------------------- FORMULARIO PROVEEDOR -------------------------->

<div class="col-md-6 hidden" >
<input type="button" id="mostrar" name="boton1" value="+">Info. Proveedor
<input type="button" id="ocultar" name="boton2" value="-">
<div class="row" id="target" hidden>
       
          
          <div class="col-md-6">
            <label for="proveedor_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
            <div class="form-group">
              <input type="text" name="proveedor_nombre" class="form-control" id="proveedor_nombre" required />
              
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_codigo" class="control-label"><span class="text-danger">*</span>Código</label>
            <div class="form-group">
                            <input type="text" name="proveedor_codigo" class="form-control" id="proveedor_codigo" required />
              <span class="text-danger"><?php echo form_error('proveedor_codigo');?></span>
            </div>
          </div>
         
          <div class="col-md-6">
            <label for="proveedor_contacto" class="control-label">Contacto</label>
            <div class="form-group">
              <input type="text" name="proveedor_contacto"   class="form-control" id="proveedor_contacto" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_direccion" class="control-label">Dirección</label>
            <div class="form-group">
              <input type="text" name="proveedor_direccion"  class="form-control" id="proveedor_direccion" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_telefono" class="control-label">Teléfono</label>
            <div class="form-group">
              <input type="number" name="proveedor_telefono"   class="form-control" id="proveedor_telefono" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_telefono2" class="control-label">Celular</label>
            <div class="form-group">
              <input type="number" name="proveedor_telefono2"  class="form-control" id="proveedor_telefono2" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="proveedor_email" class="control-label">Email</label>
            <div class="form-group">
              <input type="email" name="proveedor_email"  class="form-control" id="proveedor_email" />
            </div>
          </div>
          
        </div>
</div>
<?php } ?>
<!------------------FIN FORMULARIO PROVEEDROR----------->
<!------------------ FORMULARIO FACTURA----------->
<div class="col-md-6 hidden" >
  <input type="button" id="mostrar2" name="boton1" value="+">Info. Factura
<input type="button" id="ocultar2" name="boton2" value="-">
<div class="row clearfix" id="target2" hidden>


         
          <div class="col-md-6">
            <label for="factura_poliza" class="control-label">Factura Poliza</label>
            <div class="form-group">
              <input type="text" name="factura_poliza" value="0" class="form-control" id="factura_poliza" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_ice" class="control-label">Factura Ice</label>
            <div class="form-group">
              <input type="text" name="factura_ice" value="0" class="form-control" id="factura_ice" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_exento" class="control-label">Factura Exento</label>
            <div class="form-group">
              <input type="text" name="factura_exento" value="0" class="form-control" id="factura_exento" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_neto" class="control-label">Factura Neto</label>
            <div class="form-group">
              <input type="text" name="factura_neto" value="0" class="form-control" id="factura_neto" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="factura_creditofiscal" class="control-label">Factura Creditofiscal</label>
            <div class="form-group">
              <input type="text" name="factura_creditofiscal" value="0" class="form-control" id="factura_creditofiscal" />
            </div>
          </div>
         
        </div>
</div>
        <!--------------FIN FORMULARIO FACTURA->>>>>>>>>>>>>>>>----------------->
<div class="row">
    <div class="col-md-12">
        
        <div class="col-md-4" style="padding-left:0px;">
          <div class="col-md-12" style="padding-left:0px;">               
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="articulobus" type="text" class="form-control" placeholder="Ingresa el nombre de articulo o código"  onkeypress="buscaarticulo(event,3)">
      </div>
    </div>
    
<div class="col-md-7" style="padding-left:0px;" >
                <span class="badge btn-primary" style="background: black;">Articulos encontrados: <span class="badge" style=" width: 35%"><input style="border-width: 0; width: 100%; padding: 0px;" id="encontrados" type="text" value="0" readonly="true"> </span></span>
</div>
<div class="col-md-5" >

                <div id="misele">  
              <select name="facturation" class="form-control" id="facturation">
                <option value="0">- FACTURA -</option>
                <?php 
                foreach($facturas as $factur)
                {
                  $selected = ($factur['factura_id'] == $this->input->post('factura_id')) ? ' selected="selected"' : "";

                  echo '<option value="'.$factur['factura_numero'].'" '.$selected.'>'.$factur['factura_numero'].'</option>';
                } 
                ?>
              </select>
            </div>
 </div>           

<!-------------------- FIN CATEGORIAS--------------------------------->
<div class="col-md-12" style="padding-left:0px;">                                
         <div class="box" style="padding-left:0px;">
            
            <div class="box-body table-responsive" style="padding-left:0px;">
          
                <table class="table table-striped" id="mitabla">
                    
                     <tr>
                                                <th>#</th>
                                                <th>Articulo</th>
                    </tr>
                    <tbody class="buscar2" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div></div>
            </div></div>
         <div class="col-md-8" style="padding-left:0px;">
    <!--------------------- parametro de buscador --------------------->
              <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de articulo o código"> 
              </div>
                
        <!--------------------- fin parametro de buscador --------------------->
  
       <div class="box" >
            
            <div class="box-body table-responsive" style="padding-left:0px;padding-right: 0px;">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>#</th>
                            <th>Articulo</th>
                            <th>Factura</th>
                            <th>Precio</th>
                            <th>Cant.</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar3" id="tabladetalleingreso">
                  
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div>
    </div>
</div> 
</div>
