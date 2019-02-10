<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Factura Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Factura Id</th>
						<th>Usuario Id</th>
						<th>Factura Numero</th>
						<th>Factura Fecha</th>
						<th>Factura Nit</th>
						<th>Factura Razon</th>
						<th>Factura Importe</th>
						<th>Factura Autorizacion</th>
						<th>Factura Poliza</th>
						<th>Factura Ice</th>
						<th>Factura Exento</th>
						<th>Factura Neto</th>
						<th>Factura Creditofiscal</th>
						<th>Factura Codigocontrol</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($factura as $f){ ?>
                    <tr>
						<td><?php echo $f['factura_id']; ?></td>
						<td><?php echo $f['usuario_id']; ?></td>
						<td><?php echo $f['factura_numero']; ?></td>
						<td><?php echo $f['factura_fecha']; ?></td>
						<td><?php echo $f['factura_nit']; ?></td>
						<td><?php echo $f['factura_razon']; ?></td>
						<td><?php echo $f['factura_importe']; ?></td>
						<td><?php echo $f['factura_autorizacion']; ?></td>
						<td><?php echo $f['factura_poliza']; ?></td>
						<td><?php echo $f['factura_ice']; ?></td>
						<td><?php echo $f['factura_exento']; ?></td>
						<td><?php echo $f['factura_neto']; ?></td>
						<td><?php echo $f['factura_creditofiscal']; ?></td>
						<td><?php echo $f['factura_codigocontrol']; ?></td>
						<td>
                            <a href="<?php echo site_url('factura/edit/'.$f['factura_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('factura/remove/'.$f['factura_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
