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
  if (elemento) elemento.textContent = frases[indice];

  const STORAGE_KEY = 'cart_sahumerios';

  // Obtener carrito desde localStorage (normalizado)
  const getCart = () => {
    try {
      const raw = localStorage.getItem(STORAGE_KEY);
      if (!raw) return [];
      const parsed = JSON.parse(raw);
      if (!Array.isArray(parsed)) return [];
      return parsed.map(it => ({
        id: String(it.id),
        title: it.title || '',
        price: Number(it.price) || 0,
        img: it.img || '',
        qty: Math.max(1, Number(it.qty) || 1)
      }));
    } catch (e) {
      console.error('Error parsing cart from localStorage', e);
      return [];
    }
  };

  const saveCart = (cart) => {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
    } catch (e) {
      console.error('Error saving cart to localStorage', e);
    }
  };

  const formatNumberForDisplay = (num) => {
    return `$${num.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
  };

  const updateTotal = () => {
    const cart = getCart();
    const total = cart.reduce((acc, it) => acc + (Number(it.price) * Number(it.qty)), 0);
    const totalInput = document.querySelector('.offcanvas-body input[readonly]');
    if (totalInput) totalInput.value = formatNumberForDisplay(total);
  };

  // Añadir o sumar cantidad si existe
  const addToCart = (product) => {
    if (!product || !product.id) return;
    const cart = getCart();
    const idx = cart.findIndex(i => String(i.id) === String(product.id));
    if (idx > -1) {
      cart[idx].qty = Math.max(1, Number(cart[idx].qty) + (Number(product.qty) || 1));
    } else {
      cart.push({
        id: String(product.id),
        title: product.title || '',
        price: Number(product.price) || 0,
        img: product.img || '',
        qty: Math.max(1, Number(product.qty) || 1)
      });
    }
    saveCart(cart);
    renderCart();
    updateTotal();
  };
  // Exponer para usos externos (si se llama desde HTML)
  window.appAddToCart = addToCart;

  // Render del carrito
  const renderCart = () => {
    const cartContainer = document.querySelector('.cart-items');
    if (!cartContainer) return;
    const cart = getCart();
    cartContainer.innerHTML = '';
    if (cart.length === 0) {
      cartContainer.innerHTML = '<p class="text-muted">Tu carrito está vacío.</p>';
      updateTotal();
      return;
    }

    const fragment = document.createDocumentFragment();
    cart.forEach(item => {
      const div = document.createElement('div');
      div.className = 'cart-item d-flex align-items-center mb-2';
      div.innerHTML = `
        <img src="${item.img || 'img/sahur.jpg'}" alt="${item.title}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:10px;">
        <div class="flex-grow-1">
          <div class="fw-semibold">${item.title}</div>
          <div class="text-muted small">${formatNumberForDisplay(Number(item.price))} x ${item.qty}</div>
        </div>
        <div class="ms-2 text-end">
          <button class="btn btn-sm btn-outline-light btn-decrease" data-id="${item.id}">-</button>
          <button class="btn btn-sm btn-outline-light btn-increase" data-id="${item.id}">+</button>
          <button class="btn btn-sm btn-danger btn-remove mt-1" data-id="${item.id}">Eliminar</button>
        </div>
      `;
      fragment.appendChild(div);
    });
    cartContainer.appendChild(fragment);

    // Bind botones
    cartContainer.querySelectorAll('.btn-decrease').forEach(b => {
      b.addEventListener('click', () => {
        const id = b.dataset.id;
        const c = getCart();
        const idx = c.findIndex(it => it.id === id);
        if (idx >= 0) {
          c[idx].qty = Math.max(1, Number(c[idx].qty) - 1);
          saveCart(c);
          renderCart();
          updateTotal();
        }
      });
    });
    cartContainer.querySelectorAll('.btn-increase').forEach(b => {
      b.addEventListener('click', () => {
        const id = b.dataset.id;
        const c = getCart();
        const idx = c.findIndex(it => it.id === id);
        if (idx >= 0) {
          c[idx].qty = Number(c[idx].qty) + 1;
          saveCart(c);
          renderCart();
          updateTotal();
        }
      });
    });
    cartContainer.querySelectorAll('.btn-remove').forEach(b => {
      b.addEventListener('click', () => {
        const id = b.dataset.id;
        const c = getCart().filter(it => it.id !== id);
        saveCart(c);
        renderCart();
        updateTotal();
      });
    });
  };

  // Manejo de botones data-add-to-cart
  document.querySelectorAll('[data-add-to-cart]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const el = e.currentTarget;
      const product = {
        id: el.dataset.id,
        title: el.dataset.title,
        price: el.dataset.price,
        img: el.dataset.img,
        qty: el.dataset.qty ? Number(el.dataset.qty) : 1
      };
      addToCart(product);
    });
  });

  // Interceptar formularios que envían a cart_add.php (si existen)
  document.querySelectorAll('form[action="cart_add.php"]').forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(form);
      const product = {
        id: fd.get('id'),
        title: fd.get('title'),
        price: fd.get('price'),
        img: fd.get('img'),
        qty: fd.get('qty') || 1
      };
      addToCart(product);
      // Si se desea mantener el comportamiento server-side, descomentar:
      // form.submit();
    });
  });

  // Botón "Borrar carrito"
  const clearButton = document.querySelector('.clear');
  if (clearButton) {
    clearButton.addEventListener('click', () => {
      saveCart([]);
      renderCart();
      updateTotal();
    });
  }

  // Botón "Confirmar compra" -> aquí puedes enviar localStorage al servidor
  const confirmButton = document.querySelector('.confirm');
  if (confirmButton) {
    confirmButton.addEventListener('click', () => {
      // Ejemplo: enviar al servidor vía fetch
      const cart = getCart();
      if (cart.length === 0) return alert('Carrito vacío');
      fetch('cart_sync.php', { // crea este endpoint si quieres persistir en sesión/DB
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cart })
      }).then(r => r.json())
        .then(data => {
          console.log('Compra confirmada', data);
          // opcional: vaciar carrito local
          // saveCart([]);
          // renderCart();
          // updateTotal();
        }).catch(err => console.error(err));
    });
  }

  // Inicializar vista
  renderCart();
  updateTotal();

  // Re-render al abrir offcanvas (si bootstrap está cargado)
  const cartOffcanvas = document.getElementById('cartOffcanvas');
  if (cartOffcanvas && window.bootstrap) {
    cartOffcanvas.addEventListener('show.bs.offcanvas', function () {
      renderCart();
      updateTotal();
    });
  }
});
