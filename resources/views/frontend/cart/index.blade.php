@extends('frontend.layouts.master')

@section('meta_title', 'Shopping Archive | Your Bag')

@section('content')

<!-- Minimalist Header -->
<div class="bg-gray-100 py-10 mb-12">
    <div class="container mx-auto px-4 text-center">
        <span class="text-red-600 text-xs font-black uppercase tracking-widest mb-4 block">Selection</span>
        <h1 class="text-4xl md:text-5xl font-black mb-8 tracking-tighter uppercase">Shopping Bag</h1>
        <div class="flex justify-center items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
            <span class="opacity-30">/</span>
            <span class="text-black italic">Bag</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-20">
    @if(count($cartItems) > 0)
    <div class="flex flex-col lg:flex-row gap-20 items-start">
        <!-- Cart Items -->
        <div class="w-full lg:flex-1">
            <div class="overflow-hidden">
                <table class="w-full text-left border-separate border-spacing-y-6">
                    <thead>
                        <tr class="text-[10px] uppercase font-black tracking-widest text-gray-400">
                            <th class="pb-4 pl-4">Product</th>
                            <th class="pb-4">Price</th>
                            <th class="pb-4 text-center">Quantity</th>
                            <th class="pb-4 text-right pr-4">Running Total</th>
                            <th class="pb-4"></th>
                        </tr>
                    </thead>
                    <tbody id="cart-items-body">
                        @foreach($cartItems as $id => $details)
                        <tr class="group bg-white border border-gray-100 shadow-sm rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-black/5" id="cart-row-{{ $id }}">
                            <td class="py-10 pl-8 w-1/2">
                                <div class="flex items-center gap-8">
                                    <div class="w-24 h-32 flex-shrink-0 bg-gray-50 rounded-2xl overflow-hidden relative border border-gray-100">
                                        <img src="{{ $details['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-sm font-black text-black uppercase tracking-normal mb-2">{{ $details['name'] }}</h3>
                                        @if(isset($details['attributes']))
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $details['attributes'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-10">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Price</span>
                                    <span class="text-xs font-black text-black uppercase tracking-widest">${{ number_format($details['price'], 2) }}</span>
                                </div>
                            </td>
                            <td class="py-10 text-center px-4">
                                <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest block mb-3">Quantity</span>
                                <div class="inline-flex items-center p-1 bg-gray-50 border border-gray-100 rounded-full shadow-inner">
                                    <button onclick="updateQty('{{ $id }}', -1)" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-black hover:bg-white hover:shadow-sm rounded-full transition-all font-black text-lg">&minus;</button>
                                    <input type="text" value="{{ $details['quantity'] }}" readonly id="qty-{{ $id }}" style="padding: 12px 5px !important;"
                                           class="w-12 text-center bg-transparent border-none text-base font-black focus:ring-0 text-black px-0 mx-2">
                                    <button onclick="updateQty('{{ $id }}', 1)" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-black hover:bg-white hover:shadow-sm rounded-full transition-all font-black text-lg">&plus;</button>
                                </div>
                            </td>
                            <td class="py-10 text-right pr-8">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Total</span>
                                    <span class="text-lg font-black tracking-tighter text-black running-total" id="total-{{ $id }}">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-10 pr-8">
                                <button onclick="removeItem('{{ $id }}')" class="w-10 h-10 bg-white border border-gray-100 text-gray-400 hover:text-red-600 hover:border-red-600 rounded-full flex items-center justify-center transition-all duration-300 shadow-xl shadow-black/5" title="Remove Item">
                                    <i class="fa fa-times text-xs"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-12">
                <a href="{{ route('products') }}" class="group inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-black hover:text-red-600 transition">
                    <i class="fa fa-arrow-left transition group-hover:-translate-x-1"></i> Continue Shopping
                </a>
            </div>
        </div>

        <!-- Summary -->
        <div class="w-full lg:w-96 sticky top-32">
            <div class="bg-gray-50 p-10 rounded-[2.5rem] border border-gray-100">
                <h3 class="text-sm font-black uppercase tracking-widest text-black mb-10 border-b border-gray-200 pb-6">Order Summary</h3>

                <div class="space-y-6 mb-10">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Subtotal</span>
                        <span class="text-xs font-black text-black cart-total">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Shipping</span>
                        <span class="text-[10px] font-black text-green-600 uppercase tracking-widest">Free</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-8 border-t border-gray-200 mb-12">
                    <span class="text-xs font-black uppercase tracking-widest text-black">Total</span>
                    <span class="text-2xl font-black tracking-tighter text-black cart-total">${{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-center py-5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition duration-500 shadow-xl shadow-black/10">
                    Proceed to Checkout
                </a>

                <div class="mt-8 flex items-center justify-center gap-6 opacity-30 grayscale">
                    <i class="fab fa-cc-visa text-xl"></i>
                    <i class="fab fa-cc-mastercard text-xl"></i>
                    <i class="fab fa-cc-paypal text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-32 text-center bg-gray-50 rounded-[3rem] border border-dashed border-gray-200">
        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-black/5">
            <i class="fas fa-shopping-bag text-2xl text-gray-200"></i>
        </div>
        <h3 class="text-xl font-black uppercase tracking-tighter text-black mb-4">Your bag is empty</h3>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest max-w-xs mx-auto leading-relaxed mb-10">
            It looks like you haven't added any pieces to your collection yet.
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
    function updateQty(id, delta) {
        let el = document.getElementById('qty-' + id);
        let newQty = parseInt(el.value) + delta;
        if (newQty < 1) return;

        // Visual feedback
        el.value = newQty;
        $('#cart-row-' + id).css('opacity', '0.6');

        $.ajax({
            url: "{{ route('update.cart') }}",
            type: "PATCH",
            data: {
                id: id,
                quantity: newQty,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    $('#total-' + id).text('$' + response.runningTotal);
                    $('.cart-total').text('$' + response.total);
                    $('.cart-count-global').text(response.totalQty);
                    $('.cart-items-count').text(response.cartCount);
                    $('#cart-row-' + id).css('opacity', '1');
                }
            },
            error: function() {
                location.reload();
            }
        });
    }

    function removeItem(id) {
        if(!confirm('Remove this piece from your collection?')) return;

        $('#cart-row-' + id).fadeOut(500, function() {
            $.ajax({
                url: "{{ route('remove.from.cart') }}",
                type: "DELETE",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('.cart-total').text('$' + response.total);
                        $('.cart-count-global').text(response.totalQty);
                        $('.cart-items-count').text(response.cartCount);
                        if (response.cartCount === 0) {
                            location.reload();
                        }
                    }
                }
            });
        });
    }
</script>
@endpush
