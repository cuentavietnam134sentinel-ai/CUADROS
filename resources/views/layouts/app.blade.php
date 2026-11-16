<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'NachoResina — Cuadros de Resina Epoxi' }}</title>
    <!-- Tailwind CSS CDN or Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/spatial-ui.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Top Notification Banner -->
    <div class="bg-cyan-900 text-cyan-100 text-xs py-2 px-4 text-center font-medium">
        <i class="fa-solid fa-sparkles mr-1 text-amber-400"></i> Arte exclusivo en resina epoxi • Envío asegurado y certificado de autenticidad en cada pieza.
    </div>

    <!-- Navigation Header -->
    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('img/logo.png') }}" alt="NachoResina Logo" class="w-10 h-10 rounded-xl object-cover shadow-md">
                    <div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Nacho<span class="text-cyan-600">Resina</span></span>
                        <span class="block text-[10px] uppercase tracking-widest text-slate-500 font-semibold">Fine Epoxy Art</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('home') ? 'text-cyan-600 font-semibold' : '' }}">Inicio</a>
                <a href="{{ route('catalog.index') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('catalog.*') ? 'text-cyan-600 font-semibold' : '' }}">Galería</a>
                <a href="{{ route('custom.create') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('custom.*') ? 'text-cyan-600 font-semibold' : '' }}">Personalizados <span class="bg-amber-100 text-amber-700 text-[10px] px-1.5 py-0.5 rounded-full ml-1">Configurador</span></a>
                <a href="{{ route('process') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('process') ? 'text-cyan-600 font-semibold' : '' }}">Proceso</a>
                <a href="{{ route('care') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('care') ? 'text-cyan-600 font-semibold' : '' }}">Cuidados</a>
                <a href="{{ route('faq') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('faq') ? 'text-cyan-600 font-semibold' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('contact') ? 'text-cyan-600 font-semibold' : '' }}">Contacto</a>
            </nav>

            <!-- Actions / Auth / Cart -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-600 hover:text-cyan-600 transition" title="Carrito">
                    <i class="fa-solid fa-bag-shopping text-xl"></i>
                    @php
                        $cartCount = 0;
                        if(auth()->check()) {
                            $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                            if($cart) $cartCount = $cart->items()->sum('quantity');
                        } else {
                            $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
                            if($cart) $cartCount = $cart->items()->sum('quantity');
                        }
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 bg-cyan-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold shadow">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-sm font-medium text-slate-700 hover:text-cyan-600 p-2 rounded-lg bg-slate-100 transition">
                            <div class="w-8 h-8 rounded-full bg-cyan-600 text-white flex items-center justify-center font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 hidden group-hover:block z-50">
                            <a href="{{ route('customer.profile') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-cyan-50 hover:text-cyan-600"><i class="fa-solid fa-user-gear mr-2"></i> Mi Cuenta</a>
                            <a href="{{ route('customer.orders') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-cyan-50 hover:text-cyan-600"><i class="fa-solid fa-box-open mr-2"></i> Mis Pedidos</a>
                            <a href="{{ route('customer.custom') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-cyan-50 hover:text-cyan-600"><i class="fa-solid fa-palette mr-2"></i> Mis Solicitudes</a>
                            @if(auth()->user()->is_admin)
                                <div class="border-t border-slate-100 my-1"></div>
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-amber-600 font-semibold hover:bg-amber-50"><i class="fa-solid fa-shield-halved mr-2"></i> Panel Admin</a>
                            @endif
                            <div class="border-t border-slate-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-cyan-600 text-sm font-semibold px-3 py-2 transition">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition">Registrarse</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Flash Messages / Toast Notification -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4 w-full">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4 w-full">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-exclamation text-red-600 text-xl"></i>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 mt-20 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="NachoResina Logo" class="w-8 h-8 rounded-xl object-cover">
                    <span class="text-lg font-bold text-white">Nacho<span class="text-cyan-400">Resina</span></span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">
                    Creación exclusiva de cuadros de resina epoxi de alta gama. Arte contemporáneo, piezas únicas y acabados profesionales inspirados en la naturaleza.
                </p>
                <div class="flex space-x-4 text-slate-400">
                    <a href="#" class="hover:text-cyan-400 transition"><i class="fa-brands fa-instagram text-lg"></i></a>
                    <a href="#" class="hover:text-cyan-400 transition"><i class="fa-brands fa-pinterest text-lg"></i></a>
                    <a href="#" class="hover:text-cyan-400 transition"><i class="fa-brands fa-whatsapp text-lg"></i></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Enlaces Rápidos</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-cyan-400 transition">Galería de Cuadros</a></li>
                    <li><a href="{{ route('custom.create') }}" class="hover:text-cyan-400 transition">Configurador Personalizado</a></li>
                    <li><a href="{{ route('process') }}" class="hover:text-cyan-400 transition">Proceso Artesanal</a></li>
                    <li><a href="{{ route('care') }}" class="hover:text-cyan-400 transition">Guía de Cuidados</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Ayuda y Legal</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('faq') }}" class="hover:text-cyan-400 transition">Preguntas Frecuentes</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-cyan-400 transition">Contacto y Soporte</a></li>
                    <li><a href="{{ route('legal.terms') }}" class="hover:text-cyan-400 transition">Términos y Condiciones</a></li>
                    <li><a href="{{ route('legal.privacy') }}" class="hover:text-cyan-400 transition">Política de Privacidad</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Atención al Cliente</h4>
                <p class="text-sm text-slate-400 mb-3"><i class="fa-solid fa-location-dot text-cyan-400 mr-2"></i> Studio & Taller: Valencia, España</p>
                <p class="text-sm text-slate-400 mb-3"><i class="fa-solid fa-envelope text-cyan-400 mr-2"></i> hola@nachoresina.com</p>
                <p class="text-sm text-slate-400"><i class="fa-solid fa-phone text-cyan-400 mr-2"></i> +34 600 123 456</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-slate-800 text-xs text-slate-500 flex flex-col sm:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} NachoResina. Todos los derechos reservados.</p>
            <p class="mt-2 sm:mt-0">Desarrollado con Laravel 11 • Arte en Resina Epoxi</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
