<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Institución</h3>
    <div class="box-tools">
        <?php
        if($newinst == 0){
        ?>
            <a href="<?php echo site_url('institucion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a>
        <?php } ?>
        <?php
        if($newinst == 1){
        ?>
            <a href="<?php echo site_url('institucion/edit/'.$institucion[0]['institucion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modificar</a> 
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Sucursal</th>
                        <th>Dirección</th>
                        <th>Ubicación</th>
                        <th>Teléfono</th>
                        <th>Nit</th>
                        <th>Autorización</th>
                        <th>Eslogan</th>
                    </tr>
                    <?php
                        $i = 0;
                        foreach($institucion as $in){ ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $in['institucion_nombre']; ?></td>
                        <td><?php echo $in['institucion_sucursal']; ?></td>
                        <td><?php echo $in['institucion_direccion']; ?></td>
                        <td><?php echo $in['institucion_ubicacion']; ?></td>
                        <td><?php echo $in['institucion_telef']; ?></td>
                        <td><?php echo $in['institucion_nit']; ?></td>
                        <td><?php echo $in['institucion_autorizacion']; ?></td>
                        <td><?php echo $in['institucion_eslogan']; ?></td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
