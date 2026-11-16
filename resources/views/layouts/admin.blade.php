<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel de Administración — NachoResina' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex border-r border-slate-800">
        <div>
            <div class="h-20 flex items-center px-6 bg-slate-950 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-500 text-slate-950 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <span class="text-base font-bold text-white tracking-tight">Admin<span class="text-amber-400">Panel</span></span>
                        <span class="block text-[9px] text-slate-400 uppercase tracking-widest">NachoResina</span>
                    </div>
                </a>
            </div>

            <nav class="p-4 space-y-1 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.products*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-image w-5"></i>
                    <span>Productos</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.categories*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-folder-tree w-5"></i>
                    <span>Categorías</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.orders*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-box-archive w-5"></i>
                    <span>Pedidos</span>
                </a>
                <a href="{{ route('admin.custom_requests') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.custom_requests*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-palette w-5"></i>
                    <span>Personalizados</span>
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-envelope w-5"></i>
                    <span>Mensajes</span>
                </a>
                <a href="{{ route('admin.reviews') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reviews*') ? 'bg-amber-500/10 text-amber-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-star w-5"></i>
                    <span>Reseñas</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 px-4 py-2.5 rounded-xl text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Ver Sitio Web</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 shadow-sm z-10">
            <h1 class="text-xl font-bold text-slate-800">{{ $header ?? 'Panel de Control' }}</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-slate-600">{{ auth()->user()->name }} (Admin)</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold p-2"><i class="fa-solid fa-power-off"></i></button>
                </form>
            </div>
        </header>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 m-6 mb-0 text-sm rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-6 mb-0 text-sm rounded shadow">
                {{ session('error') }}
            </div>
        @endif

        <main class="flex-1 overflow-y-auto p-8">
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>
</html>
