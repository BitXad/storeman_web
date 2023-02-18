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
<input type="text" id="decimales" value="<?php echo $parametros["parametro_decimalesoperaciones"]; ?>" hidden/>
<?php $decimales = $parametros["parametro_decimalesoperaciones"]; ?>

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
                        $colorbaja = "";
                            if($p['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$p['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                                                <td ><?php echo $n++; ?></td>
                                                <td ><?php echo $p['programa_nombre']; ?><sub>[<?php echo $p['programa_id']; ?>]</sub></td>
						<td ><?php echo $p['programa_codigo']; ?></td>
						<td ><?php echo $p['programa_descripcion']; ?></td>						
						<td ><?php echo $p['unidad_nombre']; ?></td>
						<td style="background-color: <?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>
						<td >
                                                    <a href="<?php echo site_url('programa/edit/'.$p['programa_id']); ?>" class="btn btn-info btn-xs" title="Modificar"><span class="fa fa-pencil"></span> </a> 
                            
                            <?php if ($p['estado_id']==1) { ?>
                            <a href="<?php echo site_url('programa/inactivar/'.$p['programa_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <?php }else{ ?>
                            <a href="<?php echo site_url('programa/activar/'.$p['programa_id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-repeat"  title="Activar"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
