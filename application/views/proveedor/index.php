<!----------------------------- script buscador --------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
   /* function buscarproveedor(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
            var base_url = document.getElementById('base_url').value;
            var filtro = document.getElementById('filtrar').value;
            location.href=base_url+"proveedor/buscarproveedor/"+filtro;
        }
    }*/
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<style type="text/css">
    td img{
        width: 50px;
        height: 50px;
        margin-right: 5px;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Proveedor</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('proveedor/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el código, nombre, contacto, nit">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						
						<th>Nombre</th>
						<th>Contacto</th>
						<th>Nit</th>
						<th>Razón</th>
						<th>Estado</th>
						<!--<th>Autorización</th>-->
						<th></th>
                    <tbody class="buscar">
                    <?php $i = 0;
                          foreach($proveedor as $p){;
                            $colorbaja = "";
                            if($p['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$p['estado_color']."'";
                            }  
                                 $i = $i+1; ?>
                    <tr <?php echo $colorbaja; ?>>
                            <td><?php echo $i; ?></td>
                            <td><div id="horizontal"><?php if ($p['proveedor_foto']!=NULL && $p['proveedor_foto']!="") { ?>
                                    <div>
                                        <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $i; ?>" style="padding: 2px;">
                                        <?php
                                        echo '<img src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" />';
                                        ?>
                                    </a>
                                    
                                    </div>
                                    <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $p['proveedor_nombre']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="height: 100%; width: 100%" src="'.site_url('/resources/images/proveedores/'.$p['proveedor_foto']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                            <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                             <?php } else { ?>
                                    
                                        <img src="<?php echo site_url('/resources/images/default.jpg');  ?>" />
                                   
                                    <?php }  ?>
                                    <div><?php
                                        echo $p['proveedor_nombre']."<br>";
                                        echo "<b>Cod: </b>".$p['proveedor_codigo']."<br>";
                                        echo "<b>Dir.: </b>".$p['proveedor_direccion']."<br>";
                                        echo "<b>Email: </b>".$p['proveedor_email'];
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $p['proveedor_contacto']; ?></br>
                            <b>Telf.:</b> <?php echo $p['proveedor_telefono']; ?>-<?php echo $p['proveedor_telefono2']; ?></td>
                            <td><?php echo $p['proveedor_nit']; ?></td>
                            <td><?php echo $p['proveedor_razon']; ?></td>
                            <td style="background-color: <?php echo $p['estado_color']; ?>; text-align: center;"><?php echo $p['estado_descripcion']; ?></td>

                            <!--<td><?php //echo $p['proveedor_autorizacion']; ?></td>-->
                            <td>
                            <a href="<?php echo site_url('proveedor/edit/'.$p['proveedor_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <?php if ($p['estado_id']==1) { ?>
                            <a href="<?php echo site_url('proveedor/inactivar/'.$p['proveedor_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <?php }else{ ?>
                            <a href="<?php echo site_url('proveedor/activar/'.$p['proveedor_id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-repeat"  title="Activar"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
        <?php
            if($a =="1"){
                ?>
                <a href="<?php echo site_url('proveedor'); ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Atras</a>
            <?php
            }
            ?>
    </div>
</div>
