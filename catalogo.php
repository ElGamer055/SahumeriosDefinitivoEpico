
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main3.css">
  <link rel="stylesheet" href="posible/index2.css">
  <title>Teiwaz Sahumerios</title>
</head>
<body>
  <?php
  session_start();
  include 'holasoyfunciones.php';
  $Nombre_de_usuario = $_SESSION['user'] ?? null;
  $Cargo = $_SESSION['idcargo'] ?? null;  
  
  header_menu($Nombre_de_usuario, $Cargo);
  ?>

  <main class="container py-4">
    <!-- Título centrado -->
    <hr style="border-top: 2px solid #000;" class="py-4">
    <h1 class="text-center py-4">Catálogo de productos</h1>

    <!-- barra de búsqueda -->
    <form class="top-search d-flex px-4 mt-4 mb-4" role="search" id="searchForm">
      <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search"/>
      <div class="dropdown"></div>
    </form>

    <div class="products">
      <?php
      include("conexion.php");
      $sql = "SELECT * FROM producto";
      $resultado = $conn->query($sql);

      while ($fila = $resultado->fetch_assoc()) {
        $imgPath = 'img/' . $fila['Titulo'] . '.jpg';
        if (!file_exists($imgPath) || empty($fila['Titulo'])) {
          $imgPath = 'img/sahur.jpg';
        }
      ?>
        <a class="product-card" href="Productos.php?id=<?php echo $fila['ID']; ?>" style="text-decoration: none; color: inherit;">
          <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($fila['Titulo']); ?>">
          <div class="overlay">
            <div class="meta">Producto</div>
            <div class="title"><?php echo htmlspecialchars($fila['Titulo']); ?></div>
            <div class="desc"><?php echo htmlspecialchars($fila['Descripcion']); ?></div>
          </div>
          <div class="card-footer">
            <span class="precio">$<?php echo number_format($fila['Precio'], 2); ?></span>
          </div>
        </a>
      <?php } ?>
    </div>
  </main>

  <?php
  // footer fuera del main
  footer();
  ?>

  <!-- Scripts: bootstrap primero para que main.js pueda detectar window.bootstrap -->
  <script src="js/bootstrap.js"></script>

  <!-- Mover la lógica de búsqueda al final para garantizar que el DOM existe -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const searchInputEl = document.getElementById('searchInput');
      function filterProducts() {
        const query = (searchInputEl.value || '').toLowerCase();
        const products = document.querySelectorAll('.product-card');
        products.forEach(product => {
          const titulo = (product.querySelector('h2') || product.querySelector('.title') || {}).textContent || '';
          const descripcion = (product.querySelector('p') || product.querySelector('.desc') || {}).textContent || '';
          const matches = titulo.toLowerCase().includes(query) || descripcion.toLowerCase().includes(query);
          product.style.display = matches ? 'block' : 'none';
        });
      }
      if (searchInputEl) {
        searchInputEl.addEventListener('keyup', filterProducts);
      }
    });
  </script>

  <script src="js/main.js"></script>
</body>
</html>
