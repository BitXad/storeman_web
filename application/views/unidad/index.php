<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Unidad</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('unidad/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Estado</th>
						<th>Nombre</th>
						<th>Codigo</th>
						<th>Descripcion</th>
						<th></th>
                    </tr>
                    <?php $cont = 0;

                    foreach($unidad as $u){
                        $colorbaja = "";
                            if($u['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$u['estado_color']."'";
                            }  
                        $cont = $cont+1; ?>
                    <tr <?php echo $colorbaja; ?>>
						<td><?php echo $cont; ?></td>
						<td><?php echo $u['estado_descripcion']; ?></td>
						<td><?php echo $u['unidad_nombre']; ?></td>
						<td><?php echo $u['unidad_codigo']; ?></td>
						<td><?php echo $u['unidad_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('unidad/edit/'.$u['unidad_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('unidad/inactivar/'.$u['unidad_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                           <!-- <a href="<?php echo site_url('unidad/remove/'.$u['unidad_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
