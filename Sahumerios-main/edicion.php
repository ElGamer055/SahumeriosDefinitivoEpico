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

<body>
    <?php
    session_start();//para mantener la sesion abierta
    include 'holasoyfunciones.php';

    navAdmin();
    ?>
  </br></br></br></br><!--solucionar profecional-->
  <main class="form-section d-flex flex-column align-items-center justify-content-center">
    <h2 class="mb-4">Ingreso de producto</h2>

    <form action="metadatosAltaProducto.php" method="post" id="productoForm" class="form-box p-4 rounded">
      <div class="mb-3">
        <label class="form-label">Ofertas</label>
        <input type="text" name="oferta" class="form-control" id="oferta">
      </div>

      <div class="mb-3">
        <label class="form-label">Frase</label>
        <input type="text" name="frase" class="form-control" id="frase" >
      </div>

      <div class="mb-3">
        <label class="form-label">Marca</label>
        <input type="text" name="marca" class="form-control" id="marca" >
      </div>

      <div class="mb-3">
        <label class="form-label">Categorías</label>
        <input type="text" name="categoria" class="form-control" id="categoria" >
      </div>

      <div class="mb-3">
        <label class="form-label">Proveedor</label>
        <input type="text" name="proveedor" class="form-control" id="proveedor" >
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

