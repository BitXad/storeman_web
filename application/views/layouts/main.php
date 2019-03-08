<script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
<script language="JavaScript"> 
function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = momentoActual.getHours() 
   	minuto = momentoActual.getMinutes() 
   	segundo = momentoActual.getSeconds() 

   	horaImprimible = hora + " : " + minuto + " : " + segundo 
        var today = moment().format('DD/MM/YYYY HH:mm:ss');

   	document.form_reloj.reloj.value = today; 

   	setTimeout("mueveReloj()",1000) 
} 
</script>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Storeman v2.0</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Datetimepicker -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
    </head>
    
    <body class="hold-transition skin-red sidebar-mini" onload="mueveReloj()">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">storeman v2.0</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">storeman v2.0</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </a>
                      

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav"> 
                        <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Jacqueline Alacoria</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">

                                    <p>
                                        Jacqueline Alacoria - Almacenes
                                        <small>Gestión 2019</small>
                                    </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Mis Datos</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <center>
                        <form name="form_reloj"> 
                         <input type="text" name="reloj" size="20" class="btn btn-danger" > 
                        </form> 
                    </center>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Jacqueline Alacoria</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MENU PRINCIPAL</li>
                        <li>
                            <a href="<?php echo site_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
<!-------------------------- PARAMETROS ----------------------->                        
                        <li>
                            <a href="#">
                                <i class="fa fa-server"></i> <span>Parámetros</span>
                            </a>
                            
                            <ul class="treeview-menu">
                                
                                <li class="active">
                                    <a href="<?php echo site_url('institucion/index');?>"><i class="fa fa-bank"></i> Institución</a>
                                </li>
                                 
                                <li>
                                    <a href="<?php echo site_url('gestion/index');?>"><i class="fa fa-calendar"></i> Gestión</a>
                                </li>
                                                               
                                <li>
                                    <a href="#"><i class="fa fa-cog"></i> Configuración</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo site_url('cambio/index');?>"><i class="fa fa-money"></i> Cambio UFV</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('tipo_usuario/index');?>"><i class="fa fa-users"></i> Tipos de usuarios</a>
                                </li>

                            </ul>
                        </li>
<!-------------------------- FIN PARAMETROS ----------------------->                        
                        

<!-------------------------- REGISTRO ----------------------->  
                        <li>
                            <a href="#">
                                <i class="fa fa-book"></i> <span>Registro</span>
                            </a>
                            
                            <ul class="treeview-menu">
                                
                                <li class="active">
                                    <a href="<?php echo site_url('categoria/index');?>"><i class="fa fa-qrcode"></i> Categoria</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('articulo/index');?>"><i class="fa fa-cube"></i> Articulos</a>
                                </li>                                

                                <li>
                                    <a href="<?php echo site_url('pedido/index');?>"><i class="fa fa-address-card"></i> Pedido</a>
                                </li>                                

                                <li>
                                    <a href="<?php echo site_url('estado/index');?>"><i class="fa fa-gg"></i> Estado</a>
                                </li>                              

                                <li>
                                    <a href="<?php echo site_url('proveedor/index');?>"><i class="fa fa-desktop"></i> Proveedor</a>
                                </li>                                

                                <li>
                                    <a href="<?php echo site_url('unidad/index');?>"><i class="fa fa-codepen"></i> Unidad</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo site_url('unidad_manejo');?>"><i class="fa fa-codepen"></i> Unidad de Manejo</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo site_url('programa/index');?>"><i class="fa fa-id-card"></i> Programa</a>
                                </li>                                

                                
                                
                                
                                
                            </ul>
                        </li>
                        
<!-------------------------- FIN REGISTRO ----------------------->   
                        

<!-------------------------- OPERACIONES ----------------------->   


                        <li>
                            <a href="#">
                                <i hrefi class="fa fa-cubes"></i> <span>Operaciones</span>
                            </a>
                            
                            <ul class="treeview-menu">
                                
                                <li class="active">
                                    <a href="<?php echo site_url('ingreso/index');?>"><i class="fa fa-download"></i> Ingreso</a>
                                </li>
                                
                                
                                <li>
                                    <a href="<?php echo site_url('salida/index');?>"><i class="fa fa-upload"></i> Salida</a>
                                </li>
                                
                                
                            </ul>
                        </li>
                        
<!-------------------------- FIN OPERACIONES ----------------------->   

<!-------------------------- FIN OPERACIONES ----------------------->   
                        <li>
                            <a href="#">
                                <i class="fa fa-lock"></i> <span>Seguidad</span>
                            </a>
                                <ul class="treeview-menu">
                                <li class="active">
                                    <a href="<?php echo site_url('usuario/index');?>"><i class="fa fa-user-circle"></i> Usuarios</a>
                                </li>
<!--								<li>
                                    <a href="<?php echo site_url('usuario/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>-->
                                </ul>
                        </li>
<!-------------------------- FIN OPERACIONES ----------------------->   


                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Desarrollado por <a href="http://www.passwordbolivia.com/">PASSWORD SRL</a>| Ingenieria en Hardware & Software</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js');?>"></script>
    </body>
</html>