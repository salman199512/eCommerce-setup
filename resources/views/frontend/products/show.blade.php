@extends('frontend.layouts.master')

@section('meta_title', $product->meta_title ?? $product->title)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)

@section('content')

{{-- Breadcrumb --}}
<div style="background:#fff;border-bottom:1px solid var(--border-color);padding:12px 0;">
    <div class="container">
        <nav class="shop-breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-house" style="font-size:0.6rem;"></i> Home</a>
            <span class="separator"><i class="fas fa-chevron-right" style="font-size:0.5rem;"></i></span>
            <a href="{{ route('products') }}">Shop</a>
            <span class="separator"><i class="fas fa-chevron-right" style="font-size:0.5rem;"></i></span>
            <a href="{{ route('products', ['category' => $product->category->slug]) }}">{{ $product->category->title }}</a>
            <span class="separator"><i class="fas fa-chevron-right" style="font-size:0.5rem;"></i></span>
            <span class="current">{{ Str::limit($product->title, 40) }}</span>
        </nav>
    </div>
</div>

{{-- Main Product --}}
<div class="container product-detail-wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;" class="pdp-main-grid">

        {{-- LEFT: Gallery --}}
        <div class="anim-fade-left">
            <div class="pdp-gallery">

                {{-- Thumbnails --}}
                <div class="pdp-thumbs" id="pdp-thumbs">
                    @foreach($product->media as $index => $media)
                    <button class="pdp-thumb {{ $index === 0 ? 'active' : '' }}" onclick="changeImage('{{ $media->getUrl() }}', this)" style="padding:0;">
                        <img src="{{ $media->getUrl() }}" alt="{{ $product->title }}">
                    </button>
                    @endforeach
                </div>

                {{-- Main Image --}}
                <div class="pdp-main-img">
                    <img id="main-product-image" src="{{ $product->avatar_url }}" alt="{{ $product->title }}" style="transition:opacity .2s ease;">
                    <div class="pdp-badges">
                        @if($product->is_new_arrival)
                            <span class="badge badge-primary"><i class="fas fa-sparkles" style="font-size:.55rem;"></i> New</span>
                        @endif
                        <span id="discount-badge" class="badge badge-danger" style="display:none;">-0%</span>
                    </div>
                    <div style="position:absolute;bottom:12px;right:12px;background:rgba(0,0,0,.45);color:rgba(255,255,255,.9);font-size:0.6rem;font-weight:600;padding:5px 10px;border-radius:var(--radius-full);backdrop-filter:blur(6px);pointer-events:none;">
                        <i class="fas fa-magnifying-glass-plus" style="margin-right:4px;"></i> Hover to zoom
                    </div>
                </div>
            </div>

            {{-- Share + Payment --}}
            <div class="pdp-payment-row" style="margin-top:18px;">
                <div class="pdp-share">
                    <span class="pdp-share-label">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($product->title.' '.request()->url()) }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->url()) }}" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                </div>
                <div class="pdp-payment-icons">
                    <i class="fab fa-cc-visa"></i><i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i><i class="fab fa-cc-paypal"></i>
                </div>
            </div>
        </div>

        {{-- RIGHT: Product Info --}}
        <div class="pdp-info anim-fade-right">

            <div class="pdp-category">{{ $product->category->title }}</div>
            <h1 class="pdp-title">{{ $product->title }}</h1>

            {{-- Rating --}}
            <div class="pdp-rating">
                <div class="pdp-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    <i class="fas fa-star"></i><i class="fas fa-star-half-stroke"></i>
                </div>
                <span class="pdp-rating-count">4.8 / 5</span>
                <span style="color:var(--gray-200);">|</span>
                <a href="#reviews-panel" class="pdp-rating-link">Write a Review</a>
            </div>

            {{-- Price --}}
            <div class="pdp-price-row">
                <span id="product-price" class="pdp-price">$0.00</span>
                <span id="product-old-price" class="pdp-price-old" style="display:none;">$0.00</span>
                <span id="discount-label" class="pdp-discount" style="display:none;">0% OFF</span>
            </div>
            @if($product->is_tax_included)
                <div class="pdp-tax-note"><i class="fas fa-info-circle" style="font-size:.65rem;"></i> Inclusive of all taxes</div>
            @else
                <div class="pdp-tax-note"><i class="fas fa-truck" style="font-size:.65rem;"></i> + Shipping calculated at checkout</div>
            @endif

            {{-- Stock + SKU --}}
            <div class="pdp-meta-row">
                <div class="pdp-stock"><span class="pdp-stock-dot"></span> In Stock &amp; Ready to Ship</div>
                <div class="pdp-sku">SKU: <strong id="product-sku">{{ strtoupper(substr($product->title,0,3)) }}-001</strong></div>
            </div>

            {{-- Short Description --}}
            <div class="pdp-desc">
                <p>{{ Str::limit(strip_tags($product->description), 200) }}</p>
                <a href="#description-panel">Read full description ↓</a>
            </div>

            {{-- Form --}}
            <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected-variant-id">

                @php $groupedAttributes = $product->attributes->groupBy('attribute_group_id'); @endphp
                @if($groupedAttributes->isNotEmpty())
                    @foreach($groupedAttributes as $groupId => $attributes)
                        @php $groupLabel = \App\Models\AttributeGroup::find($groupId)->title ?? 'Select Option'; @endphp
                        <div class="pdp-attr-group">
                            <div class="pdp-attr-label">
                                {{ $groupLabel }}:
                                <span id="selected-attr-{{ $groupId }}" style="color:var(--gray-900);font-weight:700;margin-left:4px;text-transform:none;letter-spacing:0;"></span>
                            </div>
                            <div class="pdp-attr-options">
                                @foreach($attributes->unique('id') as $attr)
                                <div class="pdp-attr-option">
                                    <input type="radio" name="attribute[{{ $groupId }}]" value="{{ $attr->id }}"
                                           id="attr-{{ $groupId }}-{{ $attr->id }}"
                                           class="sr-only attribute-selector"
                                           data-group="{{ $groupId }}" data-label="{{ $attr->title }}"
                                           {{ $product->variants->first()->attributes->contains($attr->id) ? 'checked' : '' }} required>
                                    <label for="attr-{{ $groupId }}-{{ $attr->id }}">{{ $attr->title }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- ATC Row --}}
                <div class="pdp-atc-row">
                    <div class="pdp-qty-control">
                        <button type="button" class="pdp-qty-btn" onclick="decrementQty()"><i class="fas fa-minus" style="font-size:.65rem;"></i></button>
                        <input type="text" id="quantity" name="quantity" value="1" readonly class="pdp-qty-display">
                        <button type="button" class="pdp-qty-btn" onclick="incrementQty()"><i class="fas fa-plus" style="font-size:.65rem;"></i></button>
                    </div>
                    <button type="submit" id="add-to-cart-btn" class="pdp-atc-btn">
                        <i class="fas fa-cart-plus"></i><span>Add to Cart</span>
                    </button>
                    <button type="button" onclick="addToWishlist({{ $product->id }})" class="pdp-wishlist-btn wishlist-btn-{{ $product->id }}" title="Wishlist">
                        <i class="far fa-heart" style="font-size:1rem;"></i>
                    </button>
                </div>

                <button type="button" onclick="buyNow()" class="pdp-buy-btn" style="width:100%;margin-bottom:20px;">
                    <i class="fas fa-bolt"></i> Buy Now — Instant Checkout
                </button>
            </form>

            {{-- Trust Row --}}
            <div class="pdp-trust">
                <div class="pdp-trust-item">
                    <i class="fas fa-shield-halved"></i>
                    <div class="pdp-trust-text"><strong>Secure Payment</strong>SSL Encrypted</div>
                </div>
                <div class="pdp-trust-item">
                    <i class="fas fa-truck-fast"></i>
                    <div class="pdp-trust-text"><strong>Fast Delivery</strong>Same/Next day</div>
                </div>
                <div class="pdp-trust-item">
                    <i class="fas fa-rotate-left"></i>
                    <div class="pdp-trust-text"><strong>Easy Returns</strong>14-day policy</div>
                </div>
            </div>

            {{-- Avail + SKU footer --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:14px 0;border-top:1px solid var(--gray-100);">
                <div>
                    <div style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.16em;color:var(--gray-300);margin-bottom:5px;">Availability</div>
                    <div style="font-size:.76rem;font-weight:700;color:var(--success);display:flex;align-items:center;gap:6px;"><i class="fas fa-circle-check" style="font-size:.7rem;"></i> In Stock</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.16em;color:var(--gray-300);margin-bottom:5px;">SKU</div>
                    <div id="product-sku-display" style="font-size:.76rem;font-weight:700;color:var(--gray-700);">—</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Accordion --}}
    <div class="pdp-accordion" id="details-tabs">

        <div class="pdp-accordion-item open" id="description-panel">
            <button class="pdp-accordion-btn" onclick="toggleAccordion(this)">
                <div style="text-align:left;">
                    <span class="pdp-accordion-label-top" style="color:var(--primary);">The Details</span>
                    <div class="pdp-accordion-label-title">Product Description</div>
                </div>
                <div class="pdp-accordion-icon"><i class="fas fa-chevron-down"></i></div>
            </button>
            <div class="pdp-accordion-body">
                <div style="max-width:860px;" class="prose max-w-none leading-relaxed">{!! $product->description !!}</div>
            </div>
        </div>

        <div class="pdp-accordion-item" id="logistics-panel">
            <button class="pdp-accordion-btn" onclick="toggleAccordion(this)">
                <div style="text-align:left;">
                    <span class="pdp-accordion-label-top" style="color:var(--secondary);">Delivery &amp; Care</span>
                    <div class="pdp-accordion-label-title">Shipping &amp; Returns</div>
                </div>
                <div class="pdp-accordion-icon"><i class="fas fa-chevron-down"></i></div>
            </button>
            <div class="pdp-accordion-body">
                @if($product->logistics_care)
                    <div class="prose max-w-none leading-relaxed">{!! $product->logistics_care !!}</div>
                @else
                    <div class="logistics-grid">
                        <div class="logistics-card">
                            <div class="logistics-card-icon"><i class="fas fa-truck-fast"></i></div>
                            <h5>Fast Delivery</h5>
                            <p>3–5 business days standard. Express 1–2 day at checkout.</p>
                        </div>
                        <div class="logistics-card">
                            <div class="logistics-card-icon" style="background:var(--secondary);"><i class="fas fa-box-open"></i></div>
                            <h5>Premium Packaging</h5>
                            <p>Every order carefully packed in branded protective packaging.</p>
                        </div>
                        <div class="logistics-card">
                            <div class="logistics-card-icon" style="background:var(--success);"><i class="fas fa-rotate-left"></i></div>
                            <h5>Easy Returns</h5>
                            <p>Return within 14 days for a full refund. No questions asked.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="pdp-accordion-item" id="reviews-panel">
            <button class="pdp-accordion-btn" onclick="toggleAccordion(this)">
                <div style="text-align:left;">
                    <span class="pdp-accordion-label-top" style="color:var(--warning);"><i class="fas fa-star" style="font-size:.6rem;"></i> Customer Voices</span>
                    <div class="pdp-accordion-label-title">Reviews &amp; Ratings</div>
                </div>
                <div class="pdp-accordion-icon"><i class="fas fa-chevron-down"></i></div>
            </button>
            <div class="pdp-accordion-body">
                <div style="background:var(--gray-50);padding:40px;border-radius:var(--radius-xl);border:1px solid var(--border-color);text-align:center;max-width:460px;margin:0 auto;">
                    <div style="width:58px;height:58px;background:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:var(--shadow-md);">
                        <i class="fas fa-star" style="font-size:1.4rem;color:var(--gray-200);"></i>
                    </div>
                    <div style="font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.14em;color:var(--gray-400);margin-bottom:10px;">Be the first to share your experience</div>
                    <h4 style="font-size:1.1rem;font-weight:800;color:var(--gray-900);margin-bottom:20px;">Write a Review</h4>
                    <button class="btn btn-primary"><i class="fas fa-pen"></i> Write a Review</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    <div style="margin-top:60px;padding-top:44px;border-top:1px solid var(--border-color);">
        <div class="section-head">
            <div>
                <div class="section-eyebrow">You May Also Like</div>
                <h2 class="section-title">Related Products</h2>
            </div>
            <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="btn btn-outline btn-sm">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="related-products-grid">
            @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
                @foreach($relatedProducts as $related)
                    @include('frontend.components.product-card', ['product' => $related])
                @endforeach
            @else
                @php $fallbackProducts = \App\Models\Product::where('id','!=',$product->id)->active()->take(4)->get(); @endphp
                @foreach($fallbackProducts as $related)
                    @include('frontend.components.product-card', ['product' => $related])
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.pdp-main-grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
@media(max-width:1024px){ .pdp-main-grid{ grid-template-columns:1fr!important; gap:28px!important; } }
@media(max-width:768px){ .pdp-thumbs{ flex-direction:row!important; width:100%!important; overflow-x:auto; } .pdp-thumb{ width:64px!important; height:64px!important; flex-shrink:0; } }
</style>
@endpush

@push('scripts')
<script>
const variants = {!! json_encode($product->variants->map(function($v) {
    return ['id'=>$v->id,'price'=>$v->price,'discount'=>$v->discount,'final_price'=>$v->final_price,'sku'=>$v->sku,
        'attributes'=>$v->attributes->map(function($a){ return ['group_id'=>$a->pivot->attribute_group_id,'attribute_id'=>$a->id]; })];
})) !!};

const attributeSelectors = document.querySelectorAll('.attribute-selector');
const addToCartBtn = document.getElementById('add-to-cart-btn');
const priceEl       = document.getElementById('product-price');
const oldPriceEl    = document.getElementById('product-old-price');
const discountLabel = document.getElementById('discount-label');
const discountBadge = document.getElementById('discount-badge');
const variantInput  = document.getElementById('selected-variant-id');
const skuDisplay    = document.getElementById('product-sku-display');

window.changeImage = function(url, btn) {
    const img = document.getElementById('main-product-image');
    img.style.opacity = '0';
    setTimeout(()=>{ img.src=url; img.style.opacity='1'; }, 180);
    document.querySelectorAll('.pdp-thumb').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
};
window.incrementQty = function(){ let e=document.getElementById('quantity'); e.value=parseInt(e.value)+1; };
window.decrementQty = function(){ let e=document.getElementById('quantity'); if(parseInt(e.value)>1) e.value=parseInt(e.value)-1; };

attributeSelectors.forEach(radio=>{
    radio.addEventListener('change', function(){
        const el=document.getElementById('selected-attr-'+this.dataset.group);
        if(el) el.textContent=this.dataset.label;
        checkVariantMatch();
    });
    if(radio.checked){ const el=document.getElementById('selected-attr-'+radio.dataset.group); if(el) el.textContent=radio.dataset.label; }
});

function checkVariantMatch() {
    const selected={};let allSelected=true;
    const groups=[...new Set([...attributeSelectors].map(el=>el.dataset.group))];
    groups.forEach(gId=>{ const c=document.querySelector(`input[name="attribute[${gId}]"]:checked`); if(c) selected[gId]=parseInt(c.value); else allSelected=false; });
    if(!allSelected){ addToCartBtn.disabled=true; addToCartBtn.querySelector('span').innerText='Select Options'; return; }
    const match=variants.find(v=>Object.keys(selected).every(gId=>v.attributes.some(a=>a.group_id==gId&&a.attribute_id==selected[gId])));
    if(match){
        priceEl.innerText='$'+parseFloat(match.final_price||match.price).toFixed(2);
        if(match.discount>0){
            oldPriceEl.innerText='$'+parseFloat(match.price).toFixed(2); oldPriceEl.style.display='inline';
            discountBadge.innerText='-'+parseInt(match.discount)+'%'; discountBadge.style.display='inline-flex';
            discountLabel.innerText=parseInt(match.discount)+'% OFF'; discountLabel.style.display='inline-flex';
        } else { oldPriceEl.style.display='none'; discountBadge.style.display='none'; discountLabel.style.display='none'; }
        if(skuDisplay) skuDisplay.innerText=match.sku||'—';
        variantInput.value=match.id; addToCartBtn.disabled=false; addToCartBtn.querySelector('span').innerText='Add to Cart';
    } else { addToCartBtn.disabled=true; addToCartBtn.querySelector('span').innerText='Unavailable'; priceEl.innerText='—'; }
}

$('#add-to-cart-form').on('submit',function(e){
    e.preventDefault();
    const variantId=$('#selected-variant-id').val(), qty=$('#quantity').val();
    if(!variantId){ toastr.warning('Please select all options.'); return; }
    $.ajax({ url:"{{ route('cart.add') }}", type:"POST", data:{variant_id:variantId,quantity:qty,_token:"{{ csrf_token() }}"},
        success:function(r){ if(r.success){ toastr.success(r.message); $('.cart-count-global').text(r.totalQty); $('.cart-items-count').text(r.cartCount); } } });
});

window.buyNow=function(){
    const variantId=document.getElementById('selected-variant-id').value;
    if(!variantId){ toastr.warning('Please select all options first.'); return; }
    document.getElementById('add-to-cart-form').dispatchEvent(new Event('submit',{bubbles:true}));
    setTimeout(()=>{ window.location.href="{{ route('checkout') }}"; },800);
};

window.addToWishlist=function(id){
    @guest toastr.info('Please login to add items to your wishlist.'); return; @endguest
    $.ajax({ url:"{{ route('wishlist.add') }}", type:"POST", data:{product_id:id,_token:"{{ csrf_token() }}"},
        success:function(r){ if(r.success){ toastr.success(r.message); $('.wishlist-btn-'+id+' i').removeClass('far').addClass('fas').css('color','var(--danger)'); $('.wishlist-btn-'+id).css({color:'var(--danger)',borderColor:'var(--danger)',background:'var(--danger-soft)'}); } else { toastr.warning(r.message); } } });
};

window.toggleAccordion=function(btn){
    const item=btn.closest('.pdp-accordion-item');
    item.classList.toggle('open');
};

checkVariantMatch();
</script>
@endpush
