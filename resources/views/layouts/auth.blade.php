<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Acceso — NachoResina' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/liquid-glass.css') }}">
    @stack('styles')
</head>
<body class="liquid-glass-bg">

    <div class="absolute top-6 left-6">
        <a href="{{ route('home') }}" class="text-white/80 hover:text-white text-sm font-medium flex items-center space-x-2 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Volver al inicio</span>
        </a>
    </div>

    <div class="w-full px-4 flex justify-center">
        {{ $slot }}
    </div>

    @stack('scripts')
</body>
</html>
