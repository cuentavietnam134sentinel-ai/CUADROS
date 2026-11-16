<x-admin-layout header="Gestión de Categorías">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
            <h3 class="font-bold text-slate-900 text-base mb-4">Nueva Categoría</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre</label>
                    <input type="text" name="name" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Imagen URL</label>
                    <input type="url" name="image" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                </div>
                <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm py-3 rounded-xl shadow transition">Crear Categoría</button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <th class="p-4">Categoría</th>
                        <th class="p-4">Slug</th>
                        <th class="p-4">Productos</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($categories as $category)
                        <tr>
                            <td class="p-4 font-bold text-slate-900">{{ $category->name }}</td>
                            <td class="p-4 text-slate-500 text-xs">{{ $category->slug }}</td>
                            <td class="p-4 font-semibold text-cyan-600">{{ $category->products_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
