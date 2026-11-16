<x-admin-layout header="Gestión de Solicitudes Personalizadas">
    <div class="space-y-6">
        @foreach($requests as $req)
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3 text-xs">
                    <div>
                        <span class="font-bold text-slate-900 text-sm">Solicitud #{{ $req->id }} • {{ $req->name }} ({{ $req->email }})</span>
                        <span class="text-slate-400 ml-2">{{ $req->created_at->format('d/m/Y') }}</span>
                    </div>
                    <span class="bg-amber-100 text-amber-800 font-bold px-3 py-1 rounded-full uppercase tracking-wider text-[10px]">{{ $req->status }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    <div><span class="text-slate-400 block uppercase font-medium">Medidas</span> <span class="font-semibold text-slate-800">{{ $req->dimensions }}</span></div>
                    <div><span class="text-slate-400 block uppercase font-medium">Paleta</span> <span class="font-semibold text-slate-800">{{ $req->color_palette }}</span></div>
                    <div><span class="text-slate-400 block uppercase font-medium">Acabado</span> <span class="font-semibold text-slate-800">{{ $req->finish }}</span></div>
                </div>

                <p class="text-xs text-slate-600 leading-relaxed"><strong class="text-slate-900">Descripción:</strong> {{ $req->description }}</p>

                <form action="{{ route('admin.custom_requests.update', $req) }}" method="POST" class="bg-slate-50 p-4 rounded-xl flex flex-col sm:flex-row gap-4 items-end">
                    @csrf
                    @method('PUT')
                    <div class="flex-1 w-full">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Estado</label>
                        <select name="status" class="w-full text-xs bg-white border border-slate-300 rounded-lg px-3 py-2">
                            <option value="received" {{ $req->status == 'received' ? 'selected' : '' }}>Recibida</option>
                            <option value="under_review" {{ $req->status == 'under_review' ? 'selected' : '' }}>En Revisión</option>
                            <option value="quoted" {{ $req->status == 'quoted' ? 'selected' : '' }}>Cotizada</option>
                            <option value="in_progress" {{ $req->status == 'in_progress' ? 'selected' : '' }}>En Elaboración</option>
                            <option value="finished" {{ $req->status == 'finished' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Precio Cotizado (€)</label>
                        <input type="number" step="0.01" name="quote_price" value="{{ $req->quote_price }}" class="w-full text-xs bg-white border border-slate-300 rounded-lg px-3 py-2">
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tiempo Estimado</label>
                        <input type="text" name="quote_making_time" value="{{ $req->quote_making_time }}" class="w-full text-xs bg-white border border-slate-300 rounded-lg px-3 py-2" placeholder="10-15 días">
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-xs py-2.5 px-6 rounded-lg shadow transition">Actualizar</button>
                </form>
            </div>
        @endforeach

        {{ $requests->links() }}
    </div>
</x-admin-layout>
