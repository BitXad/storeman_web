


<div class="box-header with-border">
    <h3 class="box-title">Salida</h3>
</div>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <?php echo form_open('salida/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                            
<!--					<div class="col-md-6" hidden>
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="1">ACTIVO</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>-->
                            
					<div class="col-md-5">
						<label for="programa_id" class="control-label">Programa</label>
						<div class="form-group">
							<select name="programa_id" class="form-control">
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
                            
					<div class="col-md-5">
						<label for="unidad_id" class="control-label">Unidad/Motivo</label>
						<div class="form-group">
							<select name="unidad_id" class="form-control">
								<option value="">- UNIDAD -</option>
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $this->input->post('unidad_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label for="salida_doc" class="control-label">Salida Doc</label>
						<div class="form-group">
							<input type="text" name="salida_doc" value="<?php echo $this->input->post('salida_doc'); ?>" class="form-control" id="salida_doc" />
						</div>
					</div>

                            
					<div class="col-md-5">
						<label for="salida_fechasal" class="control-label">Fecha/Salida</label>
						<div class="form-group">
							<input type="date" name="salida_fechasal" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="salida_fechasal" />
						</div>
					</div>
                            
					<div class="col-md-7">
						<label for="salida_acta" class="control-label">Acta</label>
						<div class="form-group">
							<input type="text" name="salida_acta" value="<?php echo $this->input->post('salida_acta'); ?>" class="form-control" id="salida_acta" />
						</div>
					</div>

<!--					<div class="col-md-6" hidden>
						<label for="gestion_id" class="control-label">Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control">
								<option value="<?php echo $gestion_id; ?>">select gestion</option>
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $this->input->post('gestion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>-->
                            
<!--					<div class="col-md-6" hidden>
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="<?php echo $usuario_id; ?>">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                            
					<div class="col-md-6">
						<label for="salida_motivo" class="control-label">Salida Motivo</label>
						<div class="form-group">
							<input type="text" name="salida_motivo" value="<?php echo $this->input->post('salida_motivo'); ?>" class="form-control" id="salida_motivo" />
						</div>
					</div>
-->
                            
<!--
                            
					<div class="col-md-6">
						<label for="salida_obs" class="control-label">Salida Obs</label>
						<div class="form-group">
							<input type="text" name="salida_obs" value="<?php echo $this->input->post('salida_obs'); ?>" class="form-control" id="salida_obs" />
						</div>
					</div>
                            
					<div class="col-md-6">
						<label for="salida_fecha" class="control-label">Salida Fecha</label>
						<div class="form-group">
							<input type="date" name="salida_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="salida_fecha" />
						</div>
					</div>
                            
--><!--
					<div class="col-md-6">
						<label for="salida_hora" class="control-label">Salida Hora</label>
						<div class="form-group">
							<input type="time" name="salida_hora" value="<?php echo date('h:i:s'); ?>" class="form-control" id="salida_hora" />
						</div>
					</div>-->
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>





<div class="row">
    <div class="col-md-6" >
        
        <div class="row">
            
            <!--------------------- parametro de buscador por codigo --------------------->

            <div class="col-md-4">
                  <div class="input-group">
                      <span class="input-group-addon"> 
                        <i class="fa fa-barcode"></i>
                      </span>           
                      <input type="text" name="codigo" id="codigo" class="form-control" placeholder="código" onkeyup="validar(event,3)">
                  </div>
            </div>      
           <!--------------------- fin buscador por codigo --------------------->
           

            <div class="col-md-8">
                
<!--            ------------------- parametro de buscador --------------------->
                       
                  <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código" onkeypress="validar(event,4)">
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
    <span class="badge btn-danger">
    
    Categoria:     
    
    <select class="bange btn-danger" style="border-width: 0;" onchange="tablaresultados(2)" id="categoria_prod">
                <option value="0" >Todas</option>
        <?php 
            foreach($categoria_producto as $categ){ 
                $selected = ($categ['categoria_id'] == $parametro[0]['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                ?>
                
                <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
    </select>


    
    </span>
    
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                <span class="badge btn-default">

                    <!--------------------- inicio loader ------------------------->
                    <div class="row" id='oculto'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                    
                </span>

                
                
</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
        
        <div class="box">
            <div class="box-body  table-responsive">
                <table class="table  table-condensed table-striped" id="mitabla">
                    <tr>
                            <th>Nº</th> 
                            <th>Descripción</th>
                            <!--<th>Código</th>-->                            
                            <th>Precio</th>
<!--                            <th>Saldo</th>-->
                            <th> </th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
               
        </div>
    </div>
    
    <div class="col-md-6" id="divventas1" style="display:none;">
        <center>            
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>">
        </center>
    </div>
        
    <div class="col-md-6" id="divventas0" style="display:block;">
        <div class="row">
            
            <div class="col-md-8">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            
    
            <!--------------- botones ---------------------->
            <a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-facebook btn-xs"><span class="fa fa-cubes"></span><b> Pedidos</b></a> 
            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> 
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0'></span><b> - 0 -</b></button> 
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money'></span><b> costo</b></button> 
            <a href="<?php echo base_url('venta/ultimaventa');?>" data-toggle="modal" target="_blank" class="btn btn-primary btn-xs" id="imprimir"><span class="fa fa-print"></span><b> Imprimir</b></a> 
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            <div class="col-md-4" style="background-color: black;">
                <center>
                    
                <font size="4" style="color:white">
                    
                
                <b>Total Final</b>
                <b>Bs <input type="text" id="venta_subtotal" name="venta_subtotal" values="0.00" style="width: 150px; border-color: black; border-width: 0; background-color: black; text-align: center"> </b>
                </font>
    
                </center>

                
            </div>
        </div>
        
        <div class="box">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tablaproductos">
                    
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                    
                </div>
            </div>
                
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->
        <div class="col-md-12">

            <center>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>
               Finalizar Venta <br>
            </a>

            <?php if ($tipousuario_id == 1){ ?>
            <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Salir <br>
            </a>    
            <?php } ?>    
            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->

    </div>
    
</div>

<div class="col-md-6">
        
        
<!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: PEDIDO</h3>
        </div>        -->
        
<?php 
    $total_detalle = 0;
    $subtotal = $total_detalle;
    $descuento = 0;
    $totalfinal = $total_detalle;
?>
        
        <div class="row">
            <div class="col-md-12" id="detallecuenta">

        </div>
        </div>
        
    <!----------- fin tabla detalle cuenta ----------------------------------->
        
    </div>
<!----------------------------------- BOTONES ---------------------------------->
<!--<div class="col-md-6">
        
    <center>
    <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-money fa-4x"></i><br><br>
       Finalizar Venta <br>
    </a>


    <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-sign-out fa-4x"></i><br><br>
       Salir <br>
    </a>    
    </center>

</div>    -->
<!----------------------------------- fin Botones ---------------------------------->



<!----------------------Modal Cobrar--------------------------------------------------->
<!--<form action="<?php echo base_url('venta/finalizarventa'); ?>"  method="POST" class="form" name="finalizarventa">-->
<div class="modal fade" id="modalfinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                            
                        <div class="container">
                            
                                <center>
                                <div class="row">
                                        
                                    
                                    <div class="col-md-2">
<!--                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA DE ENTREGA</b></h4>
                                        <?php                                                     
                                            $fecha = date('Y-m-d'); 
                                            $hora = date('H:i:s');                                                                                         
                                        ?>
                                        
                                        <input type="datetime-local" id="fechahora_entrega" name="fechahora_entrega" value="<?php echo $fecha."T".$hora;?>" required>-->
                                        <h4 class="modal-title" id="myModalLabel"><b>FORMA DE PAGO</b></h4>                                        
                                        <select id="forma_pago"  name="forma_pago" class="btn btn-default">
                                            <?php
                                                foreach($forma_pago as $forma){ ?>
                                                    <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                            <?php } ?>
                                                                                                    
                                         </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <h4 class="modal-title" id="myModalLabel"><b>TIPO TRANS</b></h4>                                        
                                        <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-default"  onchange="mostrar_ocultar()">
                                            <?php
                                                foreach($tipo_transaccion as $tipo){ ?>
                                                    <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                                            <?php } ?>
 
                                         </select>
                                    </div>
                                    
                                </div>                                    
                                </center>                                                               
			</div>
                            
			<div class="modal-body">
                            
<!----------- tabla detalle cuenta ----------------------------------->

                
<?php 
    $total_descuento = 0;
    
    $subtotal = $total_detalle - $total_descuento; 
    $efectivo = $subtotal;
    $cambio = 0.00;
    $ancho_boton = 10;
    ?>

            <div hidden="true">        
                            <input id="total_detalle" name="total_detalle" value="<?php echo $total_detalle; ?>">
                            <input id="total_descuento" name="total_descuento" value="<?php echo $total_descuento; ?>">
                            
            </div>
                 
        <div class="row">
            
            
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box">

            <div class="box-body table-responsive table-condensed">
            <!--<form method="post" name="descuento">-->                
            
            
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" style="max-width: 7cm">
                
                <tr>
                        <td>Total Bs</td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_total" size="<?php echo $ancho_boton; ?>"  name="venta_total" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                    
                </tr>                
                <tr>
                        <td>Descuento Bs</td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_descuentoparc" size="<?php echo $ancho_boton; ?>"  name="venta_descuentoparc" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                </tr>

                        
                <tr>
                        <td align="right"><b>Sub Total Bs</b></td>
                        <td align="right">                
                            
                            <input class="btn btn-foursquarexs" id="venta_subtotal" size="<?php echo $ancho_boton; ?>"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>

                <tr>                      
                        <td>Descuento Bs</td>
                        <td align="right">
                            <input class="btn btn-info" id="venta_descuento" name="venta_descuento" size="<?php echo $ancho_boton; ?>" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)">
                        </td>
                </tr>

                <tr>                      
                        <td><b>Total Final Bs</b></td>
                        <td align="right">

                              <input class="btn btn-foursquarexs" style="font-size: 20" id="venta_totalfinal" size="<?php echo $ancho_boton; ?>" name="venta_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">                                

                        </td>
                </tr>

                <tr>                      
                        <td>Efectivo Bs</td>
                        <td align="right">
                            <input class="btn btn-info" id="venta_efectivo" size="<?php echo $ancho_boton; ?>" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio()"  onclick="seleccionar(5)">
                
                        </td>
                </tr>
                
                <tr>                      
                    <td><b>Cambio Bs</b></td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_cambio" size="<?php echo $ancho_boton; ?>" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
                        </td>
                </tr>
                
                
                
                
            </table>
            
            

          
            <div class="col-md-12">
                NOTA: <input type="text" id="venta_glosa" name="venta_glosa" value="" class="form-control  input-sm">           
            </div>
           
        </div>
           
        </div>
                
                
                           
           <!************************************* datos credito ************************************************>
                
            <div class="row" id='creditooculto'  style='display:none;'>
                                    
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>Nº CUOTAS</b></h5>

                    <select name="cuotas"  class="form-control input-sm" id="cuotas">
                        <?php for($i=1;$i<=36;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> CUOTA (S)</option>
                        <?php } ?>
                    </select>                                      
                </div>

                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>MODALIDAD</b></h5>
                    <select class="form-control input-sm" id="modalidad" name="modalidad">                       
                        <option value="MENSUAL">MENSUAL</option>
                        <option value="SEMANAL">SEMANAL</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>DIA PAGO</b></h5>
                    <select class="form-control input-sm" id="dia_pago" name="dia_pago">
                        
                    <?php for($dia=1; $dia<=31; $dia++){?>
                            <option value="<?php echo $dia; ?>"><?php echo $dia; ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>INTERES</b></h5>
                    <input type="text"  class="form-control  input-sm" value="<?php echo 0.00; ?>" name="credito_interes" id="credito_interes">
                </div>

                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. Bs</b></h5>
                    <input type="text" class="form-control  input-sm"  value="0.00"name="cuota_inicial" id="cuota_inicial" >
                </div>

<!--                <div class="col-md-3">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA Bs</b></h5>
                    <input type="text" class="form-control"  value="0.00" style="background-color: gray" name="monto_cuota" id="monto_cuota"  width="20" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" readonly>
                </div>
                -->
                <?php  $fecha = date('Y-m-d'); ?>
                <div class="col-md-4">
                    
                    <h5 class="modal-title" id="myModalLabel"><b>FECHA INICIAL</b></h5>
                    <input type="date" class="form-control  input-sm"  value="<?php echo $fecha; ?>" name="fecha_inicio" id="fecha_inicio">
                    
                </div>
                
           </div>
           
           <!--************************************* fin datos credito ************************************************>           
                 
                
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            
<!--            <button class="btn btn-lg btn-facebook btn-sm btn-block" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Venta  
                </h4>
            </button>
            -->
            <button class="btn btn-lg btn-facebook btn-sm btn-block" id="boton_finalizar" data-dismiss="modal" onclick="finalizarventa()" style="display: block;">
                <h4>
                <span class="fa fa-save"></span>   Finalizar Venta  
                </h4>
            </button>

            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Cancelar  
                </h4>
            </button>
    <!--</form>-->
        </div>
        </div>
<!-- </form>-->

        
<!----------- fin tabla detalle cuenta ----------------------------------->                           
                            
                            
			</div>
		</div>
	</div>
</div>

</div>
<!--</form>-->

<!----------------------Fin Modal Cobrar--------------------------------------------------->


<!----------------- modal pedidos---------------------------------------------->


<div class="modal fade" id="modalpedidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
<!--                        <th>Sub <br>Total</th>-->
                        <th align="center">COD</th>
                        <th>Total</th>
                        <!--<th>Fecha<br>entrega</th>-->
                        <!--<th>Estado</th>-->
                           <!--<th> </th>-->
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pedidos as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php //echo $p['pedido_id']; ?></td>-->
                        <td style="white-space: nowrap"><font size="3"><b><?php echo $p['cliente_nombre']; ?></b></font> <br>
                        <?php echo $p['cliente_nombrenegocio']; ?><br>
                        <?php echo $p['pedido_fecha']; ?><br>
                        
                        </td>
                        <td align="center" bgcolor="<?php echo $p['estado_color']; ?>">
                            <a href="<?php echo base_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>">
                            <font size="3"><b><?php echo "00".$p['pedido_id']; ?></b></font> <br>
                            <font size="1"><?php echo $p['estado_descripcion']; ?></font>
                            </a>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?>
                        </td>
                         
                        
                        <td align="right" style="white-space: nowrap" ><?php echo "Sub Total: ".number_format($p['pedido_subtotal'],'2','.',','); ?><br>
                                          <?php echo "Desc.: ".number_format($p['pedido_descuento'],'2','.',','); ?><br>  
                                          <font size="3"><b><?php echo number_format($p['pedido_total'],'2','.',','); ?></b></font></td>
                        
<!--                        <td>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?></td>-->

                        <td>
                            <a href="<?php echo site_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>" class="btn btn-success btn-sm"><span class="fa fa-cubes" title="Ver detalle del pedido"></span></a>
                            <!--<a href="<?php echo site_url('pedido/pasaraventas/'.$p['pedido_id']); ?>" class="btn btn-warning btn-sm"><span class="fa fa-arrow-down" title="Añadir pedido a ventas"></span></a>-->
                            <button  class="btn btn-warning btn-sm" data-dismiss="modal" onclick="pasaraventas(<?php echo $p['pedido_id']; ?>,<?php echo $p['usuario_id']; ?>,<?php echo $p['cliente_id']; ?>)"><span class="fa fa-arrow-down" title="Cargar pedido a ventas"></span> </button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
             
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
            
    <?php if($parametro[0]['parametro_mostrarcategoria']>0){ ?>
            <script type="text/javascript">   
               tablaresultados(2);
            </script>
     <?php       }
    ?>