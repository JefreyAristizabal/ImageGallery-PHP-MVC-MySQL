<?php

include_once 'Models/Users.php';
include_once 'Controllers/Database.php';
include_once 'Controllers/UsersController.php';

// $user = new Users(1, "Jefrey", "pepe", date('Y-m-d H:i:s'), "", 1, 1, "");
// $connection = new Database("root", "", "mvc", "localhost");

// $conn = $connection->openConnection();

// if($conn){
//     echo "Successful connection";
// } else {
//     echo "Something went wrong";
// }

// $connection->closeConnection();

$users_ctrl = new UsersController();
$users = $users_ctrl->getUsers();

?>

<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
  <title>Galería Minimalista con Menú</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <style>
    /* Scrollbar estilizado para el contenedor de galería */
    #categoryGallery::-webkit-scrollbar {
      width: 8px;
    }
    #categoryGallery::-webkit-scrollbar-thumb {
      background-color: rgba(99, 102, 241, 0.6); /* Indigo-500 semi */
      border-radius: 4px;
    }
    /* Quitar scroll visible en menu cuando no es necesario */
    #categoryMenu.no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    #categoryMenu.no-scrollbar {
      -ms-overflow-style: none;  /* IE and Edge */
      scrollbar-width: none;  /* Firefox */
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen pt-16">

  <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Título a la izquierda -->
        <h1 class="text-3xl font-bold tracking-wide text-indigo-600">
          FotoGalería <?php
          if (!empty($users) && is_array($users)) {
              foreach ($users as $user) {
                $data = $user->toArray();
                if ($data['id_user'] == 1) {
                  echo $data['username'] . '<br>';
                }
              }
          } else {
              echo 'No users found.';
          }
          ?>
        </h1>

        <!-- Botones a la derecha -->
        <div class="space-x-4">
          <button id="musicBtn" class="hidden md:inline-block px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold" onclick="document.getElementById('bg-audio').play();">Música</button>
          <button id="loginBtn" class="hidden md:inline-block px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold">Iniciar Sesión</button>
        </div>
      </div>
    </header>


  <!-- Fotos Destacadas -->
  <section class="relative w-full max-w-7xl mx-auto mt-10 px-6 sm:px-8">
    <h2 class="text-4xl font-semibold mb-8 text-center text-indigo-700">Fotos Destacadas</h2>
    <div id="featuredPhotos" class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Fotos destacadas -->
    </div>
  </section>

  <!-- Menú centrado (NO sticky) -->
  <nav id="categoryMenu" 
    class="mx-auto mt-16 mb-8 bg-white/90 backdrop-blur-md rounded-full shadow-md px-6 py-2 flex space-x-6 max-w-full overflow-x-auto no-scrollbar"
    >
    <!-- Botones de categorías se inyectan dinámicamente aquí -->
  </nav>

  <!-- Galería categoría seleccionada (width 100%) -->
  <section 
    class="max-w-7xl mx-auto mt-0 mb-20 px-6 sm:px-8"
    style="max-height: 70vh; overflow-y: auto; width: 100%;"
    id="categoryGallery"
  >
    <!-- Fotos categoría -->
  </section>

  <!-- Footer -->
  <footer class="bg-indigo-600 text-white py-10 mt-auto">
    <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center">
      <p class="mb-6 md:mb-0 text-lg">&copy; 2025 FotoGalería. Todos los derechos reservados.</p>
      <nav class="flex space-x-10 text-lg">
        <a href="#" class="hover:underline">Acerca de</a>
        <a href="#" class="hover:underline">Contacto</a>
        <a href="#" class="hover:underline">Política de Privacidad</a>
      </nav>
    </div>
  </footer>
    <audio id="bg-audio" loop>
      <source src="/public/mp3/mario.mp3" type="audio/mpeg">
    </audio>

    <script>
      window.addEventListener('DOMContentLoaded', () => {
        const audio = document.getElementById('bg-audio');
        audio.volume = 0.5;

        audio.play().catch(error => {
          console.warn("Autoplay bloqueado, esperando interacción del usuario...");
        });
      });
    </script>

  <script>
    // Fotos destacadas
    const featuredPhotos = [
      { url: "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", alt: "Montaña al atardecer" },
      { url: "https://images.unsplash.com/photo-1519608487953-e999c86e7455?auto=format&fit=crop&w=800&q=80", alt: "Ciudad nocturna" },
      { url: "https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80", alt: "Lago reflejando el cielo" }
    ];

    // Muchas fotos por categoría simuladas
    const categories = {
      "Naturaleza": Array(20).fill(null).map((_,i) => ({
        url: `https://source.unsplash.com/800x600/?nature,water,${i}`,
        alt: `Foto naturaleza #${i+1}`
      })),
      "Arquitectura": Array(18).fill(null).map((_,i) => ({
        url: `https://source.unsplash.com/800x600/?architecture,building,${i}`,
        alt: `Foto arquitectura #${i+1}`
      })),
      "Personas": Array(25).fill(null).map((_,i) => ({
        url: `https://source.unsplash.com/800x600/?people,portrait,${i}`,
        alt: `Foto personas #${i+1}`
      })),
      "Animales": Array(15).fill(null).map((_,i) => ({
        url: `https://source.unsplash.com/800x600/?animals,${i}`,
        alt: `Foto animales #${i+1}`
      })),
      "Tecnología": Array(12).fill(null).map((_,i) => ({
        url: `https://source.unsplash.com/800x600/?technology,gadget,${i}`,
        alt: `Foto tecnología #${i+1}`
      })),
    };

    // Carga fotos destacadas
    function loadFeatured() {
      const container = document.getElementById('featuredPhotos');
      container.innerHTML = '';
      featuredPhotos.forEach(photo => {
        const div = document.createElement('div');
        div.className = "overflow-hidden rounded-lg shadow-lg cursor-pointer transform hover:scale-105 transition";
        div.innerHTML = `<img src="${photo.url}" alt="${photo.alt}" class="w-full h-72 object-cover" />`;
        container.appendChild(div);
      });
    }

    // Crear menú centrado NO sticky
    function loadCategoryMenu() {
      const menu = document.getElementById('categoryMenu');
      menu.innerHTML = '';
      const categoryNames = Object.keys(categories);

      categoryNames.forEach((cat, idx) => {
        const btn = document.createElement('button');
        btn.textContent = cat;
        btn.className = `
          py-2 px-5 rounded-full font-semibold cursor-pointer whitespace-nowrap
          transition 
          text-indigo-700 hover:bg-indigo-100
          ${idx === 0 ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white'}
        `;
        btn.dataset.category = cat;

        btn.addEventListener('click', () => {
          [...menu.children].forEach(b => {
            b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg');
            b.classList.add('bg-white', 'text-indigo-700');
          });
          btn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
          btn.classList.remove('bg-white');

          showCategoryPhotos(cat);
        });

        menu.appendChild(btn);
      });

      // Mostrar primera categoría por defecto
      if (categoryNames.length > 0) {
        showCategoryPhotos(categoryNames[0]);
      }
    }

    // Mostrar fotos categoría
    function showCategoryPhotos(category) {
      const container = document.getElementById('categoryGallery');
      container.innerHTML = '';

      const photos = categories[category] || [];
      if (photos.length === 0) {
        container.innerHTML = `<p class="text-center text-gray-500">No hay fotos en esta categoría.</p>`;
        return;
      }

      const grid = document.createElement('div');
      grid.className = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8";

      photos.forEach(photo => {
        const card = document.createElement('div');
        card.className = "rounded overflow-hidden shadow-md cursor-pointer hover:shadow-xl transition transform hover:scale-105";
        card.innerHTML = `<img src="${photo.url}" alt="${photo.alt}" class="w-full h-72 object-cover" loading="lazy" />`;
        grid.appendChild(card);
      });

      container.appendChild(grid);
    }

    // Botón inicio de sesión
    document.getElementById('loginBtn').addEventListener('click', () => {
      alert('Función de inicio de sesión aún no implementada.');
    });

    window.onload = () => {
      loadFeatured();
      loadCategoryMenu();
    };
  </script>

</body>
</html>
