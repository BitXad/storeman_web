<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Unidad Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('unidad/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Unidad Id</th>
						<th>Unidad Nombre</th>
						<th>Unidad Codigo</th>
						<th>Unidad Descripcion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($unidad as $u){ ?>
                    <tr>
						<td><?php echo $u['unidad_id']; ?></td>
						<td><?php echo $u['unidad_nombre']; ?></td>
						<td><?php echo $u['unidad_codigo']; ?></td>
						<td><?php echo $u['unidad_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('unidad/edit/'.$u['unidad_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('unidad/remove/'.$u['unidad_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
