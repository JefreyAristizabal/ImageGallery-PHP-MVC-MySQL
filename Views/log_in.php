<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Ultra Animado</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Fondo animado tipo estrellas */
    @keyframes starPulse {
      0%, 100% { opacity: 0.3; transform: scale(1); }
      50% { opacity: 1; transform: scale(1.2); }
    }
    .star {
      animation: starPulse 3s infinite ease-in-out;
    }
    .star:nth-child(odd) {
      animation-duration: 4s;
    }

    /* Animación de entrada del formulario */
    @keyframes slideDownFade {
      0% { opacity: 0; transform: translateY(-40px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    /* Glow en el botón */
    .glow-btn {
      box-shadow: 0 0 8px #7f00ff, 0 0 20px #7f00ff;
      transition: box-shadow 0.3s ease-in-out;
    }
    .glow-btn:hover {
      box-shadow: 0 0 20px #bb00ff, 0 0 40px #bb00ff;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-black min-h-screen flex items-center justify-center relative overflow-hidden text-white font-sans">

  <!-- Enlace arriba a la izquierda -->
  <a href="#" class="absolute top-6 left-6 text-3xl font-bold tracking-wide text-purple-400 hover:text-purple-600 transition-colors select-none">
    FotoGalería
  </a>

  <!-- Fondo con estrellas animadas -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute bg-white rounded-full opacity-30 w-1 h-1 top-20 left-10 star"></div>
    <div class="absolute bg-white rounded-full opacity-40 w-1.5 h-1.5 top-32 left-52 star"></div>
    <div class="absolute bg-white rounded-full opacity-20 w-0.5 h-0.5 top-10 left-80 star"></div>
    <div class="absolute bg-white rounded-full opacity-50 w-2 h-2 top-72 left-24 star"></div>
    <div class="absolute bg-white rounded-full opacity-35 w-1.2 h-1.2 top-60 left-60 star"></div>
    <div class="absolute bg-white rounded-full opacity-40 w-1 h-1 top-48 left-10 star"></div>
    <div class="absolute bg-white rounded-full opacity-25 w-1 h-1 top-80 left-72 star"></div>
  </div>

  <!-- Formulario -->
  <form
    class="bg-gradient-to-tr from-purple-800 via-indigo-800 to-indigo-900 p-10 rounded-3xl shadow-2xl w-96 animate-slideDownFade"
    style="animation: slideDownFade 0.8s ease forwards"
  >
    <h1 class="text-4xl font-extrabold mb-8 text-center tracking-wider drop-shadow-lg">Inicia Sesión</h1>

    <label for="email" class="block text-sm mb-2 font-semibold tracking-wide">Correo Electrónico</label>
    <input
      type="email"
      id="email"
      name="email"
      placeholder="ejemplo@correo.com"
      required
      class="w-full mb-6 px-4 py-3 rounded-xl bg-indigo-900 placeholder-indigo-400 text-white focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50 transition shadow-md"
    />

    <label for="password" class="block text-sm mb-2 font-semibold tracking-wide">Contraseña</label>
    <input
      type="password"
      id="password"
      name="password"
      placeholder="********"
      required
      class="w-full mb-8 px-4 py-3 rounded-xl bg-indigo-900 placeholder-indigo-400 text-white focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50 transition shadow-md"
    />

    <button
      type="submit"
      class="glow-btn w-full bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-3 rounded-2xl text-lg transition-shadow duration-300"
    >
      Entrar
    </button>
  </form>
</body>
</html>
