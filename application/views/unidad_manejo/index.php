<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
<div class="box-header">
    <h3 class="box-title">Unidad de Manejo</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('unidad_manejo/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="box-header">
    <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingresar Nombre" autocomplete="off" >
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php
                        $i = 0;
                        foreach($unidad_manejo as $u){
                            $colorbaja = "";
                            if($u['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$u['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $u['umanejo_descripcion']; ?></td>
                        <td style="background-color: <?php echo $u['estado_color']; ?>"><?php echo $u['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('unidad_manejo/edit/'.$u['umanejo_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span></a> 
                            <?php if ($u['estado_id']==1) { ?>
                            <a href="<?php echo site_url('unidad_manejo/inactivar/'.$u['umanejo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <?php }else{ ?>
                            <a href="<?php echo site_url('unidad_manejo/activar/'.$u['umanejo_id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-repeat"  title="Activar"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
