<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bienvenida - Sahumerios Teiwaz</title>
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="cssPrincipal.css">
  <link rel="stylesheet" href="cssGeneral.css">
  <script src="https://kit.fontawesome.com/a2e0c7e7d3.js"></script>
</head>
<body style="background: url('img/foto.png') center/cover no-repeat;">
    <?php
    session_start();//para mantener la sesion abierta
    include 'funciones.php';

    navAdmin();
    ?>

  <section class="principal-section">
    <h1>Bienvenida</h1>
    <h2>Gisela</h2>
  </section>

  <?php
    footer();
  ?>

  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>