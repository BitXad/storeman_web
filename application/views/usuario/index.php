<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuario Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Usuario Id</th>
						<th>Tipousuario Id</th>
						<th>Estado Id</th>
						<th>Usuario Nombre</th>
						<th>Usuario Email</th>
						<th>Usuario Login</th>
						<th>Usuario Clave</th>
						<th>Usuario Imagen</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($usuario as $u){ ?>
                    <tr>
						<td><?php echo $u['usuario_id']; ?></td>
						<td><?php echo $u['tipousuario_id']; ?></td>
						<td><?php echo $u['estado_id']; ?></td>
						<td><?php echo $u['usuario_nombre']; ?></td>
						<td><?php echo $u['usuario_email']; ?></td>
						<td><?php echo $u['usuario_login']; ?></td>
						<td><?php echo $u['usuario_clave']; ?></td>
						<td><?php echo $u['usuario_imagen']; ?></td>
						<td>
                            <a href="<?php echo site_url('usuario/edit/'.$u['usuario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('usuario/remove/'.$u['usuario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
