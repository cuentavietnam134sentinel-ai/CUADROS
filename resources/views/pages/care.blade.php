<x-app-layout title="Guía de Cuidados — NachoResina">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Mantenimiento y Conservación</span>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Guía de Cuidados de tu Cuadro de Resina</h1>
            <p class="text-slate-600 text-sm max-w-2xl mx-auto">Sigue estas sencillas recomendaciones para mantener tu obra de arte impecable durante décadas.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8 bg-white p-8 sm:p-12 rounded-2xl border border-slate-200 shadow-sm text-slate-700 text-sm leading-relaxed">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold text-lg flex-shrink-0 mt-1">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1">Evita la luz solar directa prolongada</h3>
                        <p>Aunque nuestras resinas incorporan filtros UV de grado profesional, la exposición continua a la luz solar directa durante años puede alterar sutilmente los pigmentos. Se recomienda ubicar el cuadro en paredes con luz natural indirecta.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold text-lg flex-shrink-0 mt-1">
                        <i class="fa-solid fa-feather"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1">Limpieza suave con microfibra</h3>
                        <p>Para eliminar el polvo acumulado, utiliza únicamente un paño de microfibra suave y seco. Nunca utilices limpiadores químicos abrasivos, alcohol ni esponjas rugosas que puedan rayar el acabado brillo espejo.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold text-lg flex-shrink-0 mt-1">
                        <i class="fa-solid fa-temperature-arrow-up"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1">Control de temperatura y humedad</h3>
                        <p>La resina epoxi es estable en condiciones normales de interior. Evita colocar las piezas cerca de fuentes de calor intenso (radiadores, estufas) o en espacios con humedad extrema.</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -inset-4 rounded-2xl bg-cyan-100/50 blur-2xl -z-10"></div>
                <div class="rounded-2xl overflow-hidden shadow-2xl border border-white p-2 bg-white">
                    <img src="{{ asset('img/pages/cuidados.jpg') }}" alt="Limpieza y cuidado de resina" class="w-full rounded-xl object-cover aspect-[4/5]">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
