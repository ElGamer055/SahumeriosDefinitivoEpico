<?php
session_start();
include 'conexion.php';
echo '<script language="javascript">
        alert("NOMBRE DE USUARIO O CONTRASEÑA INCORRECTO");
        location.href="productos.php";
        </script>';
// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Productos.php');
    exit;
}

// Obtener comentario y id de producto (acepta 'id' o 'Id_producto')
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
$product_id = null;
if (!empty($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $product_id = intval($_POST['id']);
} elseif (!empty($_POST['Id_producto']) && filter_var($_POST['Id_producto'], FILTER_VALIDATE_INT)) {
    $product_id = intval($_POST['Id_producto']);
}

// Validaciones básicas
if ($product_id === null || $comentario === '') {
    header("Location: Products.php?id=" . ($product_id ?? ''));
    
    echo '<script language="javascript">
        alert("NOMBRE DE USUARIO O CONTRASEÑA INCORRECTO");
        location.href="productos.php";
        </script>';
    exit;
}
if (mb_strlen($comentario) > 2000) { // límite opcional
    $comentario = mb_substr($comentario, 0, 2000);
}

// Resolver Id de usuario desde sesión o buscando por nombre
$user_id = $_SESSION['id_deuser'] ?? 0;
if (!empty($_SESSION['id'])) {
    $user_id = intval($_SESSION['id']);
} elseif (!empty($_SESSION['idusuario'])) {
    $user_id = intval($_SESSION['idusuario']);
} elseif (!empty($_SESSION['user'])) {
    $nombre = $_SESSION['user'];
    if ($stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Nombre = ? LIMIT 1")) {
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($r = $res->fetch_assoc()) $user_id = intval($r['ID']);
        $stmt->close();
    }
}

// Si no hay usuario identificado, redirigir (puedes mostrar mensaje en el front)
if (!$user_id) {
    header("Location: Products.php?id=" . intval($product_id));
    exit;
    
}

// Insertar comentario (Fecha y Hora con funciones MySQL)
if ($stmt = $conn->prepare("INSERT INTO comentario (Id_Usuario, Id_producto, Comentario, Fecha, Hora) VALUES (?, ?, ?, CURDATE(), CURTIME())")) {
    $stmt->bind_param("iis", $user_id, $product_id, $comentario);
    $stmt->execute();
    $stmt->close();
    
    echo '<script language="javascript">
        alert("NOMBRE DE USUARIO O CONTRASEÑA INCORRECTO");
        location.href="productos.php";
        </script>';
}

// Redirigir de vuelta al producto
header("Location: Productos.php?id=" . intval($product_id));

    echo '<script language="javascript">
        alert("subidopapu");
        location.href="productos.php";
        </script>';
exit;
?>