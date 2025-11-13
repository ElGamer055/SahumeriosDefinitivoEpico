<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main3.css">
  <title>Teiwaz Sahumerios</title>
</head>

    <?php
    session_start();//para mantener la sesion abierta
    include 'holasoyfunciones.php';
    $Nombre_de_usuario = $_SESSION['user'];
    $Nombre = $_SESSION['nom'];
    ?>
  

    <?php
        header_sahumerios($Nombre_de_usuario);//Header importado desde holasoyfunciones.php
    ?>


  <form class="d-flex" role="search" id="searchForm" style="gap: 10px; align-items: center;">
    <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search"/>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
        Filtrar por
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><button class="dropdown-item" type="button" onclick="setFilter('todos')">Todos</button></li>
        <li><button class="dropdown-item" type="button" onclick="setFilter('titulo')">Nombre</button></li>
        <li><button class="dropdown-item" type="button" onclick="setFilter('descripcion')">Descripción</button></li>
      </ul>
    </div>
  </form>

  <script>
    function setFilter(filterType) {
      const searchInput = document.getElementById('searchInput');
      searchInput.dataset.filterType = filterType;
      filterProducts();
    }

    function filterProducts() {
      const searchInput = document.getElementById('searchInput').value.toLowerCase();
      const filterType = document.getElementById('searchInput').dataset.filterType || 'todos';
      const products = document.querySelectorAll('.product-card');

      products.forEach(product => {
        const titulo = product.querySelector('h2').textContent.toLowerCase();
        const descripcion = product.querySelector('p').textContent.toLowerCase();
        let matches = false;

        if (filterType === 'todos') {
          matches = titulo.includes(searchInput) || descripcion.includes(searchInput);
        } else if (filterType === 'titulo') {
          matches = titulo.includes(searchInput);
        } else if (filterType === 'descripcion') {
          matches = descripcion.includes(searchInput);
        }

        product.style.display = matches ? 'block' : 'none';
      });
    }

    document.getElementById('searchInput').addEventListener('keyup', filterProducts);
  </script>

    <body>
      <?php
include("conexion.php");

// Consultamos los productos
$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo Modular</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <h1>Catálogo de Productos</h1>

  <div class="products">
    <?php while ($fila = $resultado->fetch_assoc()) { ?>
    <?php
      // obtener ruta de imagen a partir del campo 'imagen' (texto) y concatenar ".jpg"
      $imgPath = 'img/' . $fila['Titulo'] . '.jpg';
      // fallback si no existe el archivo
      if (!file_exists($imgPath) || empty($fila['Titulo'])) {
        $imgPath = 'img/sahur.jpg';
      }
      ?>
      <a class="product-card" href="Productos.php?id=<?php echo $fila['ID']; ?>" style="text-decoration:none;color:inherit;">
        <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($fila['Titulo']); ?>">
        <h2><?php echo $fila['Titulo']; ?></h2>
        <p><?php echo $fila['Descripcion']; ?></p>
        <span class="precio">$<?php echo number_format($fila['Precio'], 2); ?></span>

    </a>
    <?php } ?>
  </div>

  <script src="script.js"></script>
</body>
</html>


</body>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
</html>
