<?php

 
  include_once('config.php');
  include_once('mensajes.php');
  include_once('modulos/functions.php');


  require_once(APP_DIR_COMPONENTES . '/xajax/xajax.inc.php');
  $xajax = new xajax("");
  $xajax->decodeUTF8InputOn();
  $xajax->setCharEncoding('utf-8');


  include_once('modulos/config/interfazRoles.php');

  include_once('modulos/configuracion/interfazSalones.php');
  include_once('modulos/configuracion/interfazTipoOperacion.php');
  include_once('modulos/configuracion/interfazTipoPago.php');
  include_once('modulos/configuracion/interfazCaja.php');
  include_once('modulos/configuracion/interfazMesas.php');
  include_once('modulos/configuracion/interfazEmpleado.php');
  include_once('modulos/configuracion/interfazClientes.php');
  
  
  include_once('modulos/productos/interfazFamProducto.php');
  include_once('modulos/productos/interfazProducto.php');
  include_once('modulos/productos/interfazTipoProducto.php');
  include_once('modulos/productos/interfazArea.php');
  include_once('modulos/productos/interfazGrupoDespacho.php');

  $xajax->processRequests();

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo GL_APP ?></title>
  

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/softpang.css">

  <link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/skin-blue.css">
  <!--<link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/select2/dist/css/select2.css">-->
  <link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/datatables.net-bs/css/dataTables.bootstrap.css">  



  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">



  <?php $xajax->printJavascript(APP_DIR_COMPONENTES . '/xajax/'); ?>
  <script type="text/javascript" src="js/functions.js" charset="utf-8"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    
    <a href="<?php echo APP_INDEX ?>" class="logo">
      
      <span class="logo-mini"><b><?php echo APP_LOGO_MINI ?></b></span>
      <span class="logo-lg"><b><?php echo APP_LOGO ?></b></span>
    </a>
    
    <nav class="navbar navbar-static-top">
      
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php //echo $_SESSION['sys_nombres'] ?></span>
            </a>

            <ul class="dropdown-menu">
        
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <form id="formrol" name="formrol" action="" method="POST" style="margin: 0px 0px 0px">
                        Usted está como:
                        <label><?php //echo //$_SESSION['sys_rol'] ?></label>
                    </form>
                  </div>
                </div>
              </li>

              <li class="user-body">

                <div class="row">  

                    <div class="col-xs-12 text-center" style="">
                      <a href="" data-toggle="modal"><i class="fa fa-user"></i><span>  Mis Datos Personales</span></a>
                    </div>

                  <div class="col-xs-12 text-center">
                    <a href="#myModal" data-toggle="modal"><i class="fa fa-unlock"></i><span>  Cambiar mi Contrase&ntilde;a</span></a>
                  </div>

                </div>
              </li>
              
              <li class="user-footer">
                <div class="pull-right">
                  <a href="login.php?logout=0" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  

  <aside class="main-sidebar">
    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php //echo $_SESSION['sys_numerodoc'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Bienvenido</a>
        </div>
      </div>

      <form class="sidebar-form">
        <div class="">
          <input type="text" name="q" class="form-control" placeholder="Menu" disabled="">
        </div>
      </form>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript: xajax__InterfazSalonesPrincipal()"><i class="fa fa-caret-right"></i>  Salones</a></li>
            <li><a href="javascript: xajax__InterfazMesasPrincipal()"><i class="fa fa-caret-right"></i>  Mesas</a></li>
            <li><a href="javascript: xajax__InterfazTipoOperacionPrincipal()"><i class="fa fa-caret-right"></i>  Tipo de Operacion</a></li>
            <li><a href="javascript: xajax__InterfazTipoPagoPrincipal()"><i class="fa fa-caret-right"></i>  Tipo de Pago</a></li>
            <li><a href="javascript: xajax__InterfazCajaPrincipal()"><i class="fa fa-caret-right"></i>  Caja</a></li>
            <li><a href="javascript: xajax__InterfazClientesPrincipal()"><i class="fa fa-caret-right"></i>  Clientes</a></li>
          </ul>  
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Productos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript: xajax__InterfazProductoPrincipal()"><i class="fa fa-caret-right"></i>  Producto</a></li>
            <li><a href="javascript: xajax__InterfazFamProductoPrincipal()"><i class="fa fa-caret-right"></i>  Fam. Producto</a></li>
            <li><a href="javascript: xajax__InterfazTipoProductoPrincipal()"><i class="fa fa-caret-right"></i>  Tipo de Producto</a></li>
            <li><a href="javascript: xajax__InterfazAreaPrincipal()"><i class="fa fa-caret-right"></i>  Area</a></li>
            <li><a href="javascript: xajax__InterfazGrupoDespachoPrincipal()"><i class="fa fa-caret-right"></i>  Grupo despacho</a></li>
          </ul>  
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Personal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript: xajax__InterfazEmpleadoPrincipal()"><i class="fa fa-caret-right"></i>  Empleado</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Seguridad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript: xajax__interfazRolesPrincipal()"><i class="fa fa-caret-right"></i>  Roles</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>

  <div class="content-wrapper">

    <section class="content">

      <!--<div class="box">
        <div class="box-body">-->

          <div id="container-fluid"> <!--Contenedor-->

            <div class="dashboard-widget">
              <div class="row-fluid">
                <ul class="breadcrumb">                            
                  <li>M&oacute;dulos</li>
                </ul> 
              </div>
            </div>

            <div class="box box-danger">
              <div class="box-header with-border">

                <div class="box-tools pull-right">

                  <span class="label label-success">Modulos disponibles:</span>
                  <span class="label label-danger">2</span>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>


                    <div id="container-secundario"></div>

                </div> 
              </div>
            </div>
 
          </div> <!--Fin Contenedor-->

          

        <!--</div>
      </div>-->
  
    </section>
    
  </div>
  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="<?php echo GL_COMPANY_PORTAL ?>" target="_blank"><?php echo GL_COMPANY ?></a>.</strong> Todos los derechos reservaods.
  </footer>

</div>

<?php 
    require_once 'js/validaERP.php';
?>

<script src="<?php echo APP_DIR_CSS ?>/js/jquery.min.js"></script>
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script src="<?php echo APP_DIR_CSS ?>/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
<script src="<?php echo APP_DIR_CSS ?>/js/adminlte.min.js"></script>
<!--<script src="<?php //echo APP_DIR_COMPONENTES ?>/select2/dist/js/select2.full.min.js"></script>-->
<!--<script src="<?php //echo APP_DIR_COMPONENTES ?>/sweetalert2/sweetalert2.all.js"></script>-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="<?php echo APP_DIR_COMPONENTES ?>/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo APP_DIR_COMPONENTES ?>/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


</body>
</html>
