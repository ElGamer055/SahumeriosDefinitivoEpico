<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="posible/index.css">
  <title>Teiwaz Sahumerios</title>
</head>

<?php
    session_start();//para mantener la sesion abierta
    include 'holasoyfunciones.php';
    $Nombre_de_usuario = $_SESSION['user'];
    $Nombre = $_SESSION['nom'];
    ?>
  

    <?php
        header_menu();//Header importado desde holasoyfunciones.php
    ?>
<body>
    <?php
include("conexion.php");

// Obtener la id enviada por GET desde catalogo: Productos.php?id=123
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    $id = 1; // id inválida -> usar 1 por defecto o redirigir
}
// Consultamos el producto (solo 1)
$sql = "SELECT * FROM producto WHERE ID = " . intval($id) . " LIMIT 1";
$resultado = $conn->query($sql);

// Si hay resultado, cargamos variables y mostramos diseño
$fila = $resultado ? $resultado->fetch_assoc() : null;

if ($fila) {
    // Determinar ruta de imagen usando campo 'imagen' si existe, si no usar 'Titulo'
    if (!empty($fila['imagen'])) {
        $imgFile = $fila['imagen'];
    } else {
        $imgFile = $fila['Titulo'];
    }
    $imgPath = 'img/' . $imgFile . '.jpg';
    if (!file_exists($imgPath) || empty($imgFile)) {
        $imgPath = 'img/sahur.jpg';
    }

    $titulo = htmlspecialchars($fila['Titulo']);
    $descripcion = nl2br(htmlspecialchars($fila['Descripcion']));
    $precio = isset($fila['Precio']) ? number_format((float)$fila['Precio'], 2, ',', '.') : '0,00';
} else {
    // Producto no encontrado: valores por defecto
    $imgPath = 'img/sahur.jpg';
    $titulo = 'Producto no encontrado';
    $descripcion = '';
    $precio = '0,00';
}
?>

<!-- Estilos específicos para la página de producto -->
<style>
.product-page { max-width:900px; margin:64px auto; padding:0 18px; }
.product-hero {
  background: #0f0f0f;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 12px 40px rgba(0,0,0,0.6);
  position:relative;
  color: #fff;
}
.product-hero .hero-img {
  width:100%;
  height:320px;
  object-fit:cover;
  display:block;
  filter:brightness(.68);
  background:#222;
}
.product-card-overlay{
  position:relative;
  padding:22px 26px;
  background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(0,0,0,0.25));
  margin-top:-80px;
  margin-left:18px;
  margin-right:18px;
  border-radius:12px;
  backdrop-filter: blur(3px);
  border:1px solid rgba(255,255,255,0.06);
  min-height:220px;
}
.product-card-overlay h1{
  text-align:center;
  margin:6px 0 12px;
  font-weight:700;
  font-size:20px;
  letter-spacing:1px;
}
.product-info-row{
  border-top:1px dashed rgba(255,255,255,0.12);
  padding:12px 8px;
  margin:8px 0;
  color:rgba(255,255,255,0.9);
  font-size:14px;
  line-height:1.5;
}
.product-info-row:first-of-type{ border-top:none; padding-top:0; margin-top:0; }
.product-price{
  font-weight:800;
  font-size:18px;
  margin-top:6px;
  color:#fff;
}
.product-actions{
  display:flex;
  gap:12px;
  justify-content:center;
  margin-top:14px;
}
.btn-primary-custom{
  background:#6b46ff;
  color:#fff;
  border:0;
  padding:10px 16px;
  border-radius:8px;
  cursor:pointer;
  box-shadow:0 6px 14px rgba(107,70,255,0.18);
}
.btn-success-custom{
  background:#2eb85c;
  color:#fff;
  border:0;
  padding:10px 16px;
  border-radius:8px;
  cursor:pointer;
  box-shadow:0 6px 14px rgba(46,184,92,0.12);
}
@media (max-width:600px){
  .product-hero .hero-img{ height:220px; }
}
</style>

<div class="product-page">
  <div class="product-hero">
    <img class="hero-img" src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo $titulo; ?>">
    <div class="product-card-overlay">
      <h1><?php echo $titulo; ?></h1>

      <div class="product-info-row">
        <strong>Descripción del producto</strong>
        <div style="margin-top:6px; color:rgba(255,255,255,0.85)"><?php echo $descripcion; ?></div>
      </div>

      <div class="product-info-row">
        <strong>Precio del producto</strong>
        <div class="product-price">$<?php echo $precio; ?></div>
      </div>

      <div class="product-actions">
        <form method="post" action="cart_add.php" style="display:inline;">
          <input type="hidden" name="id" value="<?php echo intval($id); ?>">
          <button type="submit" class="btn-primary-custom">Agregar al carrito</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php footer(); // Footer importado desde holasoyfunciones.php ?>

</body>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
</html>
