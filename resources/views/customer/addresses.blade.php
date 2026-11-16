<x-app-layout title="Mis Direcciones — NachoResina">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Mi Cuenta</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-2">
                <a href="{{ route('customer.profile') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Perfil</a>
                <a href="{{ route('customer.orders') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Mis Pedidos</a>
                <a href="{{ route('customer.custom') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Solicitudes Personalizadas</a>
                <a href="{{ route('customer.addresses') }}" class="block px-4 py-3 rounded-xl bg-cyan-600 text-white font-semibold text-sm shadow">Direcciones</a>
            </div>

            <div class="md:col-span-3 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Direcciones de Envío</h3>

                @if(session('success'))
                    <div class="bg-emerald-50 text-emerald-800 p-4 rounded-xl text-sm border border-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if($addresses->isEmpty())
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 text-center text-slate-500 text-sm">
                        No tienes direcciones guardadas.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($addresses as $addr)
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-sm space-y-2">
                                <p class="font-bold text-slate-900">{{ $addr->line1 }}</p>
                                <p class="text-slate-600">{{ $addr->city }} ({{ $addr->postal_code }})</p>
                                <p class="text-slate-500 text-xs">Tel: {{ $addr->phone }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Add Address Form -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm mt-8">
                    <h4 class="font-bold text-slate-900 text-base mb-4">Añadir Nueva Dirección</h4>
                    <form action="{{ route('customer.addresses.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Dirección (Calle, número)</label>
                            <input type="text" name="line1" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Ciudad</label>
                                <input type="text" name="city" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Código Postal</label>
                                <input type="text" name="postal_code" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono</label>
                            <input type="text" name="phone" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500">
                        </div>
                        <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow transition">
                            Guardar Dirección
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
