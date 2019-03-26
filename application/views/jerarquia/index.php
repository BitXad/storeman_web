<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="box-header">
    <h3 class="box-title">Niveles Jerárquicos</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('jerarquia/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <?php
                        $i = 0;
                        foreach($jerarquia as $j){
                            $colorbaja = "";
                            if($j['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$j['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $j['jerarquia_nombre']; ?></td>
                        <td style="background-color: <?php echo $j['estado_color']; ?>"><?php echo $j['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('jerarquia/edit/'.$j['jerarquia_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('jerarquia/remove/'.$j['jerarquia_id']); ?>" class="btn btn-danger btn-xs" title="Eliminar"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
