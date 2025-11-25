<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Teiwaz Sahumerios</title>

  <!-- Fuentes, íconos y Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="posible/index.css">
</head>
<body>
  <?php
  session_start();
include 'holasoyfunciones.php';
    $Nombre_de_usuario = $_SESSION['user'];
    $Cargo = $_SESSION['idcargo'];
    
  header_menu($Nombre_de_usuario,  $Cargo);
?>

  <!-- Botones de menú y carrito -->
  <div class="position-fixed top-0 start-0 p-3 z-3">
    <button class="btn btn-custom" data-bs-toggle="offcanvas" data-bs-target="#menuCategorias"><i class="bi bi-list"></i>➕</button>
  </div>
  <div class="position-fixed top-0 end-0 p-3 z-3">
    <button class="btn btn-cart" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
      🛒
    </button>
  </div>

  <div class="container py-4 mt-5">
    <header>
      <h1>Teiwaz Sahumerios</h1>
      <p id="frase-aleatoria"></p>
    </header>

    <div class="text-center mb-3">
      <span class="badge text-light"><h1>Nuevo e imperdible</h1></span>
    </div>

    <div class="row g-3 mb-4" id="cards"></div>

    <div class="row align-items-start g-3">
      <div class="col-lg-8">
        <div class="p-4 rounded bg-black text-light">
          <div class="row g-3 align-items-center">
            <div class="col-md-6">
              <div id="preview" class="thumb onClick" style="background-image:url('img/sahur.jpg'); height:220px;"></div>
            </div>
            <div class="col-md-6 d-flex flex-column gap-3">
              <a href="#catalogo" class="btn btn-custom bg-violetita color-violeta">Ver catálogo</a>
              <a href="#comprar" class="btn btn-custom bg-violetita">¿Cómo comprar?</a>
              <a href="#marley" class="btn btn-custom bg-violetita">Skibidi Marley</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4 onClick">
        <div class="card p-1 h-100 bg-black">
          <div class="thumb mb-2 w-100" style="background-image:url('img/sahur.jpg')"></div>
          <div class='p-2'>
            <h6 class="mt-1 text-light">Producto destacado</h6>  
            <small class="text-secondary">$2500</small>  
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Menú lateral -->
  <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="menuCategorias">
    <div class="offcanvas-header">
      <h1 class="offcanvas-title">Menú</h1>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled listaMenu">
        <li><a href="posiblePrincipal.php" class="text-white text-decoration-none d-block py-1 fs-3">Principal</a></li>
        <li><a href="catalogo.php" class="text-white text-decoration-none d-block py-1 fs-3">Productos</a></li>
        <li><a href="Registrar.php" class="text-white text-decoration-none d-block py-1 fs-3">Registrarse</a></li>
        <li><a href="Login.php" class="text-white text-decoration-none d-block py-1 fs-3">Iniciar sesion</a></li>
      </ul>
    </div>
  </div>
 
<!-- CARRITO (Bootstrap Offcanvas) -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="cartOffcanvas">
  <div class="offcanvas-header border-bottom border-purple">
    <h5 class="text-black">Carrito de compras</h5>
    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column justify-content-between">
    <div class="cart-items">
      <!-- Ejemplo de ítem -->
      <div class="card bg-transparent border border-light-subtle mb-2">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1 text-light">Sahumerio Lavanda</h6>
          </div>
          <div class="d-flex align-items-center gap-1">
            <button class="btn btn-sm btn-purple minus">-</button>
            <input type="number" value="1" min="1" class="form-control form-control-sm w-25 text-center">
            <button class="btn btn-sm btn-purple plus">+</button>
          </div>
          <span class="fw-bold" data-price="3500">$3.500</span>
        </div>
      </div>
    </div>

    <div class="border-top border-purple pt-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="fw-semibold">Total:</span>
        <input type="text" readonly value="$3.500" class="form-control form-control-sm text-end w-25">
      </div>
      <button class="btn btn-purple w-100 mb-2 confirm">Confirmar compra</button>
      <button class="btn btn-outline-light w-100 clear">Borrar carrito</button>
    </div>
  </div>
</div>

  <!-- Footer -->
  <footer class="bg-black text-light mt-4">
    <div class="d-flex justify-content-between align-items-center py-4 px-4 border-bottom border-secondary flex-wrap">
      <h1 class="px-3">Sahumerios Teiwaz</h1>
      <div class="d-flex gap-4 px-4">  
        <i class="fa-brands fa-facebook fa-2xl"></i>
        <i class="fa-brands fa-linkedin fa-2xl"></i>
        <i class="fa-brands fa-youtube fa-2xl"></i>
        <i class="fa-brands fa-instagram fa-2xl"></i>
      </div>
    </div>
    <div class="container py-4 text-center">
      <p class="mb-0 text-secondary">&copy; 2024 Teiwaz Sahumerios. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="js/main.js"></script>
  
  <script>
    const sample = {
      title: 'Sahumerio pack clásico',
      precio: '$2500',
      img: 'img/sahur.jpg'
    };

    const cardsEl = document.getElementById('cards');
    for (let i = 0; i < 3; i++) {
      const col = document.createElement('div');
      col.className = 'col-12 col-md-4';
      col.innerHTML = `
        <div class='card p-1 h-100 bg-black onClick'">
          <div class='thumb mb-2 w-100' style='background-image:url(${sample.img}); background-position:center; background-size:cover;'></div>
          <div class='p-2'>
            <h6 class='mt-1 text-light'>${sample.title}</h6>
            <small class='text-secondary'>${sample.precio}</small>
          </div>
        </div>`;
      cardsEl.appendChild(col);
    }

    cardsEl.addEventListener('click', e => {
      const card = e.target.closest('.card');
      if (!card) return;
      const thumb = card.querySelector('.thumb');
      document.getElementById('preview').style.backgroundImage = thumb.style.backgroundImage;
    });
  </script>
</body>
</html>
