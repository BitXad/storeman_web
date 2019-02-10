<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Programa Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('programa/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Programa Id</th>
						<th>Unidad Id</th>
						<th>Estado Id</th>
						<th>Programa Nombre</th>
						<th>Programa Codigo</th>
						<th>Programa Descripcion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($programa as $p){ ?>
                    <tr>
						<td><?php echo $p['programa_id']; ?></td>
						<td><?php echo $p['unidad_id']; ?></td>
						<td><?php echo $p['estado_id']; ?></td>
						<td><?php echo $p['programa_nombre']; ?></td>
						<td><?php echo $p['programa_codigo']; ?></td>
						<td><?php echo $p['programa_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('programa/edit/'.$p['programa_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('programa/remove/'.$p['programa_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
