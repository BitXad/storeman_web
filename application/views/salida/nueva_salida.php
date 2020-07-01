<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/salida.js'); ?>"></script>

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
<script type="text/javascript">
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->

<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<input type="text" value="<?php echo $bandera; ?>" id="bandera" hidden>



<div class="box-header with-border">
    <h3 class="box-title">Salida</h3>
</div>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <!---?php echo form_open('salida/add'); ?--->
          	<div class="box-body">
          		<div class="row clearfix">
                            
					<div class="col-md-5">
						<label for="programa_id" class="control-label">Programa</label>
						<div class="form-group">
							<select name="programa_id" class="form-control" id="programa_id" onchange="tablaresultados(3)">
								<option value="0">- PROGRAMA -</option>
								<?php 
								foreach($all_programa as $programa)
								{
									$selected = ($programa['programa_id'] == $salida['programa_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$programa['programa_id'].'" '.$selected.'>'.$programa['programa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                            
					<div class="col-md-5">
						<label for="unidad_id" class="control-label">Unidad/Motivo</label>
						<div class="form-group">
                                                    <!--<select name="unidad_id" class="form-control"  id="unidad_id" onchange="tablaresultados(3)">-->
                                                    <select name="unidad_id" class="form-control"  id="unidad_id">
								<option value="0">- UNIDAD -</option>
								<?php 
								foreach($all_unidad as $unidad)
								{
									$selected = ($unidad['unidad_id'] == $salida['unidad_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$unidad['unidad_id'].'" '.$selected.'>'.$unidad['unidad_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>

                            
					<div class="col-md-2" hidden>
						<label for="salida_id" class="control-label">Salida id</label>
						<div class="form-group">
							<input type="text" name="salida_id" id="salida_id" value="<?php echo $salida_id; ?>" class="form-control" id="salida_id" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="salida_doc" class="control-label">Doc. Nº</label>
						<div class="form-group">
							<input type="text" name="salida_doc" value="<?php echo ($this->input->post('salida_doc') ? $this->input->post('salida_doc') : $salida['salida_doc']); ?>" class="form-control" id="salida_doc" />
						</div>
					</div>

                            
					<div class="col-md-5">
						<label for="salida_fechasal" class="control-label">Fecha/Salida</label>
						<div class="form-group">
							<input type="date" name="salida_fechasal" value="<?php echo ($this->input->post('salida_fechasal') ? $this->input->post('salida_fechasal') : $salida['salida_fechasal']); ?>" class="form-control" id="salida_fechasal" />
						</div>
					</div>
                            
					<div class="col-md-7">
						<label for="salida_acta" class="control-label">Acta</label>
						<div class="form-group">
							<input type="text" name="salida_acta" value="<?php echo ($this->input->post('salida_acta') ? $this->input->post('salida_acta') : $salida['salida_acta']); ?>" class="form-control" id="salida_acta" />
						</div>
					</div>


				</div>
			</div>
                        
                        

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
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código" onkeypress="validar(event,4);">
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria" style="padding: 0px">
    
    <span class="badge btn-danger">
    
    Categoria:     
    
    <select class="bange btn-danger" style="border-width: 0;" onchange="tablaresultados(2)" id="categoria_id">
                <option value="0" >Todas</option>
        <?php 
            foreach($all_categoria as $categ){ 
               
                ?>
                
                <option value="<?php echo $categ['categoria_id']; ?>"><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
    </select>


    
    </span>
    
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-danger">Articulos: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                <span class="badge btn-default">

                    <!--------------------- inicio loader ------------------------->
                    <div class="row" id='oculto'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
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
            
            <button onclick='actualizar_inventario()' class='btn btn-success btn-xs'><span class='fa fa-cubes'></span><b> Actualizar Inventario</b></button> 
            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> 
            <!--<a onclick="finalizar_salida()"  class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a>  -->
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            <div class="col-md-4" style="background-color: black;">
                <center>
                    
                <font size="4" style="color:white">
                    
                
                <b>Total Final</b>
                <b>Bs </b> <br>
                <span id="eltotal"></span>
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
                <button onclick="finalizar_salida()" id="botox" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
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

<!------------------------ INICIO modal para confirmar eliminación ------------------->
<div class="modal fade" id="modalalerta" tabindex="-1" role="dialog" aria-labelledby="modalalertaLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
               <!------------------------------------------------------------------->
               <span class="fa fa-exclamation-triangle" style="font-size: 20pt"></span>
               <span style="font-size: 12pt">no se ha seleccionado programa, pero ya tienes articulos para la salida!!</span>
               <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-check"></span> Aceptar </a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para confirmar eliminación ------------------->
