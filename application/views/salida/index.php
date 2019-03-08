
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Salida</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('salida/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Acta</th>
                        <th>Obs.</th>
                        <th>Fecha/hora</th>
                        <th>Doc.</th>
                        <th>Unidad</th>
                        <th>Gestión</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <?php
                        $i = 0;
                        foreach($salida as $s){ ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $s['salida_motivo']; ?></td>
                        <td><?php if($s['salida_fecha']>0){echo date("d/m/Y", strtotime($s['salida_fecha']));} ?></td>
                        <td><?php echo $s['salida_acta']; ?></td>
                        <td><?php echo $s['salida_obs']; ?></td>
                        <td><?php if($s['salida_fechahora'] >0){ echo date("d/m/Y H:i:s", strtotime($s['salida_fechahora']));} ?></td>
                        <td><?php echo $s['salida_doc']; ?></td>
                        <td><?php echo $s['unidad_nombre']; ?></td>
                        <td><?php echo $s['gestion_nombre']; ?></td>
                        <td><?php echo $s['usuario_nombre']; ?></td>
                        <td style="background-color: <?php echo $s['estado_color'] ?>"><?php echo $s['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('salida/edit/'.$s['salida_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a> 
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
                                       ¿Desea eliminar la Salida <b> <?php echo $s['salida_motivo']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('salida/remove/'.$s['salida_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
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
