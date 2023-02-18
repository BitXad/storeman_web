<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalle Ingreso Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_ingreso/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Detalleing Id</th>
						<th>Proveedor Id</th>
						<th>Factura Id</th>
						<th>Articulo Id</th>
						<th>Ingreso Id</th>
						<th>Programa Id</th>
						<th>Detalleing Cantidad</th>
						<th>Detalleing Precio</th>
						<th>Detalleing Total</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($detalle_ingreso as $d){ ?>
                    <tr>
						<td><?php echo $d['detalleing_id']; ?></td>
						<td><?php echo $d['proveedor_id']; ?></td>
						<td><?php echo $d['factura_id']; ?></td>
						<td><?php echo $d['articulo_id']; ?></td>
						<td><?php echo $d['ingreso_id']; ?></td>
						<td><?php echo $d['programa_id']; ?></td>
						<td><?php echo $d['detalleing_cantidad']; ?></td>
						<td><?php echo $d['detalleing_precio']; ?></td>
						<td><?php echo $d['detalleing_total']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_ingreso/edit/'.$d['detalleing_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modificar</a> 
                            <a href="<?php echo site_url('detalle_ingreso/remove/'.$d['detalleing_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
