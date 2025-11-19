
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
<body>
  <?php
  session_start();
  include 'holasoyfunciones.php';
  $Nombre_de_usuario = $_SESSION['user'] ?? null;
  $Nombre = $_SESSION['nom'] ?? null;
  
  header_menu();
  ?>

  <!-- barra de búsqueda fija -->
  <form class="top-search d-flex" role="search" id="searchForm">
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

  <!-- Título centrado -->
  <h1 class="site-title">Catálogo de Productos</h1>

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
        const titulo = product.querySelector('h2') || product.querySelector('.title');
        const descripcion = product.querySelector('p') || product.querySelector('.desc');
        let matches = false;

        const tituloText = titulo ? titulo.textContent.toLowerCase() : '';
        const descripcionText = descripcion ? descripcion.textContent.toLowerCase() : '';

        if (filterType === 'todos') {
          matches = tituloText.includes(searchInput) || descripcionText.includes(searchInput);
        } else if (filterType === 'titulo') {
          matches = tituloText.includes(searchInput);
        } else if (filterType === 'descripcion') {
          matches = descripcionText.includes(searchInput);
        }

        product.style.display = matches ? 'block' : 'none';
      });
    }

    document.getElementById('searchInput').addEventListener('keyup', filterProducts);
  </script>

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
          <div class="title"><?php echo $fila['Titulo']; ?></div>
          <div class="desc"><?php echo $fila['Descripcion']; ?></div>
        </div>
        
        <div class="card-footer">
          <span class="precio">$<?php echo number_format($fila['Precio'], 2); ?></span>
        </div>
      </a>
    <?php } ?>
  </div>

  <script src="js/main.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>
