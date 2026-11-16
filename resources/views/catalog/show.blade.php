<x-app-layout title="{{ $product->name }} — NachoResina">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="text-xs text-slate-500 mb-8 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-cyan-600">Inicio</a>
            <span>/</span>
            <a href="{{ route('catalog.index') }}" class="hover:text-cyan-600">Galería</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Product Images -->
            <div class="spatial-card p-4 bg-white">
                <div class="aspect-[4/3] rounded-xl overflow-hidden shadow-inner mb-4 relative">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @if($product->status === 'sold')
                        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center">
                            <span class="bg-red-600 text-white text-lg font-extrabold px-6 py-3 rounded-2xl shadow-2xl tracking-widest uppercase">Pieza Vendida</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold bg-cyan-50 px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                    @if($product->type === 'unique')
                        <span class="bg-amber-100 text-amber-800 font-bold text-xs px-3 py-1 rounded-full"><i class="fa-solid fa-gem mr-1"></i> Pieza Única (1/1)</span>
                    @endif
                </div>

                <h1 class="text-3xl font-extrabold text-slate-900 mb-4">{{ $product->name }}</h1>

                <div class="text-3xl font-extrabold text-slate-900 mb-6">€{{ number_format($product->price, 2) }}</div>

                <p class="text-slate-600 text-sm leading-relaxed mb-6">{{ $product->description }}</p>

                <div class="space-y-3 mb-8 border-t border-b border-slate-100 py-6 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-500 font-medium"><i class="fa-solid fa-ruler-combined mr-2 text-slate-400"></i> Medidas:</span>
                        <span class="font-semibold text-slate-800">{{ $product->dimensions }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 font-medium"><i class="fa-solid fa- paintbrush mr-2 text-slate-400"></i> Materiales:</span>
                        <span class="font-semibold text-slate-800 text-right">{{ $product->materials }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 font-medium"><i class="fa-solid fa-clock mr-2 text-slate-400"></i> Disponibilidad:</span>
                        <span class="font-semibold text-slate-800">{{ $product->making_time }}</span>
                    </div>
                </div>

                @if($product->status === 'available' && $product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-cyan-500/25 transition flex items-center justify-center space-x-2 text-base">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span>Añadir al Carrito</span>
                        </button>
                    </form>
                @else
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-center font-semibold text-sm">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i> Esta pieza ya ha sido vendida y no está disponible para compra.
                    </div>
                @endif

                @if($product->care_instructions)
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2"><i class="fa-solid fa-shield-heart mr-1 text-cyan-600"></i> Cuidados de la Pieza</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $product->care_instructions }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20">
                <h3 class="text-2xl font-extrabold text-slate-900 mb-8">Obras Similares</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedProducts as $related)
                        <div class="spatial-card">
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            </div>
                            <div class="p-6">
                                <h4 class="font-bold text-slate-900 mb-2"><a href="{{ route('catalog.show', $related) }}" class="hover:text-cyan-600 transition">{{ $related->name }}</a></h4>
                                <div class="flex items-center justify-between">
                                    <span class="font-extrabold text-slate-900">€{{ number_format($related->price, 2) }}</span>
                                    <a href="{{ route('catalog.show', $related) }}" class="text-xs font-semibold text-cyan-600 hover:underline">Ver Obra</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
