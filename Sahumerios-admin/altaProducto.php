<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Productos - ingreso</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fuente Irish Grover -->
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- CSS personalizado -->
  <link rel="stylesheet" href="ingreso.css">
  <link rel="stylesheet" href="cssGeneral.css">
</head>

<body style="background: url('img/foto.png') center/cover no-repeat;">
    <?php
    session_start();//para mantener la sesion abierta
    include 'funciones.php';

    navAdmin();
    ?>
  </br></br></br></br><!--solucionar profecional-->
  <main class="form-section d-flex flex-column align-items-center justify-content-center">
    <h2 class="mb-4">Ingreso de producto</h2>

    <form action="metadatosAltaProducto.php" method="post" id="productoForm" class="form-box p-4 rounded">
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="Nombre" class="form-control" id="nombre" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <input type="text" name="Descripcion" class="form-control" id="descripcion" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Marca</label>
        <select id="Marca" class="form-select" name="Marca" required>
          <option value="">Seleccionar marca</option>
          <option value="1">Aromanza</option>
          <option value="2">Sagrada Madre</option>
          <option value="3">Iluminarte</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label d-block">Categorías</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="1" name="Categoria" value="1">
          <label class="form-check-label">Sahumerios</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="2" name="Categoria" value="2">
          <label class="form-check-label">Humidificadores</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="3" name="Categoria" value="3">
          <label class="form-check-label">Sahumadores</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="4" name="Categoria" value="3">
          <label class="form-check-label">Estatuas</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Proveedor</label>
        <select id="Proveedor" class="form-select" name="Proveedor" required>
          <option value="">Seleccionar proveedor</option>
          <option value="1">SUKHA</option>
          <option value="2">Intis</option>
          <option value="3">La catedral</option>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Stock disponible</label>
          <input type="number" name="Stock" class="form-control" id="stockDisponible" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Stock mínimo</label>
          <input type="number" name="StockMinimo" class="form-control" id="stockMinimo" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Costo</label>
          <input type="number" name="Costo" class="form-control" id="costo" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Precio</label>
          <input type="number" name="Precio" class="form-control" id="precio" required>
        </div>
      </div>
    <!---el metadatos va a procesar numeros de precio y costo tambien, y nos mostrará la ganancia-->
      <div class="text-center">
        <input type="submit" class="btn btn-light mt-3" value="Subir">
      </div>
    </form>
  </main>

  <?php
    footer();
  ?>
</body>
</html>

