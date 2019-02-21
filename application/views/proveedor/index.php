<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Proveedor Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('proveedor/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Proveedor Id</th>
						<th>Estado Id</th>
						<th>Proveedor Codigo</th>
						<th>Proveedor Nombre</th>
						<th>Proveedor Direccion</th>
						<th>Proveedor Telefono</th>
						<th>Proveedor Celular</th>
						<th>Proveedor Email</th>
						<th>Proveedor Contacto</th>
						<th>Proveedor Nit</th>
						<th>Proveedor Razon</th>
						<th>Proveedor Autorizacion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($proveedor as $p){ ?>
                    <tr>
						<td><?php echo $p['proveedor_id']; ?></td>
						<td><?php echo $p['estado_id']; ?></td>
						<td><?php echo $p['proveedor_codigo']; ?></td>
						<td><?php echo $p['proveedor_nombre']; ?></td>
						<td><?php echo $p['proveedor_direccion']; ?></td>
						<td><?php echo $p['proveedor_telefono']; ?></td>
						<td><?php echo $p['proveedor_celular']; ?></td>
						<td><?php echo $p['proveedor_email']; ?></td>
						<td><?php echo $p['proveedor_contacto']; ?></td>
						<td><?php echo $p['proveedor_nit']; ?></td>
						<td><?php echo $p['proveedor_razon']; ?></td>
						<td><?php echo $p['proveedor_autorizacion']; ?></td>
						<td>
                            <a href="<?php echo site_url('proveedor/edit/'.$p['proveedor_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('proveedor/remove/'.$p['proveedor_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
