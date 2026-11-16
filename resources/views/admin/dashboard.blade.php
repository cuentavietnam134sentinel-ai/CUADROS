<x-admin-layout header="Dashboard Administrador">
    <div class="space-y-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-1">Total Productos</span>
                <span class="text-3xl font-extrabold text-slate-900">{{ $stats['products_count'] }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-1">Total Pedidos</span>
                <span class="text-3xl font-extrabold text-slate-900">{{ $stats['orders_count'] }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-1">Ingresos Totales</span>
                <span class="text-3xl font-extrabold text-emerald-600">€{{ number_format($stats['revenue'], 2) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-1">Solicitudes Nuevas</span>
                <span class="text-3xl font-extrabold text-amber-600">{{ $stats['custom_requests_count'] }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Orders -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-900 text-base mb-4">Pedidos Recientes</h3>
                <div class="space-y-3">
                    @foreach($recentOrders as $order)
                        <div class="flex justify-between items-center text-sm p-3 bg-slate-50 rounded-xl">
                            <div>
                                <span class="font-bold text-slate-900">#{{ $order->id }} - {{ $order->user->name ?? 'Cliente' }}</span>
                                <span class="block text-xs text-slate-400">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <span class="font-extrabold text-cyan-600">€{{ number_format($order->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Custom Requests -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-900 text-base mb-4">Solicitudes Personalizadas Recientes</h3>
                <div class="space-y-3">
                    @foreach($recentRequests as $req)
                        <div class="flex justify-between items-center text-sm p-3 bg-slate-50 rounded-xl">
                            <div>
                                <span class="font-bold text-slate-900">{{ $req->name }}</span>
                                <span class="block text-xs text-slate-400">{{ $req->dimensions }} • {{ $req->color_palette }}</span>
                            </div>
                            <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">{{ $req->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
