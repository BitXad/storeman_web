<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pedido Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('pedido/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Pedido Id</th>
						<th>Estado Id</th>
						<th>Gestion Id</th>
						<th>Pedido Fecha</th>
						<th>Pedido Hora</th>
						<th>Pedido Archivo</th>
						<th>Pedido Imagen</th>
						<th>Pedido Numero</th>
						<th>Pedido Fechapedido</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($pedido as $p){ ?>
                    <tr>
						<td><?php echo $p['pedido_id']; ?></td>
						<td><?php echo $p['estado_id']; ?></td>
						<td><?php echo $p['gestion_id']; ?></td>
						<td><?php echo $p['pedido_fecha']; ?></td>
						<td><?php echo $p['pedido_hora']; ?></td>
						<td><?php echo $p['pedido_archivo']; ?></td>
						<td><?php echo $p['pedido_imagen']; ?></td>
						<td><?php echo $p['pedido_numero']; ?></td>
						<td><?php echo $p['pedido_fechapedido']; ?></td>
						<td>
                            <a href="<?php echo site_url('pedido/edit/'.$p['pedido_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('pedido/remove/'.$p['pedido_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
