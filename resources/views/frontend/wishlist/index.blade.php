@extends('frontend.layouts.master')

@section('meta_title', 'Your Archive | Wishlist')

@section('content')

<!-- Minimalist Header -->
<div class="bg-white pt-24 pb-12">
    <div class="container mx-auto px-4 text-center">
        <span class="text-red-600 text-xs font-black uppercase tracking-widest mb-4 block">Personal Selection</span>
        <h1 class="text-4xl md:text-5xl font-black mb-8 tracking-tighter uppercase">Your Archive</h1>
        <div class="flex justify-center items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
            <span class="opacity-30">/</span>
            <span class="text-black italic">Wishlist</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 pb-24">
    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($wishlistItems as $item)
                <div class="relative group" id="wishlist-item-{{ $item->id }}">
                    @include('frontend.components.product-card', ['product' => $item->product])
                    
                    <!-- Remove Button -->
                    <button onclick="removeFromWishlist({{ $item->id }})" 
                            class="absolute top-4 right-4 z-30 w-10 h-10 bg-white border border-gray-100 text-gray-300 hover:text-red-600 hover:border-red-600 rounded-full flex items-center justify-center transition-all duration-300 shadow-xl shadow-black/5 opacity-0 group-hover:opacity-100">
                        <i class="fa fa-times text-xs"></i>
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-32 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-black/5">
                <i class="far fa-heart text-2xl text-gray-200"></i>
            </div>
            <h3 class="text-xl font-black uppercase tracking-tighter text-black mb-4">Your archive is empty</h3>
            <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest max-w-xs mx-auto leading-relaxed mb-10">
                Explore our curated collections and save your favorite pieces here for later.
            </p>
            <a href="{{ route('products') }}" class="inline-block bg-black text-white px-10 py-4 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition duration-500 shadow-xl shadow-black/10">
                Start Exploring
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function removeFromWishlist(id) {
        if(!confirm('Are you sure you want to remove this piece from your ARCHIVE?')) return;

        $.ajax({
            url: "{{ route('wishlist.remove') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#wishlist-item-' + id).fadeOut(500, function() {
                        $(this).remove();
                        if ($('.grid > div').length === 0) {
                            location.reload(); // Show empty state
                        }
                    });
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
</script>
@endpush
