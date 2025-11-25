<?php
session_start();

// sólo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header("Location: $back");
    exit;
}

// recolectar y sanitizar datos
$id    = isset($_POST['id']) ? intval($_POST['id']) : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$price = isset($_POST['price']) ? floatval(str_replace(',', '.', $_POST['price'])) : 0.0;
$img   = isset($_POST['img']) ? trim($_POST['img']) : '';
$qty   = isset($_POST['qty']) ? max(1, intval($_POST['qty'])) : 1;

if ($id <= 0) {
    // id inválido -> volver
    $back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header("Location: $back");
    exit;
}

// inicializar carrito en sesión si no existe
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// buscar si ya existe el item
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if (isset($item['id']) && intval($item['id']) === $id) {
        $item['qty'] = max(1, intval($item['qty']) + $qty);
        $found = true;
        break;
    }
}
unset($item);

if (!$found) {
    $_SESSION['cart'][] = [
        'id'    => $id,
        'title' => $title,
        'price' => $price,
        'img'   => $img,
        'qty'   => $qty
    ];
}

// redirigir de vuelta a la página anterior (producto) o al catálogo
$back = $_SERVER['HTTP_REFERER'] ?? "Productos.php?id=$id";
header("Location: $back");
exit;
?>