<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KP2T — @yield('title', 'Panel')</title>
  <link rel="icon" type="image/jpeg" href="{{ asset('images/_ (1).jpeg') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 flex">

  <!-- Sidebar -->
  <aside class="w-64 min-h-screen bg-gray-900 border-r border-gray-800 fixed top-0 left-0">
    <div class="p-6 border-b border-gray-800">
      <span class="text-xl font-bold text-white">KP2T <span class="text-blue-500">Panel</span></span>
    </div>
    <nav class="p-4 space-y-1">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
        📈 Dashboard
      </a>
      <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
        📁 Projects
      </a>
      <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
        ✉️ Messages
      </a>
      <hr class="border-gray-700 my-2">
      <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
        🏠 View Site
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-900/30 transition">
          🚪 Logout
        </button>
      </form>
    </nav>
  </aside>

  <div class="ml-64 flex-1 p-8">
    @if(session('success'))
      <div class="mb-4 bg-green-900/40 border border-green-700 text-green-300 px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif
    @yield('content')
  </div>

</body>
</html>