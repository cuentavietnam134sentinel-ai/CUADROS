<x-auth-layout>
    <div class="liquid-glass-card">
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-teal-400 flex items-center justify-center mx-auto mb-3 shadow-lg">
                <i class="fa-solid fa-water text-xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Iniciar Sesión</h2>
            <p class="text-xs text-slate-300 mt-1">Accede a tu cuenta de NachoResina</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-200 text-xs p-3 rounded-xl">
                @foreach($errors->all() as $error)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="liquid-glass-input pl-10 text-sm" placeholder="tu@correo.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="liquid-glass-input pl-10 text-sm" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-slate-300">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-cyan-600 focus:ring-cyan-500">
                    <span>Recordarme</span>
                </label>
            </div>

            <button type="submit" class="liquid-glass-btn text-sm">Entrar a mi cuenta</button>
        </form>

        <div class="mt-8 text-center text-xs text-slate-300">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-cyan-400 font-semibold hover:underline">Regístrate aquí</a>
        </div>

        <!-- Demo credentials helper -->
        <div class="mt-6 pt-4 border-t border-white/10 text-[11px] text-slate-400 text-center">
            <p class="font-semibold text-slate-300 mb-1">Acceso Demo Rápido:</p>
            <p>Admin: <code class="text-cyan-300">admin@cuadrosresina.com</code> / <code class="text-cyan-300">password</code></p>
            <p class="mt-0.5">Cliente: <code class="text-cyan-300">cliente@cuadrosresina.com</code> / <code class="text-cyan-300">password</code></p>
        </div>
    </div>
</x-auth-layout>
