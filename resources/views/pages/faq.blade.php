<x-app-layout title="Preguntas Frecuentes — NachoResina">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Resolución de Dudas</span>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Preguntas Frecuentes</h1>
            <p class="text-slate-600 text-sm">Todo lo que necesitas saber sobre nuestros cuadros, envíos y encargos personalizados.</p>
        </div>

        <div class="space-y-6">
            @foreach($faqs as $faq)
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-900 text-base mb-2 flex items-center">
                        <i class="fa-solid fa-circle-question text-cyan-600 mr-2.5"></i>
                        {{ $faq->question }}
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed pl-7">{{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
