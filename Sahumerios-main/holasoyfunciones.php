<?php 
error_reporting(0);

function header_menu(){
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

  <?php
}

function header_sahumerio($Nombre_de_usuario){
  ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">

  
  <div class="container">
    <header>
      <nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="icon me-1"><i class="fa-regular fa-star"></i></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="icon me-1"><i class="fa-regular fa-star"></i></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Sahumerios Teiwaz</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <?php if (isset($Nombre_de_usuario) == true): ?>
            <a class="nav-link" aria-current="page" href="interfazUsuario.php"><i class="fa-solid fa-user"></i> <?php echo " Bienvenido $Nombre_de_usuario"?></a>
            <?php else:  ?>
              <a class="nav-link" aria-current="page" href="Login.php"><i class="fa-solid fa-user"></i> Iniciar sesion</a>
              <?php endif; ?>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="carrito.php" onclick="playSound()"> <i class="fa-solid fa-cart-shopping"></i> Carrito de compras</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catalogo.php"><i class="fa-solid fa-bag-shopping"></i> Catalogo</a>
          </li>

        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
</html>
<?php
}

function body_sahumerios($Nombre_de_usuario){
  ?>
    <h3>Nuevo e imperdible</h3>

    <section class="products">

      <a class="product-card" href="Productos.php?id=1&name=epicos-josesahumerios" style="text-decoration:none;color:inherit;">
        <img src="img/sahur.jpg" alt="Producto 1">
        <p>Epicos josesahumerios</p>
        <p>Epicos y anashe</p>
        <p>$9999</p>
      </a>

      <a class="product-card" href="Productos.php?id=2&name=producto-2" style="text-decoration:none;color:inherit;">
        <img src="img/sahur.jpg" alt="Producto 2">
        <p>Producto</p>
        <p>Pequeña descripción y su precio</p>
      </a>

      <a class="product-card" href="Productos.php?id=3&name=producto-3" style="text-decoration:none;color:inherit;">
        <img src="img/sahur.jpg" alt="Producto 3">
        <p>Producto</p>
        <p>Pequeña descripción y su precio</p>
      </a>

    </section>

<div class="promo-box container-fluid">
  <div class="promo-inner">
    <div class="promo-bg"></div>

    <div class="promo-buttons">
      <a href="catalogo.php"><button class="promo-btn dark">Ver catálogo</button></a>
      <a href="https://www.roblox.com"><button class="promo-btn purple">¿Cómo comprar?</button></a>
      <a href="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcT36fg28121RMt8fjDSSl58avFrWiTcwmDnpq_TEX0mB-91lJkOVZ4PAsGQyRLTKVWHBwDhYskoU4RhhizuRmFyi2q4TYJeoDSmIdw_izJ4sQ"><button class="promo-btn dark">Skibidi Marley</button></a>
    </div>

    <div class="promo-image">
      <img src="img/sahur.jpg" alt="Inciensos Aromanza">
    </div>
  </div>
</div>



    <h3>Comentarios</h3>

    <section class="comments">
        <div class="comment">
            <p>“Yo soy Marley”</p>
            <div class="comment-author">
                <img src="img/marle.jpg" alt="Foto de Marley">
                <span>Marley</span>
            </div>
        </div>

        <div class="comment">
            <p>“No puede ser, soy Marley”</p>
            <div class="comment-author">
                <img src="img/toilet.jpg" alt="Foto de Marley 2">
                <span>Marley 2</span>
            </div>
        </div>

        <div class="comment">
            <p>“No puede ser, soy Marley”</p>
            <div class="comment-author">
                <img src="img/faraon.jpg" alt="Foto de Marley 2">
                <span>Marley 2</span>
            </div>
        </div>
    </section>
    <?php if (isset($Nombre_de_usuario) == false): ?>
    <footer>
      <p>¡Te puedes registrar aquí!</p>
      <button class="register-button" onclick="document.location='Login.php'">Registrarme</button>
      <div class="footer-info">
        <p>Sahumerios Teiwaz</p>
        <a href="https://www.instagram.com/sahumerios.teiwaz/">Instagram</a>
        <a href="https://whatsapp.com/channel/0029Vaqgs150lwgyMm5Izk2X">Whatsapp</a>
      </div>
    </footer>
    <?php else: ?>
      <footer>
      <p><?php echo " Bienvenido $Nombre_de_usuario"?></p>
      <div class="footer-info">
        <p>Sahumerios Teiwaz</p>
        <a href="https://www.instagram.com/sahumerios.teiwaz/">Instagram</a>
        <a href="https://whatsapp.com/channel/0029Vaqgs150lwgyMm5Izk2X">Whatsapp</a>
      </div>
    </footer>
  </div>
  <?php endif; ?>
  <?php
}
function footer(){
  ?>
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
  <?php
}