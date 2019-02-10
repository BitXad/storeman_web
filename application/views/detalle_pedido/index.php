<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalle Pedido Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_pedido/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Detalleped Id</th>
						<th>Pedido Id</th>
						<th>Programa Id</th>
						<th>Unidad Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($detalle_pedido as $d){ ?>
                    <tr>
						<td><?php echo $d['detalleped_id']; ?></td>
						<td><?php echo $d['pedido_id']; ?></td>
						<td><?php echo $d['programa_id']; ?></td>
						<td><?php echo $d['unidad_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_pedido/edit/'.$d['detalleped_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('detalle_pedido/remove/'.$d['detalleped_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
