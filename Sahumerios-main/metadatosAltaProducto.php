<?php
// apertura php 
    session_start();
    //inicio sesion, permite levantar(carga datos guardados) un perfil de usuario
    $Nombre=$_POST['Nombre'];    //asignacion, recibo por el metodo post lo enviado por el login
    $Descripcion=$_POST['Descripcion'];
    $Marca=$_POST['Marca'];
    $Categoria=$_POST['Categoria'];
    $Proveedor=$_POST['Proveedor'];
    $Stock=$_POST['Stock'];
    $StockMinimo=$_POST['StockMinimo'];
    $Costo=$_POST['Costo'];
    $Precio=$_POST['Precio'];

    $consulta= "INSERT INTO `Producto`(`Nombre`, `Descripcion`, `Id_Marca`, `Id_Proveedor`, `Stock`, `StockMinimo`, `Costo`, `Precio`) VALUES ('$Nombre', '$Descripcion', $Marca, $Proveedor, $Stock, $StockMinimo, $Costo, $Precio)";
    $conexion=mysqli_connect('localhost','root','','sahumerios'); //establece una conexion a una base de datos MySQL ubicada en 'localhost' usando 'root' como n
    $result=mysqli_query($conexion,$consulta);//ejecuta la instruccion $consulta en la conexion de base de datos establecida y asigna el resualtado a la variable
    
    echo '<script language="javascript">
        alert("Skibidi creado! $_POST['ID']");
        location.href="altaProducto.php";
        </script>';
    echo $;

?>