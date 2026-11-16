<x-app-layout title="Carrito de Compras — NachoResina">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Tu Carrito de Compras</h1>

        @if(!$cart || $cart->items->isEmpty())
            <div class="bg-white rounded-2xl p-16 text-center border border-slate-200">
                <div class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Tu carrito está vacío</h3>
                <p class="text-slate-500 text-sm mb-6">Explora nuestra galería y añade obras de arte exclusivas a tu carrito.</p>
                <a href="{{ route('catalog.index') }}" class="bg-cyan-600 text-white font-semibold text-sm px-8 py-3 rounded-xl hover:bg-cyan-700 transition">Explorar Galería</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Items list -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart->items as $item)
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
                            <div class="flex items-center space-x-4 w-full sm:w-auto">
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-base">{{ $item->product->name }}</h4>
                                    <span class="text-xs text-cyan-600 font-semibold">{{ $item->product->category->name }}</span>
                                    <p class="text-xs text-slate-500 mt-1">Medidas: {{ $item->product->dimensions }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-6">
                                <span class="text-lg font-extrabold text-slate-900">€{{ number_format($item->price_at_add * $item->quantity, 2) }}</span>

                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-2" title="Eliminar"><i class="fa-solid fa-trash text-base"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Sidebar -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm h-fit">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Resumen del Pedido</h3>

                    @php
                        $subtotal = $cart->items->sum(fn($i) => $i->price_at_add * $i->quantity);
                        $shipping = $subtotal > 300 ? 0 : 25.00;
                        $total = $subtotal + $shipping;
                    @endphp

                    <div class="space-y-4 text-sm text-slate-600 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-semibold text-slate-900">€{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Envío asegurado</span>
                            <span class="font-semibold text-slate-900">{{ $shipping == 0 ? '¡Gratis!' : '€' . number_format($shipping, 2) }}</span>
                        </div>
                        @if($subtotal <= 300)
                            <p class="text-xs text-cyan-600 bg-cyan-50 p-2.5 rounded-lg"><i class="fa-solid fa-circle-info mr-1"></i> ¡Añade €{{ number_format(300 - $subtotal, 2) }} más para obtener envío gratis!</p>
                        @endif
                        <div class="border-t border-slate-100 pt-4 flex justify-between text-base font-extrabold text-slate-900">
                            <span>Total</span>
                            <span>€{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-cyan-500/25 transition flex items-center justify-center space-x-2 text-center block">
                        <span>Proceder al Pago</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
