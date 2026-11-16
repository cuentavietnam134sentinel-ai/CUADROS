<x-app-layout title="Contacto — NachoResina">
    <div class="max-w-5xl mx-auto px-4 py-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs uppercase tracking-widest text-cyan-600 font-bold mb-2 block">Estamos para ayudarte</span>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Ponte en Contacto</h1>
            <p class="text-slate-600 text-sm">¿Tienes alguna pregunta sobre una obra, necesitas asesoramiento o quieres visitarnos en el estudio? Escríbenos.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 max-w-2xl mx-auto bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm p-4 rounded-xl text-center">
                <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="space-y-6 md:col-span-1">
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center"><i class="fa-solid fa-location-dot text-cyan-600 mr-2"></i> Estudio & Taller</h4>
                        <p class="text-xs text-slate-500">Calle del Arte 42, Valencia, España</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center"><i class="fa-solid fa-envelope text-cyan-600 mr-2"></i> Correo Electrónico</h4>
                        <p class="text-xs text-slate-500">hola@nachoresina.com</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1 flex items-center"><i class="fa-solid fa-phone text-cyan-600 mr-2"></i> Teléfono / WhatsApp</h4>
                        <p class="text-xs text-slate-500">+34 600 123 456</p>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-md border border-slate-200 aspect-video md:aspect-square">
                    <img src="{{ asset('img/pages/estudio.jpg') }}" alt="Nuestro estudio de arte" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm md:col-span-2">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre Completo</label>
                        <input type="text" name="name" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Tu Nombre">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Correo Electrónico</label>
                        <input type="email" name="email" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="tu@correo.com">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Asunto</label>
                        <input type="text" name="subject" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Consulta sobre obra / Envío">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Mensaje</label>
                        <textarea name="message" rows="5" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-cyan-500" placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-cyan-500/25 transition text-base">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
