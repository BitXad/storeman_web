<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<style type="text/css">
    #contieneimg{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
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
<div class="box-header">
    <h3 class="box-title">Pedido</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('pedido/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Unidad</th>
                        <th>Pedido</th>            
                        <th>Fecha</th>
                        <th>Archivo</th>
                        <th>Imagen</th>
                        <th>Gestión</th>
                        <th></th>
                    </tr>
                    <?php
                        $i = 0;
                        foreach($pedido as $p){  $colorbaja = "";
                           
                                $colorbaja = "style='background-color:".$p['estado_color']."'";?>
                           
                    <tr <?php echo $colorbaja; ?>>
                        
                        <td <?php echo $colorbaja; ?>><?php echo $i+1; ?></td>
                        <td <?php echo $colorbaja; ?>>
                            <font size="3"><b><?php echo $p['unidad_nombre']; ?></b></font>
                            <br><?php echo $p['programa_nombre']; ?>
                        </td>
                        <td <?php echo $colorbaja; ?>> 
                            <center>                        
                                <font size="3"><b><?php echo $p['pedido_numero']; ?></b></font>
                                <br><?php echo date("d/m/Y", strtotime($p['pedido_fechapedido'])); ?>
                            </center>
                        </td>
                        
                        
                        <td <?php echo $colorbaja; ?>>
                            <center>                            
                            <?php echo date("d/m/Y", strtotime($p['pedido_fecha']))." <br> ".$p['pedido_hora']; ?>
                            </center>
                        </td>
                        <td <?php echo $colorbaja; ?>><?php echo $p['pedido_archivo']; ?></td>
                        <td <?php echo $colorbaja; ?>>
                            
                            <div id="contieneimg">
                                <?php
                                $mimagen = "thumb_".$p['pedido_imagen'];
                                if($p['pedido_imagen']){
                                ?>
                                <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $i; ?>" style="padding: 0px;">
                                    <?php
                                    echo '<img src="'.site_url('/resources/images/pedidos/imagenes/'.$mimagen).'" />';
                                    ?>
                                </a>
                                <?php }
                                /*else{
                                   echo '<img style src="'.site_url('/resources/images/usuarios/thumb_default.jpg').'" />'; 
                                }*/
                                ?>
                            </div>
                            
                        </td>
                        
                        <td style="background-color: <?php echo $p['estado_color']; ?>">
                            <center>
                                <?php echo $p['gestion_nombre']; ?><br>
                                <?php echo $p['estado_descripcion']; ?>

                            </center>
                        </td>
                        <td>
                            <a href="<?php echo site_url('pedido/edit/'.$p['pedido_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a>
                            <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                            <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea eliminar el Pedido <b> <?php echo $p['pedido_numero']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('pedido/remove/'.$p['pedido_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $p['pedido_numero']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/pedidos/imagenes/'.$p['pedido_imagen']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
