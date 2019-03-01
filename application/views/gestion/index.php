<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Gestión</h3>
    <div class="text-center text-bold" style="font-size: 15pt"><?php echo $institucion[0]['institucion_nombre']; ?></div>
    <div class="box-tools">
        <a href="<?php echo site_url('gestion/add'); ?>" class="btn btn-success btn-sm">+ Abrir Gestión</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <?php
                    
                    
                        $i = 0;
                        foreach($gestion as $g){ 
        
                            $color = "style='background-color: ".$g['estado_color']."'"; 
                            
                            ?>
                    <tr>
                        <td <?php echo $color; ?> ><?php echo $i+1; ?></td>
                        <td <?php echo $color; ?> ><?php echo $g['gestion_nombre']; ?></td>
                        <td <?php echo $color; ?> ><?php echo $g['gestion_descripcion']; ?></td>
                        <td <?php echo $color; ?> ><?php if($g['gestion_inicio'] >0){ echo date("d/m/Y", strtotime($g['gestion_inicio'])); } ?></td>
                        <td <?php echo $color; ?> ><?php if($g['gestion_fin'] >0){ echo date("d/m/Y", strtotime($g['gestion_fin'])); } ?></td>
                        <td <?php echo $color; ?> ><?php echo $g['estado_descripcion']; ?></td>
                        <td <?php echo $color; ?> >
                            <a href="<?php echo site_url('gestion/edit/'.$g['gestion_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a> 
                            <!--<a data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
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
                                       ¿Desea eliminar la Gestion <b> <?php echo $g['gestion_nombre']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('gestion/remove/'.$g['gestion_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
