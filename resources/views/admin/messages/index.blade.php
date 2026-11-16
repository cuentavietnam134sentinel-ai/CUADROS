<x-admin-layout header="Mensajes de Contacto">
    <div class="space-y-4">
        @foreach($messages as $msg)
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                <div class="flex justify-between items-center text-xs border-b border-slate-100 pb-2">
                    <span class="font-bold text-slate-900 text-sm">{{ $msg->name }} (<a href="mailto:{{ $msg->email }}" class="text-cyan-600 hover:underline">{{ $msg->email }}</a>)</span>
                    <span class="text-slate-400">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <h4 class="font-semibold text-slate-800 text-xs uppercase tracking-wider">{{ $msg->subject ?? 'Sin asunto' }}</h4>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $msg->message }}</p>
            </div>
        @endforeach

        {{ $messages->links() }}
    </div>
</x-admin-layout>
