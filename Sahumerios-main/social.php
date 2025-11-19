<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fuente Irish Grover -->
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- CSS personalizado -->
  <link rel="stylesheet" href="social.css">
  <link rel="stylesheet" href="cssGeneral.css">
</head>

<body>
    <?php
    session_start();//para mantener la sesion abierta
    include 'holasoyfunciones.php';

    navAdmin();
    ?>

  <main class="container text-center py-5">
    <div class="row justify-content-center mb-4">
      <div class="col-10 col-md-3">
        <button class="action-btn" data-target="#comentarios">💬 comentarios</button>
      </div>
      <div class="col-10 col-md-3">
        <button class="action-btn" data-target="#usuarios">😊 usuarios</button>
      </div>
      <div class="col-10 col-md-3">
        <button class="action-btn" data-target="#compras">🛒 compras</button>
      </div>
    </div>

    <!-- Sección de comentarios -->
    <div id="comentarios" class="content-section">
      <h2>Comentarios</h2>
      <div class="list-group">
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">"Excelente aroma y duración" — Marley</div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">"Me encantó el de lavanda" — Gisela</div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">"Entrega rápida y bien embalado" — Alex</div>
      </div>
    </div>

    <!-- Sección de usuarios -->
    <div id="usuarios" class="content-section">
      <h2>Usuarios</h2>
      <div class="list-group">
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">👤 Gisela — Activa desde 2023</div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">👤 Marley — Comprador frecuente</div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">👤 Alex — Nuevo registro</div>
      </div>
    </div>

    <!-- Sección de compras -->
    <div id="compras" class="content-section">
      <h2>Compras</h2>
      <div class="list-group">
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">
          🧾 Orden #1024 — Gisela — $3500 — Pagado
        </div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">
          🧾 Orden #1025 — Marley — $2200 — Pendiente
        </div>
        <div class="list-group-item bg-dark text-white rounded-3 mb-2">
          🧾 Orden #1026 — Alex — $4100 — Entregado
        </div>
      </div>
    </div>
    </main>
  <script>
    // --- BOTONES INTERACTIVOS ---
    const buttons = document.querySelectorAll('.action-btn');
    const sections = document.querySelectorAll('.content-section');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const target = document.querySelector(btn.dataset.target);

        // Oculta las demás secciones con animación
        sections.forEach(sec => {
          if (sec !== target) {
            sec.classList.remove('show');
          }
        });

        // Muestra u oculta la seleccionada
        target.classList.toggle('show');
      });
    });
  </script>

</body>
</html>

  <?php
    footer();
  ?>
</body>
</html>

