<!-- --------------------------- script buscador ------------------------------------- -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<style type="text/css">
    #contieneimg{
        width: 100px;
        height: 100px;
        text-align: center;
    }
</style>
<!-- --------------------------- fin script buscador ------------------------------------- -->
<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="box-header">
                <h3 class="box-title">Usuarios</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!---- ----------------- parametro de buscador ------------------- -->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
                  </div>
            <!-- ------------------- fin parametro de buscador ------------------- -->
        <div class="box">
          
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo Usuario</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                  <?php
                      $i=1;
                      $cont = 0;

                      foreach($usuario as $u) {
                      $cont = $cont+1;
                     /* $path_parts = pathinfo('./resources/images/usuarios/' .$u['usuario_imagen']);
                      $thumb = $path_parts['filename'] . '_thumb.' . $path_parts['extension'];
                      */
                  ?>

                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $u['usuario_nombre']; ?></td>
                        <td style="text-align: center;"><?php echo $u['tipousuario_descripcion']; ?></td>
                        <td style="text-align: center;"><?php echo $u['usuario_email']; ?></td>
                        <td  style="text-align: center;"><?php echo $u['usuario_login']; ?></td>
                        <td><?php if ($u['usuario_imagen']!=NULL && $u['usuario_imagen']!="") { ?>
                          <a class="btn  btn-xs" id="contieneimg" data-toggle="modal" data-target="#mostrarimagen<?php echo $i; ?>" style="padding: 0px;">
                                        <?php
                                        echo '<img src="'.site_url('/resources/images/usuarios/'.$u['usuario_imagen']).'" />';
                                        ?>
                                    </a>
                           <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                    <div class="modal fade" id="mostrarimagen<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $u['usuario_nombre']; ?></b></font>
                                          </div>
                                            <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/usuarios/'.$u['usuario_imagen']).'" />'; ?>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                            <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                             <?php } else { ?>
                                    <div id="contieneimg">
                                        <img src="<?php echo site_url('/resources/images/default.jpg');  ?>" />
                                    </div>
                                    <?php }  ?>
                        </td>
                        <td style="background-color: <?php echo $u['estado_color']; ?>;text-align: center;"><?php echo $u['estado_descripcion']; ?></td>

                        <td>
                            <a href="<?php echo site_url('usuario/edit/'. $u['usuario_id']); ?>" title="EDITAR" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <!--<a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar"><em class="fa fa-trash"></em></a>-->
                            <a href="<?php echo site_url('usuario/password/'.$u['usuario_id']); ?>" title="CAMBIAR CONTRASENA" class="btn btn-success btn-xs"><span class="fa fa-asterisk"></span></a>
                            <?php if($u['estado_id']==1){ ?>
                            <a href="<?php echo site_url('usuario/inactivar/'.$u['usuario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="INACTIVAR"></span></a>
                          <?php }else { ?>
                            <a href="<?php echo site_url('usuario/activar/'.$u['usuario_id']); ?>" class="btn btn-facebook btn-xs"><span class="fa fa-reply"  title="ACTIVAR"></span></a>
                          <?php } ?>
                        </td>
                    </tr>
                  
                             <!-- ---------------------- modal para eliminar el producto ----------------- -->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    <!--        <h4 class="modal-title" id="myModalLabel">LISTA DE PRODUCTOS</h4>-->
                                          </div>
                                          <div class="modal-body">

                                           <!-- --------------------------------------------------------------- -->

                                           <h1><b> <em class="fa fa-trash"></b></em> 
                                               ¿Desea eliminar el usuario <b> <?php echo $u['usuario_nombre']; ?></b> seleccionado?
                                           </h1>
                                           <!-- --------------------------------------------------------------- -->
                                          </div>
                                          <div class="modal-footer aligncenter">


                                                      <a href="<?php echo site_url('usuario/remove/'.$u['usuario_id']); ?>" class="btn btn-danger"><em class="fa fa-pencil"></em> Si </a></a>

                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><em class="fa fa-times"></em> No </a>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    
                   <td hidden="hidden"><?php echo $i++; ?></td>
                    <?php  }?>  
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
