<x-admin-layout header="Moderación de Reseñas">
    <div class="space-y-4">
        @foreach($reviews as $review)
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                <div class="flex justify-between items-center text-xs border-b border-slate-100 pb-2">
                    <div>
                        <span class="font-bold text-slate-900 text-sm">{{ $review->user->name }}</span> sobre <span class="text-cyan-600 font-semibold">{{ $review->product->name }}</span>
                    </div>
                    <div class="flex text-amber-400">
                        @for($i = 0; $i < $review->rating; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                </div>
                <p class="text-xs text-slate-600 italic">"{{ $review->comment }}"</p>
            </div>
        @endforeach

        {{ $reviews->links() }}
    </div>
</x-admin-layout>
