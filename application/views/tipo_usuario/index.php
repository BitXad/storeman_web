<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tipo Usuario Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tipo_usuario/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Tipousuario Id</th>
						<th>Tipousuario Descripcion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($tipo_usuario as $t){ ?>
                    <tr>
						<td><?php echo $t['tipousuario_id']; ?></td>
						<td><?php echo $t['tipousuario_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('tipo_usuario/edit/'.$t['tipousuario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('tipo_usuario/remove/'.$t['tipousuario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
