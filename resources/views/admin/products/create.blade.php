<x-admin-layout header="Nuevo Producto">
    <div class="max-w-3xl bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
        @if($errors->any())
            <div class="mb-6 bg-red-50 text-red-800 p-4 rounded-xl text-xs">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre de la Obra</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Categoría</label>
                    <select name="category_id" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Precio (€)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Medidas</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3" placeholder="100x70 cm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tipo de Pieza</label>
                    <select name="type" class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                        <option value="unique">Pieza Única (1/1)</option>
                        <option value="limited_series">Serie Limitada</option>
                        <option value="made_to_order">Bajo Pedido</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Stock</label>
                    <input type="number" name="stock" value="1" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">URL de la Imagen (Unsplash u otro)</label>
                <input type="url" name="image" value="{{ old('image') }}" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3" placeholder="https://images.unsplash.com/...">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Descripción</label>
                <textarea name="description" rows="4" required class="w-full text-sm bg-slate-50 border border-slate-300 rounded-xl px-4 py-3"></textarea>
            </div>

            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow transition">
                Crear Producto
            </button>
        </form>
    </div>
</x-admin-layout>
