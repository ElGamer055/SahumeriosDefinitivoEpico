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
    $Cargo = $_SESSION['idcargo'];
    ?>
  

    <?php
        header_menu($Nombre_de_usuario, $Cargo);//Header importado desde holasoyfunciones.php
    ?>
<body>
  <main>
    <div class="product-page">
      <?php
include("conexion.php");

// Obtener la id enviada por GET desde catalogo: Productos.php?id=123
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    $id = 1; // id inválida -> usar 1 por defecto o redirigir
}

// Resolver Id de usuario desde la sesión (o buscar por nombre si sólo hay nombre)
$user_id = null;
if (isset($_SESSION['id'])) {
    $user_id = intval($_SESSION['id']);
} elseif (isset($_SESSION['idusuario'])) {
    $user_id = intval($_SESSION['idusuario']);
} elseif (!empty($Nombre_de_usuario)) {
    // intentar obtener ID desde tabla usuarios (ajusta nombres de tabla/columna si difieren)
    if ($stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Nombre = ? LIMIT 1")) {
        $stmt->bind_param("s", $Nombre_de_usuario);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($r = $res->fetch_assoc()) {
            $user_id = intval($r['ID']);
        }
        $stmt->close();
    }
}

// Procesar envío de nuevo comentario (tabla: comentarios con campos Id_Usuario, Id_producto, Comentario, Fecha, Hora)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_submit'])) {
    $comentario_texto = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

    if ($user_id && $comentario_texto !== '') {
        $stmt = $conn->prepare("INSERT INTO comentario (Id_Usuario, Id_producto, Comentario, Fecha, Hora) VALUES (?, ?, ?, CURDATE(), CURTIME())");
        if ($stmt) {
            $stmt->bind_param("iis", $user_id, $id, $comentario_texto);
            $stmt->execute();
            $stmt->close();
        }
    }
    // Redirigir para evitar reenvío del formulario
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?id=" . intval($id));
    exit;
}

// Obtener comentarios del producto (se trae el nombre si existe en tabla usuarios)
$comments = [];
$sql = "SELECT c.Id_Usuario, c.Comentario, c.Fecha, c.Hora, COALESCE(u.Nombre, CONCAT('Usuario #', c.Id_Usuario)) AS usuario_nombre
        FROM comentario c
        LEFT JOIN usuarios u ON u.ID = c.Id_Usuario
        WHERE c.Id_producto = ?
        ORDER BY c.Fecha DESC, c.Hora DESC";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $comments[] = $row;
    }
    $stmt->close();
}

// Asegurar que $resultado contiene la fila del producto buscando en nombres comunes de tabla/columna
$resultado = null;
$productCandidates = [
    ['productos','Id'],
    ['productos','id'],
    ['productos','Id_producto'],
    ['producto','Id'],
    ['producto','id'],
];

foreach ($productCandidates as $c) {
    $table = $c[0];
    $col = $c[1];
    $sql = "SELECT * FROM `{$table}` WHERE `{$col}` = ? LIMIT 1";
    // intentar preparar; si falla (tabla/columna no existe) continuar
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) {
                // $resultado será un mysqli_result usado más abajo
                $resultado = $res;
                $stmt->close();
                break;
            }
            if ($res) { $res->free(); }
        }
        $stmt->close();
    }
}

// Fallback: intentar tabla 'productos' cualquiera si no se encontró nada
if (!$resultado) {
    $fallback = $conn->query("SELECT * FROM productos WHERE Id = " . intval($id) . " LIMIT 1");
    if ($fallback && $fallback->num_rows > 0) {
        $resultado = $fallback;
    } else {
        // último intento sin WHERE (solo para evitar errores); no recomendado en producción
        if (!$fallback) {
            $fallback = $conn->query("SELECT * FROM productos LIMIT 1");
        }
        if ($fallback && $fallback->num_rows > 0) {
            $resultado = $fallback;
        }
    }
}

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
              <?php
                // Obtener precio numérico para JavaScript
                $price_numeric = isset($fila['Precio']) ? number_format((float)$fila['Precio'], 2, '.', '') : '0.00';
              ?>
              <!-- Botón que usa main.js para añadir al carrito (sin enviar formulario) -->
              <button type="button"
                      class="btn-primary-custom"
                      data-add-to-cart
                      data-id="<?php echo intval($id); ?>"
                      data-title="<?php echo htmlspecialchars($titulo, ENT_QUOTES); ?>"
                      data-price="<?php echo $price_numeric; ?>"
                      data-img="<?php echo htmlspecialchars($imgPath, ENT_QUOTES); ?>">
                Agregar al carrito
              </button>
            </div>

          <!-- Sección de comentarios -->
          <div style="margin-top:18px; color:rgba(255,255,255,0.95);">
            <h3 style="text-align:center; margin-bottom:12px;">Comentarios</h3>

            <!-- Formulario para añadir comentario -->
            <div style="max-width:720px; margin:0 auto 18px;">
              <?php if (!empty($Nombre_de_usuario)): ?>
                <form method="POST" action="metadatosComentarios.php" novalidate>
                  <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                  <textarea name="comentario" rows="4" style="width:100%; padding:8px; border-radius:6px; resize:vertical;" placeholder="Escribe tu comentario..." required></textarea>
                  <div style="text-align:right; margin-top:8px;">
                    <button type="submit" name="comment_submit" class="btn-success-custom">Publicar comentario</button>
                  </div>
                </form>
              <?php else: ?>
                <div style="padding:12px; background:rgba(255,255,255,0.03); border-radius:8px;">
                  Debes iniciar sesión para publicar un comentario.
                </div>
              <?php endif; ?>
            </div>

            <!-- Lista de comentarios -->
            <div style="max-width:720px; margin:0 auto;">
              <?php if (count($comments) === 0): ?>
                <div style="padding:12px; background:rgba(255,255,255,0.02); border-radius:6px; text-align:center;">No hay comentarios aún.</div>
              <?php else: ?>
                <?php foreach ($comments as $c): ?>
                  <div style="padding:12px; background:rgba(255,255,255,0.02); border-radius:8px; margin-bottom:10px;">
                    <div style="font-weight:700;"><?php echo htmlspecialchars($c['usuario_nombre']); ?> <span style="font-weight:400; font-size:12px; color:rgba(255,255,255,0.6);"> - <?php echo date('d/m/Y H:i', strtotime($c['Fecha'].' '.$c['Hora'])); ?></span></div>
                    <div style="margin-top:6px; color:rgba(255,255,255,0.9);"><?php echo nl2br(htmlspecialchars($c['Comentario'])); ?></div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>

  <?php footer(); // Footer importado desde holasoyfunciones.php ?>
</body>
<script src="js/bootstrap.js"></script>
</html>
