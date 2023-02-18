<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="box-header">
    <font size='4' face='Arial'><b>Parametros</b></font>
    <?php if(!isset($all_parametros)){ ?>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('parametros/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Parametro</a> 
    </div>
    <?php } ?>
</div>
<?php
foreach($all_parametros as $p)
{
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header text-right">
                <!--<font size='4' face='Arial'><b>Perfil <?php //echo $p['parametro_id']; ?></b></font>--> 
                <a href="<?php echo site_url('parametros/edit/'.$p['parametro_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
            </div>
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla" style="text-align: center; font-size: 11px;color:black;">
                    <tr>
                        <th style="font-size: 12px;color:black;background: rgba(0, 0, 255, 0.3);" rowspan="4" ><u>CONFIGURACION</u></th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);"># DECIMALES EN KARDEX</th>
                        <th style="font-size: 11px;color:black;background: rgba(0, 0, 255, 0.3);"># DECIMALES EN OPERACIONES</th>
                    </tr>
                    <tr>
                        <td><?php echo $p['parametro_decimaleskardex']; ?></td>
                        <td><?php echo $p['parametro_decimalesoperaciones']; ?></td>
                    </tr>
                    
                </table>
                           
            </div>
        </div>
    </div>
</div>
<?php
}
?>