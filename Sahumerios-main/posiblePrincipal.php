<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Teiwaz Sahumerios</title>
  <!-- Fuentes y Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="cssPosiblePrincipal.css">
</head>
<body>

    <?php
    include 'holasoyfunciones.php';
    ?>
    
  <!-- Botones de menú y carrito -->
  <div class="position-fixed top-0 start-0 p-3 z-3">
    <button class="btn btn-custom" data-bs-toggle="offcanvas" data-bs-target="#menuCategorias"><i class="bi bi-list"></i> Menú</button>
  </div>
  <div class="position-fixed top-0 end-0 p-3 z-3">
    <button class="btn btn-custom" data-bs-toggle="offcanvas" data-bs-target="#carritoCompras"><i class="bi bi-cart"></i> Carrito</button>
  </div>

  <div class="container py-4">
    <header>
      <h1>Teiwaz Sahumerios</h1>
      <p>--- frases aleatorias aquí ---</p>
    </header>

    <div class="text-center mb-3">
      <span class="badge text-light">nuevo e imperdible</span>
    </div>

    <div class="row g-3 mb-4" id="cards">
      <!-- Cards dinámicas -->
    </div>

    <div class="row align-items-start g-4">
      <div class="col-lg-8">
        <div class="p-3 rounded" style="background-color: rgba(0, 0, 0, 0.93);">
          <div class="row g-3 align-items-center">
            <div class="col-md-6">
              <div id="preview" class="thumb" style="background-image:url('sahumerio.jpg'); height:220px;"></div>
            </div>
            <div class="col-md-6 d-flex flex-column gap-3">
              <a href="#catalogo" class="btn btn-custom">Ver catálogo</a>
              <a href="#comprar" class="btn btn-custom">¿Cómo comprar?</a>
              <a href="#marley" class="btn btn-custom">Skibidi Marley</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-flex flex-column gap-3">
        <div class="card p-3">
          <div class="thumb mb-2" style="background-image:url('sahumerio.jpg')"></div>
          <small class="text-secondary">categoría, producto, precio, descripción corta</small>
          <h6 class="mt-1">Producto destacado</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Menú lateral -->
  <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="menuCategorias">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menú</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled">
        <li><a href="#" class="text-white text-decoration-none d-block py-1">Marleys</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-1">Marley</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-1">si</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-1">Queso</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-1">Kits energéticos</a></li>
      </ul>
    </div>
  </div>

  <!-- Carrito lateral -->
  <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="carritoCompras">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Carrito de compras</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <p class="text-secondary">Tu carrito está vacío por ahora...</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sample = {
      title: 'Sahumerio pack clásico',
      cat: 'categoría, producto, precio, descripción corta',
      img: 'assets/product-sample.jpg'
    };

    const cardsEl = document.getElementById('cards');
    for(let i=0; i<3; i++){
      const col = document.createElement('div');
      col.className = 'col-12 col-md-4';
      col.innerHTML = `
        <div class='card p-3 h-100'>
          <div class='thumb mb-2' style='background-image:url(${sample.img})'></div>
          <small class='text-secondary'>${sample.cat}</small>
          <h6 class='mt-1'>${sample.title}</h6>
        </div>`;
      cardsEl.appendChild(col);
    }

    cardsEl.addEventListener('click', e => {
      const card = e.target.closest('.card');
      if(!card) return;
      const thumb = card.querySelector('.thumb');
      document.getElementById('preview').style.backgroundImage = thumb.style.backgroundImage;
    });
  </script>
</body>
</html>
