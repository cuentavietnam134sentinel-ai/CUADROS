<x-app-layout title="Mi Perfil — NachoResina">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Mi Cuenta</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="space-y-2">
                <a href="{{ route('customer.profile') }}" class="block px-4 py-3 rounded-xl bg-cyan-600 text-white font-semibold text-sm shadow">Perfil</a>
                <a href="{{ route('customer.orders') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Mis Pedidos</a>
                <a href="{{ route('customer.custom') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Solicitudes Personalizadas</a>
                <a href="{{ route('customer.addresses') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Direcciones</a>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-3 bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-150">Actualizar Datos Personales</h3>

                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 text-emerald-800 p-4 rounded-xl text-sm border border-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow transition">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
