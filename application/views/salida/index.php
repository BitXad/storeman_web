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
						<th>Salida Id</th>
						<th>Estado Id</th>
						<th>Unidad Id</th>
						<th>Gestion Id</th>
						<th>Usuario Id</th>
						<th>Salida Motivo</th>
						<th>Salida Fecha</th>
						<th>Salida Acta</th>
						<th>Salida Obs</th>
						<th>Salida Fechahora</th>
						<th>Salida Doc</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($salida as $s){ ?>
                    <tr>
						<td><?php echo $s['salida_id']; ?></td>
						<td><?php echo $s['estado_id']; ?></td>
						<td><?php echo $s['unidad_id']; ?></td>
						<td><?php echo $s['gestion_id']; ?></td>
						<td><?php echo $s['usuario_id']; ?></td>
						<td><?php echo $s['salida_motivo']; ?></td>
						<td><?php echo $s['salida_fecha']; ?></td>
						<td><?php echo $s['salida_acta']; ?></td>
						<td><?php echo $s['salida_obs']; ?></td>
						<td><?php echo $s['salida_fechahora']; ?></td>
						<td><?php echo $s['salida_doc']; ?></td>
						<td>
                            <a href="<?php echo site_url('salida/edit/'.$s['salida_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('salida/remove/'.$s['salida_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
