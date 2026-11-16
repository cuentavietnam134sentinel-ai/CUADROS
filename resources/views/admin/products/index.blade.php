<x-admin-layout header="Gestión de Productos">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-slate-900">Catálogo de Obras</h3>
            <a href="{{ route('admin.products.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow transition">Nuevo Producto</a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <th class="p-4">Obra</th>
                        <th class="p-4">Categoría</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Tipo</th>
                        <th class="p-4">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $product)
                        <tr>
                            <td class="p-4 flex items-center space-x-3">
                                <img src="{{ asset($product->image) }}" class="w-12 h-12 rounded-lg object-cover">
                                <span class="font-bold text-slate-900">{{ $product->name }}</span>
                            </td>
                            <td class="p-4 text-slate-600">{{ $product->category->name }}</td>
                            <td class="p-4 font-bold text-slate-900">€{{ number_format($product->price, 2) }}</td>
                            <td class="p-4 text-slate-600 uppercase text-xs">{{ $product->type }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $product->status == 'available' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
