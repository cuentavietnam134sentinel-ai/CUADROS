<x-app-layout title="Galería de Obras — NachoResina">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-10">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Catálogo Exclusivo</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Galería de Cuadros en Resina Epoxi</h1>
            <p class="text-slate-600 mt-2 text-sm max-w-2xl">Descubre piezas únicas, series limitadas y obras creadas artesanalmente con resinas de alta transparencia y pigmentos profesionales.</p>
        </div>

        <!-- Filters Form -->
        <form method="GET" action="{{ route('catalog.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Categoría</label>
                <select name="category" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-cyan-500">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tipo de Pieza</label>
                <select name="type" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-cyan-500">
                    <option value="">Todos los tipos</option>
                    <option value="unique" {{ request('type') == 'unique' ? 'selected' : '' }}>Pieza Única (1/1)</option>
                    <option value="limited_series" {{ request('type') == 'limited_series' ? 'selected' : '' }}>Serie Limitada</option>
                    <option value="made_to_order" {{ request('type') == 'made_to_order' ? 'selected' : '' }}>Bajo Pedido</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Disponibilidad</label>
                <select name="status" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-cyan-500">
                    <option value="">Cualquier estado</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Vendida</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ordenar por</label>
                <select name="sort" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-cyan-500">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Más recientes</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow transition flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-filter"></i>
                    <span>Filtrar</span>
                </button>
                <a href="{{ route('catalog.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-semibold py-2.5 px-3 rounded-xl transition flex items-center justify-center" title="Limpiar filtros">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
            </div>
        </form>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
                <div class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">No se encontraron obras</h3>
                <p class="text-slate-500 text-sm mb-6">Prueba a cambiar los filtros de búsqueda o explora todo nuestro catálogo.</p>
                <a href="{{ route('catalog.index') }}" class="bg-slate-900 text-white text-sm font-semibold px-6 py-3 rounded-xl hover:bg-cyan-600 transition">Ver todas las obras</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="spatial-card flex flex-col justify-between">
                        <div>
                            <div class="aspect-[4/3] overflow-hidden relative">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                <div class="absolute top-3 left-3 flex flex-col gap-1">
                                    @if($product->type === 'unique')
                                        <span class="bg-amber-500 text-slate-950 font-bold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider shadow">Pieza Única (1/1)</span>
                                    @endif
                                    @if($product->status === 'sold')
                                        <span class="bg-red-600 text-white font-bold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider shadow">Vendida</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <span class="text-xs text-cyan-600 font-semibold uppercase tracking-wider">{{ $product->category->name }}</span>
                                <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">
                                    <a href="{{ route('catalog.show', $product) }}" class="hover:text-cyan-600 transition">{{ $product->name }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 mb-3 line-clamp-2">{{ $product->description }}</p>
                                <p class="text-xs text-slate-500 mb-4"><i class="fa-solid fa-ruler-combined mr-1 text-slate-400"></i> {{ $product->dimensions }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-extrabold text-slate-900">€{{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('catalog.show', $product) }}" class="bg-slate-900 text-white text-xs font-semibold px-4 py-2.5 rounded-xl hover:bg-cyan-600 transition">Ver Detalle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
