<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>


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

function mostrar_ocultar(){
    var x = document.getElementById('tipo_transaccion').value;
    if (x=='2'){ //si la transaccion es a credito
        
        document.getElementById('creditooculto').style.display = 'block';
//        var hoy = new Date();
//        var dd = hoy.getDate();
//        var mm = hoy.getMonth()+1;
//        var yyyy = hoy.getFullYear();
//        
//        dd = addZero(dd);
//        mm = addZero(mm);

        }
    else{
        document.getElementById('oculto').style.display = 'none';}
}
        
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->


<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<!--<input type="text" id="pedido_id" value="0" name="pedido_id"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio"  hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id"  hidden>
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>-->



<div class="box-header with-border">
    <h3 class="box-title">Salida</h3>
</div>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <!---?php echo form_open('salida/add'); ?--->
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
							<select name="programa_id" class="form-control" id="programa_id" >
								<option value="0">- PROGRAMA -</option>
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
							<select name="unidad_id" class="form-control"  id="unidad_id">
								<option value="0">- UNIDAD -</option>
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
					<div class="col-md-2" hidden>
						<label for="salida_doc" class="control-label">Salida id</label>
						<div class="form-group">
							<input type="text" name="salida_id" id="salida_id" value="<?php echo $salida_id; ?>" class="form-control" id="salida_id" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="salida_doc" class="control-label">Salida Doc</label>
						<div class="form-group">
							<input type="text" name="salida_doc" id="salida_doc" value="<?php echo $this->input->post('salida_doc'); ?>" class="form-control" id="salida_doc" />
						</div>
					</div>

                            
					<div class="col-md-5">
						<label for="salida_fechasal" class="control-label">Fecha/Salida</label>
						<div class="form-group">
							<input type="date" name="salida_fechasal" id="salida_fechasal" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="salida_fechasal" />
						</div>
					</div>
                            
					<div class="col-md-7">
						<label for="salida_acta" class="control-label">Acta</label>
						<div class="form-group">
							<input type="text" name="salida_acta" id="salida_acta" value="<?php echo $this->input->post('salida_acta'); ?>" class="form-control" id="salida_acta" />
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
<!--          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>-->
            <!--?php echo form_close(); ?--->
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
<!--            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0'></span><b> - 0 -</b></button> 
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money'></span><b> costo</b></button> -->
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
                <button onclick="finalizar_salida()" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>
               Finalizar Salida <br>
            </button>


            <a  href="<?php echo site_url('salida'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Salir <br>
            </a>    

            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->

    </div>
    
</div>

