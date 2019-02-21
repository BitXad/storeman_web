<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
            <div class="box-header">
                <h3 class="box-title">Programas</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('programa/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                </div>
            </div>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped"  id="mitabla">
                    <tr>
						<th>#</th>
						<th>Programa</th>
						<th>Codigo</th>
						<th>Descripcion</th>
						<th>Unidad</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <?php $n = 1; 
                        foreach($programa as $p){ 
                        $e = $estado[$p['estado_id']-1]['estado_descripcion'];
                        $u = $unidad[$p['unidad_id']-1]['unidad_nombre'];
                        ?>
                    <tr>
                                                <td><?php echo $n++; ?></td>
                                                <td><?php echo $p['programa_nombre']; ?><sub>[<?php echo $p['programa_id']; ?>]</sub></td>
						<td><?php echo $p['programa_codigo']; ?></td>
						<td><?php echo $p['programa_descripcion']; ?></td>						
						<td><?php echo $u; ?></td>
						<td><?php echo $e; ?></td>
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
