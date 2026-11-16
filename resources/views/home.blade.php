<x-app-layout title="NachoResina — Cuadros de Resina Epoxi y Arte Exclusivo">
    <!-- Hero Section -->
    <section class="spatial-hero py-24 md:py-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="spatial-badge mb-4 inline-block"><i class="fa-solid fa-gem mr-1.5 text-cyan-400"></i> Piezas de Arte 100% Únicas y Artesanales</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                    La Elegancia del <span class="bg-gradient-to-r from-cyan-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">Océano y la Resina</span> en tu Hogar
                </h1>
                <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                    Transformamos espacios con cuadros decorativos de resina epoxi de alta gama. Olas marinas con efecto realista, geodas minerales y acabados metálicos exclusivos que cautivan los sentidos.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('catalog.index') }}" class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold px-8 py-4 rounded-xl shadow-xl hover:shadow-cyan-500/25 hover:scale-[1.02] transition text-center flex items-center justify-center space-x-2">
                        <span>Explorar Galería</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('custom.create') }}" class="bg-white/10 backdrop-blur-md border border-white/20 text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/20 transition text-center flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-palette text-amber-300"></i>
                        <span>Diseñar a Medida</span>
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-1 rounded-2xl bg-gradient-to-tr from-cyan-500 to-amber-500 opacity-30 blur-xl"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10 aspect-[4/3]">
                    <img src="{{ asset('img/pages/hero-home.jpg') }}" alt="Cuadro resina epoxi" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Colecciones Exclusivas</span>
            <h2 class="text-3xl font-extrabold text-slate-900">Encuentra la Obra Perfecta para tu Espacio</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="spatial-card group block">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-lg font-bold text-white mb-1">{{ $category->name }}</h3>
                            <p class="text-xs text-slate-300 line-clamp-2">{{ $category->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Products -->
    <section class="bg-slate-100/70 py-20 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Galería Destacada</span>
                    <h2 class="text-3xl font-extrabold text-slate-900">Obras Disponibles</h2>
                </div>
                <a href="{{ route('catalog.index') }}" class="text-sm font-semibold text-cyan-600 hover:text-cyan-700 flex items-center space-x-1">
                    <span>Ver todas las obras</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
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
        </div>
    </section>

    <!-- Craft Process Highlight -->
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="spatial-badge mb-4 inline-block"><i class="fa-solid fa-hands-holding-child mr-1.5 text-cyan-600"></i> Artesanía y Pasión</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-6">El Arte de Crear con Resina Epoxi</h2>
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Cada cuadro requiere múltiples etapas de vertido, curado de precisión durante 48 horas y pulido a mano. Utilizamos resinas epoxi de alta calidad con protección UV para garantizar que el brillo y los colores permanezcan intactos durante décadas.
                </p>
                <div class="space-y-4 mb-8">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xs mt-0.5">1</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Preparación de bastidores y pigmentos</h4>
                            <p class="text-xs text-slate-500">Selección de maderas nobles y mezcla artesanal de tintes y polvos nacarados.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xs mt-0.5">2</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Vertido por capas y efectos dinámicos</h4>
                            <p class="text-xs text-slate-500">Creación manual de olas con pistola de calor y texturas geológicas en relieve.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xs mt-0.5">3</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Pulido espejo y control de calidad</h4>
                            <p class="text-xs text-slate-500">Acabado pulido al alto brillo y empaque de seguridad reforzado.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('process') }}" class="inline-flex items-center space-x-2 text-sm font-semibold text-cyan-600 hover:text-cyan-700">
                    <span>Conoce todo el proceso paso a paso</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="{{ asset('img/pages/taller-obra.jpg') }}" alt="Taller resina" class="rounded-2xl shadow-lg aspect-[3/4] object-cover">
                <img src="{{ asset('img/pages/detalle-obra.jpg') }}" alt="Detalle obra" class="rounded-2xl shadow-lg aspect-[3/4] object-cover mt-8">
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    @if($reviews->count() > 0)
    <section class="bg-cyan-950 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs uppercase tracking-widest text-cyan-400 font-bold mb-2 block">Opiniones Reales</span>
            <h2 class="text-3xl font-extrabold mb-16">Lo que dicen nuestros coleccionistas</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($reviews as $review)
                    <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 text-left flex flex-col justify-between">
                        <div>
                            <div class="flex text-amber-400 mb-4 text-sm">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <p class="text-slate-200 text-sm leading-relaxed mb-6">"{{ $review->comment }}"</p>
                        </div>
                        <div class="flex items-center space-x-3 pt-4 border-t border-white/10">
                            <div class="w-10 h-10 rounded-full bg-cyan-600 text-white flex items-center justify-center font-bold">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">{{ $review->user->name }}</h4>
                                <span class="text-xs text-cyan-300">Coleccionista Verificado</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-app-layout>
