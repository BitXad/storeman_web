<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Articulo Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('articulo/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Articulo Id</th>
						<th>Estado Id</th>
						<th>Categoria Id</th>
						<th>Articulo Nombre</th>
						<th>Articulo Marca</th>
						<th>Articulo Industria</th>
						<th>Articulo Codigo</th>
						<th>Articulo Saldo</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($articulo as $a){ ?>
                    <tr>
						<td><?php echo $a['articulo_id']; ?></td>
						<td><?php echo $a['estado_id']; ?></td>
						<td><?php echo $a['categoria_id']; ?></td>
						<td><?php echo $a['articulo_nombre']; ?></td>
						<td><?php echo $a['articulo_marca']; ?></td>
						<td><?php echo $a['articulo_industria']; ?></td>
						<td><?php echo $a['articulo_codigo']; ?></td>
						<td><?php echo $a['articulo_saldo']; ?></td>
						<td>
                            <a href="<?php echo site_url('articulo/edit/'.$a['articulo_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('articulo/remove/'.$a['articulo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
