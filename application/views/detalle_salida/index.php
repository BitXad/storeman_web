<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalle Salida Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_salida/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Detallesal Id</th>
						<th>Salida Id</th>
						<th>Articulo Id</th>
						<th>Programa Id</th>
						<th>Detallesal Cantidad</th>
						<th>Detallesal Precio</th>
						<th>Detallesal Total</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($detalle_salida as $d){ ?>
                    <tr>
						<td><?php echo $d['detallesal_id']; ?></td>
						<td><?php echo $d['salida_id']; ?></td>
						<td><?php echo $d['articulo_id']; ?></td>
						<td><?php echo $d['programa_id']; ?></td>
						<td><?php echo $d['detallesal_cantidad']; ?></td>
						<td><?php echo $d['detallesal_precio']; ?></td>
						<td><?php echo $d['detallesal_total']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_salida/edit/'.$d['detallesal_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('detalle_salida/remove/'.$d['detallesal_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
