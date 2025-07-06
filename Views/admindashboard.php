<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex min-h-screen">
  <!-- Sidebar -->
  <div class="w-64 bg-white shadow-md p-5">
    <h1 class="text-2xl font-bold mb-10 text-blue-500">Admin Panel</h1>
    <nav class="space-y-4">
      <a href="/user" class="block text-gray-700 hover:text-blue-600">Dashboard</a>
      <a href="/user/createDefault" class="block text-gray-700 hover:text-blue-600">Crear Usuario por Defecto</a>
      <a href="/" class="block text-gray-700 hover:text-blue-600">Página Principal</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-8 space-y-12">

    <!-- Contenedor Usuarios -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold mb-6 text-indigo-700">Gestión de Usuarios</h2>

      <!-- Tabla Usuarios -->
      <div class="overflow-x-auto mb-6">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-gray-500">ID</th>
              <th class="px-4 py-2 text-left text-gray-500">Usuario</th>
              <th class="px-4 py-2 text-left text-gray-500">Rol</th>
              <th class="px-4 py-2 text-left text-gray-500">Estado</th>
              <th class="px-4 py-2 text-left text-gray-500">Acciones</th>
            </tr>
          </thead>
            <!-- Usuarios -->
            <tbody id="tableUsersBody" class="divide-y divide-gray-200">
              <?php foreach ($users as $user): ?>
                <tr>
                  <td class="px-4 py-2"><?= htmlspecialchars($user->getIdUser()) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($user->getUsername()) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($user->getRole()) ?></td>
                  <td class="px-4 py-2">
                    <span class="px-2 inline-block text-xs rounded-full <?= $user->getStatus() === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                      <?= htmlspecialchars($user->getStatus()) ?>
                    </span>
                  </td>
                  <td class="px-4 py-2 space-x-2">
                    <a href="/user/update/<?= $user->getIdUser() ?>" class="text-blue-600 hover:underline">Editar</a>
                    <a href="/user/delete/<?= $user->getIdUser() ?>" class="text-red-600 hover:underline" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
        </table>
        <!-- Paginación Usuarios -->
        <div id="paginationUsers" class="flex justify-center mt-4 space-x-2"></div>
      </div>

      <!-- Formulario Crear Usuario -->
      <h3 class="text-lg font-semibold mb-4">Crear nuevo usuario</h3>
      <form action="/user/create" method="POST" class="grid grid-cols-2 gap-4">
        <input type="text" name="username" placeholder="Usuario" required class="border p-2 rounded w-full">
        <input type="password" name="password" placeholder="Contraseña" required class="border p-2 rounded w-full">

        <select name="role" class="border p-2 rounded w-full" required>
          <option value="">Seleccionar Rol</option>
          <option value="admin">Admin</option>
          <option value="employee">Empleado</option>
          <option value="client">Cliente</option>
        </select>

        <select name="status" class="border p-2 rounded w-full" required>
          <option value="">Seleccionar Estado</option>
          <option value="active">Activo</option>
          <option value="inactive">Inactivo</option>
          <option value="pending">Pendiente</option>
        </select>

        <input type="text" name="profile_picture" placeholder="Foto de perfil" class="border p-2 rounded w-full">
        <input type="datetime-local" name="last_session" class="border p-2 rounded w-full">

        <button type="submit" class="col-span-2 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Crear Usuario</button>
      </form>
    </div>

    <!-- Contenedor Fotos -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold mb-6 text-green-700">Gestión de Fotos</h2>

      <!-- Tabla Fotos -->
      <div class="overflow-x-auto mb-6">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-gray-500">ID</th>
              <th class="px-4 py-2 text-left text-gray-500">Nombre Archivo</th>
              <th class="px-4 py-2 text-left text-gray-500">Categoría</th>
              <th class="px-4 py-2 text-left text-gray-500">Vista</th>
            </tr>
          </thead>
            <!-- Fotos -->
            <tbody id="tablePhotosBody" class="divide-y divide-gray-200">
              <?php foreach ($photos as $photo): ?>
                <tr>
                  <td class="px-4 py-2"><?= htmlspecialchars($photo->getIdPhoto()) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($photo->getPhoto()) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($photo->getCategory()) ?></td>
                  <td class="px-4 py-2">
                    <img src="/img/<?= htmlspecialchars($photo->getPhoto()) ?>" alt="Foto" class="h-12 rounded">
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
        </table>
        <!-- Paginación Fotos -->
        <div id="paginationPhotos" class="flex justify-center mt-4 space-x-2"></div>
      </div>

      <!-- Formulario Subir Foto -->
      <h3 class="text-lg font-semibold mb-4">Subir nueva foto</h3>
      <form action="/photo/upload" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
        <input type="file" name="photo" accept="image/*" required class="border p-2 rounded w-full">
        <select name="category" class="border p-2 rounded w-full" required>
            <option value="">Seleccionar Categoría</option>
            <option value="Naturaleza">Naturaleza</option>
            <option value="Arquitectura">Arquitectura</option>
            <option value="Personas">Personas</option>
            <option value="Animales">Animales</option>
            <option value="Tecnologia">Tecnología</option>
        </select>
        <button type="submit" class="col-span-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Subir Foto</button>
      </form>
    </div>

  </div>
</div>

<script>
function paginateTable(tableId, paginationId, rowsPerPage = 10, maxVisiblePages = 5) {
  const table = document.getElementById(tableId);
  const pagination = document.getElementById(paginationId);
  const rows = Array.from(table.getElementsByTagName('tr'));
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  let currentPage = 1;

  function showPage(page) {
    currentPage = page;
    const start = (page - 1) * rowsPerPage;
    const end = page * rowsPerPage;

    rows.forEach((row, index) => {
      row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    renderPagination();
  }

  function renderPagination() {
    pagination.innerHTML = '';

    const addButton = (label, page, isActive = false, isDisabled = false) => {
      const btn = document.createElement('button');
      btn.textContent = label;
      btn.className = `px-3 py-1 rounded mx-1 ${isActive ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 border border-blue-600'} ${isDisabled ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-500 hover:text-white'} transition`;
      if (!isDisabled) btn.addEventListener('click', () => showPage(page));
      pagination.appendChild(btn);
    };

    addButton('«', Math.max(currentPage - 1, 1), false, currentPage === 1);

    let startPage = Math.max(currentPage - Math.floor(maxVisiblePages / 2), 1);
    let endPage = startPage + maxVisiblePages - 1;

    if (endPage > totalPages) {
      endPage = totalPages;
      startPage = Math.max(endPage - maxVisiblePages + 1, 1);
    }

    if (startPage > 1) {
      addButton('1', 1);
      if (startPage > 2) {
        const dots = document.createElement('span');
        dots.textContent = '...';
        dots.className = 'text-gray-500 px-2';
        pagination.appendChild(dots);
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      addButton(i, i, i === currentPage);
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        const dots = document.createElement('span');
        dots.textContent = '...';
        dots.className = 'text-gray-500 px-2';
        pagination.appendChild(dots);
      }
      addButton(totalPages, totalPages);
    }

    addButton('»', Math.min(currentPage + 1, totalPages), false, currentPage === totalPages);
  }

  if (rows.length > rowsPerPage) {
    showPage(1);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  paginateTable('tableUsersBody', 'paginationUsers', 10, 5);
  paginateTable('tablePhotosBody', 'paginationPhotos', 10, 5);
});
</script>
<script>
function paginateTable(tableId, paginationId, rowsPerPage = 10, maxVisiblePages = 5) {
  const table = document.getElementById(tableId);
  const pagination = document.getElementById(paginationId);
  const rows = Array.from(table.getElementsByTagName('tr'));
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  let currentPage = 1;

  function showPage(page) {
    currentPage = page;
    const start = (page - 1) * rowsPerPage;
    const end = page * rowsPerPage;

    rows.forEach((row, index) => {
      row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    renderPagination();
  }

  function renderPagination() {
    pagination.innerHTML = '';

    const addButton = (label, page, isActive = false, isDisabled = false) => {
      const btn = document.createElement('button');
      btn.textContent = label;
      btn.className = `px-3 py-1 rounded mx-1 ${isActive ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 border border-blue-600'} ${isDisabled ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-500 hover:text-white'} transition`;
      if (!isDisabled) btn.addEventListener('click', () => showPage(page));
      pagination.appendChild(btn);
    };

    addButton('«', Math.max(currentPage - 1, 1), false, currentPage === 1);

    let startPage = Math.max(currentPage - Math.floor(maxVisiblePages / 2), 1);
    let endPage = startPage + maxVisiblePages - 1;

    if (endPage > totalPages) {
      endPage = totalPages;
      startPage = Math.max(endPage - maxVisiblePages + 1, 1);
    }

    if (startPage > 1) {
      addButton('1', 1);
      if (startPage > 2) {
        const dots = document.createElement('span');
        dots.textContent = '...';
        dots.className = 'text-gray-500 px-2';
        pagination.appendChild(dots);
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      addButton(i, i, i === currentPage);
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        const dots = document.createElement('span');
        dots.textContent = '...';
        dots.className = 'text-gray-500 px-2';
        pagination.appendChild(dots);
      }
      addButton(totalPages, totalPages);
    }

    addButton('»', Math.min(currentPage + 1, totalPages), false, currentPage === totalPages);
  }

  if (rows.length > rowsPerPage) {
    showPage(1);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  paginateTable('tableUsersBody', 'paginationUsers', 10, 5);
  paginateTable('tablePhotosBody', 'paginationPhotos', 10, 5);
});
</script>


</body>
</html>
