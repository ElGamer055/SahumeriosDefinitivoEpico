




document.addEventListener("DOMContentLoaded", function () {
  const frases = [
    "Hoy es un buen día para un sahumerio.",
    "Conéctate con tu esencia.",
    "Respirá profundo y dejá que fluya.",
    "Aromas que inspiran tu alma.",
    "Un momento de paz cada día."
  ];

  const indice = Math.floor(Math.random() * frases.length);
  const elemento = document.getElementById("frase-aleatoria");
  
  if (elemento) {
    elemento.textContent = frases[indice];
  }
});

// === Funcionalidad del carrito ===
  const updateTotal = () => {
    let total = 0;
    const items = document.querySelectorAll('.cart-items .card');
    items.forEach(item => {
      const priceText = item.querySelector('span.fw-bold').textContent;
      const price = parseFloat(priceText.replace(/[^\d]/g, '')); // solo números
      const quantity = parseInt(item.querySelector('input').value);
      total += price * quantity;
    });
    const totalInput = document.querySelector('.offcanvas-body input[readonly]');
    if (totalInput) totalInput.value = `$${total.toLocaleString('es-AR')}`;
  };

  // === Botones + y - ===
  const cartItems = document.querySelectorAll('.cart-items .card');

  cartItems.forEach(item => {
    const minusBtn = item.querySelector('.minus');
    const plusBtn = item.querySelector('.plus');
    const input = item.querySelector('input[type="number"]');

    // Evita escribir manualmente
    input.addEventListener('keydown', e => e.preventDefault());

    minusBtn.addEventListener('click', () => {
      let value = parseInt(input.value);
      if (value > parseInt(input.min)) {
        input.value = value - 1;
        updateTotal();
      }
    });

    plusBtn.addEventListener('click', () => {
      input.value = parseInt(input.value) + 1;
      updateTotal();
    });
  });

  // === Botón "Borrar carrito" ===
  const clearButton = document.querySelector('.clear');
  if (clearButton) {
    clearButton.addEventListener('click', () => {
      document.querySelector('.cart-items').innerHTML = '';
      const totalInput = document.querySelector('.offcanvas-body input[readonly]');
      if (totalInput) totalInput.value = '$0';
    });
  }

  // === Botón "Confirmar compra" ===
  const confirmButton = document.querySelector('.confirm');
  if (confirmButton) {
    confirmButton.addEventListener('click', () => {
      const items = document.querySelectorAll('.cart-items .card');
      if (items.length === 0) {
        alert("Tu carrito está vacío.");
        return;
      }

      const modal = document.createElement('div');
      modal.classList.add(
        'modal', 'position-fixed', 'top-0', 'start-0',
        'w-100', 'h-100', 'd-flex', 'justify-content-center',
        'align-items-center', 'bg-dark', 'bg-opacity-75'
      );
      modal.innerHTML = `
        <div class="bg-black p-4 rounded text-center">
          <h3>✅ ¡Compra realizada!</h3>
          <p>Se enviará una confirmación a tu correo.</p>
          <button id="closeModal" class="btn btn-purple mt-2">Aceptar</button>
        </div>
      `;
      document.body.appendChild(modal);

      document.getElementById('closeModal').addEventListener('click', () => {
        modal.remove();
        document.querySelector('.cart-items').innerHTML = '';
        const totalInput = document.querySelector('.offcanvas-body input[readonly]');
        if (totalInput) totalInput.value = '$0';
      });
    });
  }

  // === Inicializar total ===
  updateTotal();
