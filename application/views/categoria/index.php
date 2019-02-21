<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categoria Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('categoria/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Categoria Id</th>
						<th>Estado Id</th>
						<th>Categoria Nombre</th>
						<th>Categoria Descripcion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($categoria as $c){ ?>
                    <tr>
						<td><?php echo $c['categoria_id']; ?></td>
						<td><?php echo $c['estado_id']; ?></td>
						<td><?php echo $c['categoria_nombre']; ?></td>
						<td><?php echo $c['categoria_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('categoria/edit/'.$c['categoria_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('categoria/remove/'.$c['categoria_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
