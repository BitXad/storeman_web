<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Isaac Web</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo base_url("resources/images/empresas/".$institucion[0]['institucion_logo']); ?>" width="-50%" height="-50%">
        <h5><?php echo $institucion[0]['institucion_nombre']; ?></h5>
        <h4><b>STOREMAN </b>WEB</h4>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">ingreso a la plataforma</p>
        <h4><?php  if(isset($msg)){ echo  $msg; }  ?> </h4>

        <?php echo form_open('verificar'); ?>
            <div class="form-group has-feedback">
                <label for="gestion">Gestión</label>
                <select class="form-control input-lg" name="gestion" id="gestion">
                    <?php
                        foreach($gestiones as $gestion){
                            echo '<option value="'.$gestion->gestion_id.'" >'. $gestion->gestion_nombre.'</option>' ;
                        }
                    ?>
                </select>
                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="usuario" autocomplete="off">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="clave">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
        <?php echo form_close(); ?>

        <!-- /.social-auth-links -->
        <a href="<?php echo site_url() ?>forgotpassword">Olvide mi contraseña</a><br>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo site_url() ?>resources/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url() ?>resources/js/bootstrap.min.js"></script>
<!-- iCheck -->

</body>
</html>
