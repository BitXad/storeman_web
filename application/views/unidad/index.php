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
    <h3 class="box-title">Unidad/Departamento</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('unidad/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
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
						<th>Nombre</th>
						<th>Código</th>
						<th>Descripción</th>
						<th>Nivel Jerarquico</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $cont = 0;

                    foreach($unidad as $u){
                        $colorbaja = "";
                            if($u['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$u['estado_color']."'";
                            }  
                        $cont = $cont+1; ?>
                    <tr <?php echo $colorbaja; ?>>
						<td><?php echo $cont; ?></td>
						<td><?php echo $u['unidad_nombre']; ?></td>
						<td><?php echo $u['unidad_codigo']; ?></td>
						<td><?php echo $u['unidad_descripcion']; ?></td>
						<td><?php echo $u['jerarquia_nombre']; ?></td>
						<td><?php echo $u['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('unidad/edit/'.$u['unidad_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('unidad/inactivar/'.$u['unidad_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                           <!-- <a href="<?php echo site_url('unidad/remove/'.$u['unidad_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
