<x-app-layout title="Proceso Artesanal — NachoResina">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Maestría y Dedicación</span>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">El Proceso Artesanal de Creación</h1>
            <p class="text-slate-600 text-base leading-relaxed">
                Cada cuadro de resina epoxi NachoResina es una obra de arte irrepetible que requiere días de meticulosa elaboración, desde la selección de la madera hasta el pulido final de alta precisión.
            </p>
        </div>

        <div class="space-y-16 max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="text-cyan-600 font-bold text-sm">Paso 01</span>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1 mb-4">Selección y Preparación del Bastidor</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Trabajamos con maderas nobles y tableros hidrófugos de alta densidad preparados específicamente para soportar el peso y tensión de la resina. Cada superficie se nivela con precisión milimétrica para garantizar un vertido perfecto.
                    </p>
                </div>
                <div class="aspect-[16/10] rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('img/pages/preparacion.jpg') }}" alt="Preparación" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="order-2 md:order-1 aspect-[16/10] rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('img/pages/vertido-resina.jpg') }}" alt="Vertido resina" class="w-full h-full object-cover">
                </div>
                <div class="order-1 md:order-2">
                    <span class="text-cyan-600 font-bold text-sm">Paso 02</span>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1 mb-4">Vertido por Capas y Efectos Dinámicos</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Utilizamos resina epoxi de dos componentes con inhibidores UV. Mediante técnicas de calor y soplado manual, creamos las crestas espumosas de las olas y las formaciones minerales tridimensionales de las geodas.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="text-cyan-600 font-bold text-sm">Paso 03</span>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1 mb-4">Curado Controlado y Pulido Espejo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Cada capa requiere 48 horas de curado en ambiente libre de polvo y temperatura controlada. Una vez solidificada, la pieza pasa por un riguroso proceso de lijado y pulido al alto brillo que realza la profundidad cristalina.
                    </p>
                </div>
                <div class="aspect-[16/10] rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('img/pages/taller-obra.jpg') }}" alt="Pulido" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
