<x-app-layout title="Mis Pedidos — NachoResina">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Mi Cuenta</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-2">
                <a href="{{ route('customer.profile') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Perfil</a>
                <a href="{{ route('customer.orders') }}" class="block px-4 py-3 rounded-xl bg-cyan-600 text-white font-semibold text-sm shadow">Mis Pedidos</a>
                <a href="{{ route('customer.custom') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Solicitudes Personalizadas</a>
                <a href="{{ route('customer.addresses') }}" class="block px-4 py-3 rounded-xl bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm border border-slate-200">Direcciones</a>
            </div>

            <div class="md:col-span-3 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Historial de Pedidos</h3>

                @if($orders->isEmpty())
                    <div class="bg-white p-8 rounded-2xl border border-slate-200 text-center text-slate-500 text-sm">
                        No has realizado ningún pedido todavía.
                    </div>
                @else
                    @foreach($orders as $order)
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3 text-xs">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm">Pedido #{{ $order->id }}</span>
                                    <span class="text-slate-400 ml-2">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <span class="bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full uppercase tracking-wider text-[10px]">{{ $order->status }}</span>
                            </div>

                            <div class="space-y-2">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-700">{{ $item->quantity }}x {{ $item->product_name_snapshot }}</span>
                                        <span class="font-semibold text-slate-900">€{{ number_format($item->price_snapshot * $item->quantity, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-slate-100 pt-3 flex justify-between items-center text-sm font-extrabold text-slate-900">
                                <span>Total</span>
                                <span class="text-cyan-600">€{{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    @endforeach

                    {{ $orders->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
