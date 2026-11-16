<x-app-layout title="Pedido Confirmado — NachoResina">
    <div class="max-w-3xl mx-auto px-4 py-20 text-center">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <span class="text-xs uppercase tracking-widest text-emerald-600 font-bold mb-2 block">¡Transacción Exitosa!</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4">Pedido Confirmado #{{ $order->id }}</h1>
        <p class="text-slate-600 text-sm mb-8 leading-relaxed max-w-lg mx-auto">
            Hemos recibido tu pedido correctamente. Nuestro equipo de artistas preparará el embalaje especial de seguridad para tu cuadro de resina.
        </p>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm text-left mb-8">
            <h3 class="font-bold text-slate-900 mb-4 text-base border-b border-slate-100 pb-3">Detalles del Envío y Pago</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <span class="text-slate-500 block text-xs uppercase font-medium">Dirección de Entrega</span>
                    <p class="font-semibold text-slate-800 mt-1">{{ $order->delivery_address['line1'] ?? '' }}, {{ $order->delivery_address['city'] ?? '' }} ({{ $order->delivery_address['postal_code'] ?? '' }})</p>
                </div>
                <div>
                    <span class="text-slate-500 block text-xs uppercase font-medium">Teléfono</span>
                    <p class="font-semibold text-slate-800 mt-1">{{ $order->delivery_address['phone'] ?? '' }}</p>
                </div>
            </div>

            <h4 class="font-bold text-slate-900 mb-3 text-sm">Obras Adquiridas:</h4>
            <div class="space-y-3 mb-6">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center text-sm bg-slate-50 p-3 rounded-xl">
                        <span class="font-medium text-slate-800">{{ $item->quantity }}x {{ $item->product_name_snapshot }}</span>
                        <span class="font-bold text-slate-900">€{{ number_format($item->price_snapshot * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-slate-100 pt-4 flex justify-between items-center text-base font-extrabold text-slate-900">
                <span>Total Pagado</span>
                <span class="text-cyan-600">€{{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('catalog.index') }}" class="bg-slate-900 text-white text-sm font-semibold px-8 py-3.5 rounded-xl hover:bg-cyan-600 transition">Seguir Explorando</a>
            <a href="{{ route('customer.orders') }}" class="bg-cyan-50 text-cyan-700 border border-cyan-200 text-sm font-semibold px-8 py-3.5 rounded-xl hover:bg-cyan-100 transition">Ver Mis Pedidos</a>
        </div>
    </div>
</x-app-layout>
