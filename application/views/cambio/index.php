<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cambio Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('cambio/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cambio Id</th>
						<th>Gestion Id</th>
						<th>Cambio Fecha</th>
						<th>Cambio Ufv</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($cambio as $c){ ?>
                    <tr>
						<td><?php echo $c['cambio_id']; ?></td>
						<td><?php echo $c['gestion_id']; ?></td>
						<td><?php echo $c['cambio_fecha']; ?></td>
						<td><?php echo $c['cambio_ufv']; ?></td>
						<td>
                            <a href="<?php echo site_url('cambio/edit/'.$c['cambio_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('cambio/remove/'.$c['cambio_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
