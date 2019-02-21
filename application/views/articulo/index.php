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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Artículos</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('articulo/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
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
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Industria</th>
                        <th>Código</th>
                        <th>Saldo</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                        $i = 0;
                        foreach($articulo as $a){
                            $colorbaja = "";
                            if($a['estado_id'] == 2){
                                $colorbaja = "style='background-color:".$a['estado_color']."'";
                            }  ?>
                    <tr <?php echo $colorbaja; ?>>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $a['articulo_nombre']; ?></td>
                        <td><?php echo $a['articulo_marca']; ?></td>
                        <td><?php echo $a['articulo_industria']; ?></td>
                        <td><?php echo $a['articulo_codigo']; ?></td>
                        <td><?php echo $a['articulo_saldo']; ?></td>
                        <td><?php echo $a['categoria_nombre']; ?></td>
                        <td style="background-color: <?php echo $a['estado_color']; ?>"><?php echo $a['estado_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('articulo/edit/'.$a['articulo_id']); ?>" class="btn btn-info btn-xs" title="Editar" ><span class="fa fa-pencil"></span></a> 
                            <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <a href="<?php echo site_url('articulo/inactivar/'.$a['articulo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                            <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea eliminar el Artículo <b> <?php echo $a['articulo_nombre']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('articulo/remove/'.$a['articulo_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
