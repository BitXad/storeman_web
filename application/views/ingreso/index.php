<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ingreso Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('ingreso/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Ingreso Id</th>
						<th>Estado Id</th>
						<th>Unidad Id</th>
						<th>Pedido Id</th>
						<th>Usuario Id</th>
						<th>Ingreso Numdoc</th>
						<th>Ingreso Fecha</th>
						<th>Ingreso Hora</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($ingreso as $i){ ?>
                    <tr>
						<td><?php echo $i['ingreso_id']; ?></td>
						<td><?php echo $i['estado_id']; ?></td>
						<td><?php echo $i['unidad_id']; ?></td>
						<td><?php echo $i['pedido_id']; ?></td>
						<td><?php echo $i['usuario_id']; ?></td>
						<td><?php echo $i['ingreso_numdoc']; ?></td>
						<td><?php echo $i['ingreso_fecha']; ?></td>
						<td><?php echo $i['ingreso_hora']; ?></td>
						<td>
                            <a href="<?php echo site_url('ingreso/edit/'.$i['ingreso_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('ingreso/remove/'.$i['ingreso_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
