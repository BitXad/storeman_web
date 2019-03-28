<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<!----------------------------- fin script buscador --------------------------------------->
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
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingresar descripción, tipo" onkeyup="this.value = this.value.uppecase();">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->            
            <div class="box-body table-responsive">
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
                    <tbody class="buscar">
                        
                    <?php $n = 1; 
                        foreach($programa as $p){ 
                        /*$e = $estado[$p['estado_id']-1]['estado_descripcion'];
                        $u = $unidad[$p['unidad_id']-1]['unidad_nombre'];
                        */
                        if ($p['estado_id']<>1) $color = "bgcolor='".$estado[$p['estado_id']-1]['estado_color']."'";
                        else $color ="";
                        ?>
                    <tr>
                                                <td <?php echo $color; ?>><?php echo $n++; ?></td>
                                                <td <?php echo $color; ?>><?php echo $p['programa_nombre']; ?><sub>[<?php echo $p['programa_id']; ?>]</sub></td>
						<td <?php echo $color; ?>><?php echo $p['programa_codigo']; ?></td>
						<td <?php echo $color; ?>><?php echo $p['programa_descripcion']; ?></td>						
						<td <?php echo $color; ?>><?php echo $p['unidad_nombre']; ?></td>
						<td <?php echo $color; ?>><?php echo $p['estado_descripcion']; ?></td>
						<td <?php echo $color; ?>>
                                                    <a href="<?php echo site_url('programa/edit/'.$p['programa_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span> </a> 
                            <a href="<?php echo site_url('programa/inactivar/'.$p['programa_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span> </a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
