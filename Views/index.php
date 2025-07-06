<?php
session_start();

require_once __DIR__ . '/../Models/Users.php';
require_once __DIR__ . '/../Models/Photos.php';
require_once __DIR__ . '/../Controllers/Database.php';
require_once __DIR__ . '/../Controllers/UsersController.php';
require_once __DIR__ . '/../Controllers/PhotosController.php';

$users_ctrl = new UsersController();
$users = $users_ctrl->getAllUsers();

$photos_ctrl = new PhotosController();
$photos = $photos_ctrl->getAllPhotos();

// Agrupar fotos por categoría
$grouped_photos = [];
foreach ($photos as $photo) {
    $category = $photo->getCategory();
    if (!isset($grouped_photos[$category])) {
        $grouped_photos[$category] = [];
    }
    $grouped_photos[$category][] = $photo;
}

$grouped_photos_array = [];

foreach ($grouped_photos as $category => $photoList) {
    $grouped_photos_array[$category] = array_map(function($photo) {
        return [
            'photo' => $photo->getPhoto(),
            'category' => $photo->getCategory(),
            'id_photo' => $photo->getIdPhoto()
        ];
    }, $photoList);
}


// Últimas 3 fotos como destacadas
$featured_photos = array_slice(array_reverse($photos), 0, 3);

// Obtener el nombre del usuario con id_user = 1
$main_username = 'FotoGalería';
foreach ($users as $user) {
    if ($user->getIdUser() == 1) {
        $main_username = 'FotoGalería ' . htmlspecialchars($user->getUsername());
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
  <title>Galería Minimalista con Menú</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #categoryGallery::-webkit-scrollbar {
      width: 8px;
    }
    #categoryGallery::-webkit-scrollbar-thumb {
      background-color: rgba(99, 102, 241, 0.6);
      border-radius: 4px;
    }
    #categoryMenu.no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    #categoryMenu.no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen pt-16">

<header class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <h1 class="text-3xl font-bold tracking-wide text-indigo-600">
      <?= $main_username ?>
    </h1>
    <div class="space-x-4">
      <button id="musicBtn" class="hidden md:inline-block px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold" onclick="document.getElementById('bg-audio').play();">Música</button>
      <?php if (isset($_SESSION['username'])): ?>
        <div class="relative inline-block text-left" id="userDropdownContainer">
          <!-- Botón con ícono -->
          <button onclick="toggleDropdown()" class="flex items-center space-x-2 px-4 py-2 bg-indigo-100 text-indigo-700 font-semibold rounded-full hover:bg-indigo-200 transition">
            <svg class="w-5 h-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span><?= htmlspecialchars($_SESSION['username']) ?></span>
            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
      
          <!-- Menú desplegable -->
          <div id="userDropdown" class="absolute right-0 z-50 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 hidden">
            <div class="py-1">
              <a href="/user" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100">Panel</a>
              <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Cerrar Sesión</a>
            </div>
          </div>
        </div>
      
        <script>
          function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
          }
        
          // Cerrar si se hace clic afuera
          document.addEventListener('click', function (event) {
            const container = document.getElementById('userDropdownContainer');
            const dropdown = document.getElementById('userDropdown');
            if (!container.contains(event.target)) {
              dropdown.classList.add('hidden');
            }
          });
        </script>
      <?php else: ?>
        <a href="/login" class="hidden md:inline-block px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold">Iniciar Sesión</a>
      <?php endif; ?>

    </div>
  </div>
</header>

<section class="relative w-full max-w-7xl mx-auto mt-10 px-6 sm:px-8">
  <h2 class="text-4xl font-semibold mb-8 text-center text-indigo-700">Fotos Destacadas</h2>
  <div id="featuredPhotos" class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <?php foreach ($featured_photos as $photo): ?>
      <div class="overflow-hidden rounded-lg shadow-lg cursor-pointer transform hover:scale-105 transition">
        <img src="/img/<?= htmlspecialchars($photo->getPhoto()) ?>" alt="Destacada" class="w-full h-72 object-cover" />
      </div>
    <?php endforeach; ?>
  </div>
</section>

<nav id="categoryMenu" class="mx-auto mt-16 mb-8 bg-white/90 backdrop-blur-md rounded-full shadow-md px-6 py-2 flex space-x-6 max-w-full overflow-x-auto no-scrollbar">
  <?php $first = true; foreach ($grouped_photos as $category => $photos): ?>
    <button class="py-2 px-5 rounded-full font-semibold cursor-pointer whitespace-nowrap transition <?= $first ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white text-indigo-700 hover:bg-indigo-100' ?>" data-category="<?= htmlspecialchars($category) ?>">
      <?= htmlspecialchars($category) ?>
    </button>
  <?php $first = false; endforeach; ?>
</nav>

<section id="categoryGallery" class="max-w-7xl mx-auto mt-0 mb-20 px-6 sm:px-8" style="max-height: 70vh; overflow-y: auto; width: 100%;">
  <!-- Las fotos se inyectan por JS -->
</section>

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
  <source src="/mp3/mario.mp3" type="audio/mpeg">
</audio>

<script>
  const allPhotos = <?= json_encode($grouped_photos_array, JSON_UNESCAPED_SLASHES) ?>;

  function renderCategory(category) {
    const container = document.getElementById('categoryGallery');
    container.innerHTML = '';

    if (!allPhotos[category] || allPhotos[category].length === 0) {
      container.innerHTML = `<p class="text-center text-gray-500">No hay fotos en esta categoría.</p>`;
      return;
    }

    const grid = document.createElement('div');
    grid.className = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8";

    allPhotos[category].forEach(photo => {
      const card = document.createElement('div');
      card.className = "rounded overflow-hidden shadow-md cursor-pointer hover:shadow-xl transition transform hover:scale-105";
      card.innerHTML = `<img src="/img/${photo.photo}" alt="${photo.category}" class="w-full h-72 object-cover" loading="lazy" />`;
      grid.appendChild(card);
    });

    container.appendChild(grid);
  }

  window.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('bg-audio');
    audio.volume = 0.5;
    audio.play().catch(() => console.warn("Autoplay bloqueado"));

    const buttons = document.querySelectorAll('#categoryMenu button');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(btn => {
          btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg');
          btn.classList.add('bg-white', 'text-indigo-700');
        });
        button.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
        button.classList.remove('bg-white');

        renderCategory(button.dataset.category);
      });
    });

    // Mostrar la primera categoría al inicio
    if (buttons.length > 0) {
      renderCategory(buttons[0].dataset.category);
    }
  });

  document.getElementById('loginBtn').addEventListener('click', () => {
    //refirigir al logjn
    window.location.href = '/login';
  });
</script>

</body>
</html>
