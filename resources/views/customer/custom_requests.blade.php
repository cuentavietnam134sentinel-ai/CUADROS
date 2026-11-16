<x-app-layout title="Mis Solicitudes Personalizadas — NachoResina">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Mi Cuenta</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-2">
                <a href="{{ route('customer.profile') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Perfil</a>
                <a href="{{ route('customer.orders') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Mis Pedidos</a>
                <a href="{{ route('customer.custom') }}" class="block px-4 py-3 rounded-xl bg-cyan-600 text-white font-semibold text-sm shadow">Solicitudes Personalizadas</a>
                <a href="{{ route('customer.addresses') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Direcciones</a>
            </div>

            <div class="md:col-span-3 space-y-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-slate-900">Mis Solicitudes a Medida</h3>
                    <a href="{{ route('custom.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow transition">Nueva Solicitud</a>
                </div>

                @if($requests->isEmpty())
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 text-center text-slate-500 text-sm">
                        No has enviado ninguna solicitud personalizada.
                    </div>
                @else
                    @foreach($requests as $req)
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3 text-xs">
                                <span class="font-bold text-slate-900 text-sm">Solicitud #{{ $req->id }} • {{ $req->dimensions }}</span>
                                <span class="bg-cyan-100 text-cyan-800 font-bold px-3 py-1 rounded-full uppercase tracking-wider text-[10px]">{{ $req->status }}</span>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed"><strong class="text-slate-900">Idea:</strong> {{ $req->description }}</p>

                            <div class="grid grid-cols-2 gap-4 text-xs bg-slate-50 p-4 rounded-xl">
                                <div><span class="text-slate-400 block uppercase">Paleta</span> <span class="font-semibold text-slate-800">{{ $req->color_palette }}</span></div>
                                <div><span class="text-slate-400 block uppercase">Acabado</span> <span class="font-semibold text-slate-800">{{ $req->finish }}</span></div>
                            </div>

                            @if($req->quote_price)
                                <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl flex justify-between items-center text-sm">
                                    <div>
                                        <span class="font-bold text-amber-900 block">Cotización del Artista: €{{ number_format($req->quote_price, 2) }}</span>
                                        <span class="text-xs text-amber-700">Tiempo estimado: {{ $req->quote_making_time }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    {{ $requests->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
