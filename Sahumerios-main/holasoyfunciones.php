<?php 
error_reporting(0);



function header_sahumerios($Nombre_de_usuario){
  ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main3.css">
  
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
