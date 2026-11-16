<x-admin-layout header="Gestión de Pedidos">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                    <th class="p-4">Pedido ID</th>
                    <th class="p-4">Cliente</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($orders as $order)
                    <tr>
                        <td class="p-4 font-bold text-slate-900">#{{ $order->id }}</td>
                        <td class="p-4 text-slate-700">{{ $order->user->name ?? 'Usuario' }}</td>
                        <td class="p-4 font-extrabold text-slate-900">€{{ number_format($order->total, 2) }}</td>
                        <td class="p-4"><span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">{{ $order->status }}</span></td>
                        <td class="p-4 text-slate-400 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
