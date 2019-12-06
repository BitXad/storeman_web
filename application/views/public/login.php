<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Almacenes</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="<?php //echo site_url() ?>resources/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo site_url() ?>resources/css/style.css">

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
    <div class="login-main">
    <div class="login-logo">
        <img height="90px" width="90px" src="<?php echo base_url("resources/images/empresas/".$institucion['institucion_logo']); ?>">
        <h5><?php echo $institucion['institucion_nombre']; ?></h5>
        <!--<h4><b>STOREMAN </b>WEB</h4>-->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="text-center"><b>STOREMAN </b>WEB</h3>
        <p class="login-box-msg">Ingreso al Sistema</p>
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
                <!--<span class="glyphicon glyphicon-calendar form-control-feedback"></span>-->
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Usuario" autocomplete="off">
                <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Clave">
                <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success btn-block form-control">Ingresar</button>
                </div>
            </div>
        <?php echo form_close(); ?>

        <!--<a href="<?php //echo site_url() ?>forgotpassword">Olvide mi contraseña</a><br>-->
    </div>
</div>

<!-- jQuery 3 -->
<script src="<?php echo site_url() ?>resources/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url() ?>resources/js/bootstrap.min.js"></script>
<!-- iCheck -->

</body>
</html>
