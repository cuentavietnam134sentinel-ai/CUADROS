<x-auth-layout>
    <div class="liquid-glass-card">
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center mx-auto mb-3 shadow-lg">
                <i class="fa-solid fa-water text-xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Crear Cuenta</h2>
            <p class="text-xs text-slate-300 mt-1">Únete a nuestra comunidad de amantes del arte en resina</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-200 text-xs p-3 rounded-xl">
                @foreach($errors->all() as $error)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Nombre Completo</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="liquid-glass-input pl-10 text-sm" placeholder="Tu Nombre">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required class="liquid-glass-input pl-10 text-sm" placeholder="tu@correo.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Teléfono (para envíos)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="liquid-glass-input pl-10 text-sm" placeholder="+34 600 000 000">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="liquid-glass-input pl-10 text-sm" placeholder="Mínimo 8 caracteres">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Confirmar Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" required class="liquid-glass-input pl-10 text-sm" placeholder="Repite tu contraseña">
                </div>
            </div>

            <button type="submit" class="liquid-glass-btn text-sm mt-2">Crear mi cuenta</button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-300">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-cyan-400 font-semibold hover:underline">Inicia sesión</a>
        </div>
    </div>
</x-auth-layout>
