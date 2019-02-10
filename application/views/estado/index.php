<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Estado Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('estado/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Estado Id</th>
						<th>Estado Descripcion</th>
						<th>Estado Tipo</th>
						<th>Estado Color</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($estado as $e){ ?>
                    <tr>
						<td><?php echo $e['estado_id']; ?></td>
						<td><?php echo $e['estado_descripcion']; ?></td>
						<td><?php echo $e['estado_tipo']; ?></td>
						<td><?php echo $e['estado_color']; ?></td>
						<td>
                            <a href="<?php echo site_url('estado/edit/'.$e['estado_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('estado/remove/'.$e['estado_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
