<?php
    session_start();
    include 'holasoyfunciones.php';
    $busqueda=$_POST['Busqueda'];
    $consulta="SELECT * FROM usuarios WHERE Nombre LIKE '%$busqueda%' OR Apellido LIKE '%$busqueda%'";
?>


    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Principal</title>
      <link rel="stylesheet" href="css/bootstrap.css" />
    </head>
    <body style="background: rgba(251, 255, 4, 0.315);">
    <!--declaramos los datos usados luego-->
    <?php
        
        $Apellido = $_SESSION['ap'];
        $Nombre = $_SESSION['nom'];
        $Imagen=$_SESSION['dni'];
        $Permiso = $_SESSION['permisos'];
        $DNI = $_SESSION['dni'];
    ?>
    
    <!--abrimos la etiqueta que indica un navegador-->
      <nav class="navbar navbar-expand-md navbar-dark bg-warning">
        <!--inidicaciones del color y espacios-->
        <div class="container-fluid"><!--contenedor ajustable-->
          <a class="navbar-brand">
            <img src="fotos/logo.png" style="width: 40px;"><!--logo-->
            <span class="text-light">Sistema de Gestion Flexible|</span><!--titulo-->
            <a style="color: rgb(255, 230, 4);">E.E.S.T N1</a><!--escuela-->
          </a>
          <!--boton del menu-->
          <button class="navbar-toggler" data-toggle="collapse" data-target="#menu" >
            <span class="navbar-toggler-icon"></span><!--icono de las lineas-->
          </button>
          <!--elementos de menu colapsable-->
          <div class="collapse navbar-collapse" id="menu"> <!--con ID para abrirlo con el boton-->
            <ul class="navbar-nav ms-auto"><!--abrimos lista-->
              <li class="nav-item">
                <a class="nav-link" href="principal.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="usuarios.php">Usuarios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="altauser.php">Nuevo</a>
              </li>
              <li class="nav-item dropdown"><!--marcamos que será una lista anidada, desplegable-->
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" href="#">Reportes</a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="dropdown-item">Reporte 1</a></li>
                  <li><a href="#" class="dropdown-item">Reporte 2</a></li>
                  <li><a href="#" class="dropdown-item">Reporte 3</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" href="#">Listados</a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="dropdown-item">Listado 1</a></li>
                  <li><a href="#" class="dropdown-item">Listado 2</a></li>
                  <li><a href="#" class="dropdown-item">Listado 3</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Creditos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.html">Salir</a>
              </li>
            </ul>
            <hr class="text-white-50"><!--una linea para poder ver una separacion prolija-->
          </div>
    
          <!--buscador-->
              <form class="form-inline" action="busqueda.php" method="POST">
                <input class="form-control d-none d-lg-inline-block" type="text" placeholder="Buscar" name="Busqueda">
                <input class="btn btn-outline-light d-none d-lg-inline-block" type="submit" value="Buscar"></input>
              </form>
         
          </div>
      </nav>
      <!--mensaje-->
      <center><?php 
        echo "<b>Bienvenido al Sigeflex $Permiso, $Apellido $Nombre   $DNI</b>";
        encabezado($Nombre, $Apellido, $Permiso, $Imagen); //se le asigna los datos que va contener el encabezado
        
        mostrar_tabla($consulta);
      ?><center>
    
        
      <script src="js/jquery-3.2.1.slim.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
    









