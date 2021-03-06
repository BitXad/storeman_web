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
<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="box-header">
    <h3 class="box-title">Responsable</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('responsable_pago/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre" autocomplete="off">
        </div>
        <!--------------------- fin parametro de buscador ---------------------> 
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                        $i = 0;
                        foreach($responsable as $j){
                            $colorbaja = "";
                            if($j['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$j['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $j['responsable_nombre']; ?></td>
                        <td style="background-color: <?php echo $j['estado_color']; ?>"><?php echo $j['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('responsable_pago/edit/'.$j['responsable_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span></a> 
                            <?php if($j['estado_id']==1) { ?>
                            <a href="<?php echo site_url('responsable_pago/inactivar/'.$j['responsable_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <?php }else{ ?>
                            <a href="<?php echo site_url('responsable_pago/activar/'.$j['responsable_id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-repeat"  title="Activar"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
