<x-app-layout title="Finalizar Compra — NachoResina">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Finalizar Compra</h1>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm p-4 rounded-xl">
                @foreach($errors->all() as $error)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            @csrf
            <!-- Shipping & Payment Form -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Address Section -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fa-solid fa-truck-fast text-cyan-600 mr-3"></i>
                        <span>Dirección de Envío</span>
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Dirección (Calle, número, piso)</label>
                            <input type="text" name="line1" value="{{ old('line1') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Calle Arte 12, 3º B">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Ciudad</label>
                                <input type="text" name="city" value="{{ old('city') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Valencia">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Código Postal</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="46001">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono de contacto (para el transportista especializado)</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="+34 600 123 456">
                        </div>
                    </div>
                </div>

                <!-- Live Payment Preview Section -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fa-solid fa-credit-card text-cyan-600 mr-3"></i>
                        <span>Pago Demostración Seguro</span>
                    </h2>

                    <!-- Visual Card Preview -->
                    <div id="cardPreview" class="w-full max-w-sm mx-auto bg-gradient-to-tr from-slate-900 via-cyan-900 to-teal-800 text-white rounded-2xl p-6 shadow-2xl mb-8 border border-white/20 relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-amber-500/20 rounded-full blur-xl"></div>
                        <div class="flex justify-between items-center mb-8">
                            <i class="fa-solid fa-sim-card text-3xl text-amber-300"></i>
                            <i class="fa-brands fa-cc-visa text-3xl text-white"></i>
                        </div>
                        <div id="cardNumberPreview" class="text-xl font-mono tracking-widest mb-6">4532 •••• •••• 8888</div>
                        <div class="flex justify-between items-end text-xs">
                            <div>
                                <span class="block text-[10px] text-cyan-300 uppercase">Titular</span>
                                <span id="cardNamePreview" class="font-bold uppercase tracking-wider">NOMBRE DEL TITULAR</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-cyan-300 uppercase">Expira</span>
                                <span class="font-bold">12/28</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre en la Tarjeta</label>
                            <input type="text" id="cardNameInput" name="card_name" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500 uppercase" placeholder="MARÍA GARCÍA">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Número de Tarjeta</label>
                            <input type="text" id="cardNumberInput" name="card_number" value="4532 8888 7777 6666" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 font-mono focus:ring-2 focus:ring-cyan-500" placeholder="4532 8888 7777 6666">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Resumen de la Compra</h3>

                @php
                    $subtotal = $cart->items->sum(fn($i) => $i->price_at_add * $i->quantity);
                    $shipping = $subtotal > 300 ? 0 : 25.00;
                    $total = $subtotal + $shipping;
                @endphp

                <div class="space-y-4 text-sm text-slate-600 mb-6">
                    @foreach($cart->items as $item)
                        <div class="flex justify-between text-xs">
                            <span class="truncate max-w-[180px]">{{ $item->quantity }}x {{ $item->product->name }}</span>
                            <span class="font-semibold text-slate-900">€{{ number_format($item->price_at_add * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="border-t border-slate-100 pt-4 flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-semibold text-slate-900">€{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Envío asegurado</span>
                        <span class="font-semibold text-slate-900">{{ $shipping == 0 ? '¡Gratis!' : '€' . number_format($shipping, 2) }}</span>
                    </div>
                    <div class="border-t border-slate-100 pt-4 flex justify-between text-base font-extrabold text-slate-900">
                        <span>Total a pagar</span>
                        <span>€{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-cyan-500/25 transition flex items-center justify-center space-x-2 text-base">
                    <i class="fa-solid fa-lock"></i>
                    <span>Confirmar y Pagar (€{{ number_format($total, 2) }})</span>
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Live card preview interaction
        const nameInput = document.getElementById('cardNameInput');
        const namePreview = document.getElementById('cardNamePreview');
        const numberInput = document.getElementById('cardNumberInput');
        const numberPreview = document.getElementById('cardNumberPreview');

        nameInput.addEventListener('input', (e) => {
            namePreview.textContent = e.target.value || 'NOMBRE DEL TITULAR';
        });

        numberInput.addEventListener('input', (e) => {
            numberPreview.textContent = e.target.value || '4532 •••• •••• 8888';
        });
    </script>
    @endpush
</x-app-layout>
