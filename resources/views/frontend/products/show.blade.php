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
                <div class="pdp-payment-icons" style="display:flex;gap:8px;font-size:1.2rem;color:var(--gray-300);">
                    <i class="fab fa-cc-visa"></i><i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i><i class="fab fa-cc-paypal"></i>
                </div>
            </div>

            <div style="margin-top:32px;padding-top:24px;border-top:1px solid var(--gray-100);">
                {{-- Trust Row --}}
                <div class="pdp-trust" style="display:flex;gap:24px;flex-wrap:wrap;">
                    <div class="pdp-trust-item" style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;background:var(--primary-soft);color:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;"><i class="fas fa-shield-halved"></i></div>
                        <div class="pdp-trust-text"><strong style="display:block;font-size:0.7rem;line-height:1;color:var(--gray-900);">Secure Payment</strong><span style="font-size:0.6rem;color:var(--gray-400);">SSL Encrypted</span></div>
                    </div>
                    <div class="pdp-trust-item" style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;background:var(--secondary-soft);color:var(--secondary);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;"><i class="fas fa-truck-fast"></i></div>
                        <div class="pdp-trust-text"><strong style="display:block;font-size:0.7rem;line-height:1;color:var(--gray-900);">Fast Delivery</strong><span style="font-size:0.6rem;color:var(--gray-400);">Same/Next day</span></div>
                    </div>
                    <div class="pdp-trust-item" style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;background:var(--success-soft);color:var(--success);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;"><i class="fas fa-rotate-left"></i></div>
                        <div class="pdp-trust-text"><strong style="display:block;font-size:0.7rem;line-height:1;color:var(--gray-900);">Easy Returns</strong><span style="font-size:0.6rem;color:var(--gray-400);">14-day policy</span></div>
                    </div>
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
                <span class="pdp-price-currency" style="font-size:clamp(1.5rem, 4vw, 2.4rem);font-weight:900;color:var(--gray-900);margin-right:8px;">₹</span>
                <span id="product-price" class="pdp-price" style="font-size:clamp(1.5rem, 4vw, 2.4rem);font-weight:900;color:var(--gray-900);">0.00</span>
                <span id="product-old-price" class="pdp-price-old" style="display:none;margin-left:8px;">₹0.00</span>
                <span id="discount-label" class="pdp-discount" style="display:none;">0% OFF</span>
            </div>
            @if($product->is_tax_included)
                <div class="pdp-tax-note"><i class="fas fa-info-circle" style="font-size:.65rem;"></i> Inclusive of all taxes</div>
            @else
                <div class="pdp-tax-note"><i class="fas fa-truck" style="font-size:.65rem;"></i> + Shipping calculated at checkout</div>
            @endif


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

                {{-- Action Buttons Row — Consolidated --}}
                <div class="pdp-actions-row" style="display:flex;gap:10px;align-items:center;margin-bottom:24px;flex-wrap:wrap;">
                    <div class="pdp-qty-control" style="flex-shrink:0;">
                        <button type="button" class="pdp-qty-btn" onclick="decrementQty()"><i class="fas fa-minus" style="font-size:.65rem;"></i></button>
                        <input type="text" id="quantity" name="quantity" value="1" readonly class="pdp-qty-display">
                        <button type="button" class="pdp-qty-btn" onclick="incrementQty()"><i class="fas fa-plus" style="font-size:.65rem;"></i></button>
                    </div>
                    
                    <button type="submit" id="add-to-cart-btn" class="pdp-atc-btn" style="flex:1.2;height:52px;margin:0;">
                        <i class="fas fa-cart-shopping"></i><span>Add to Cart</span>
                    </button>
                    
                    <button type="button" onclick="buyNow()" class="pdp-buy-btn" style="flex:1;height:52px;margin:0;display:flex;align-items:center;justify-content:center;gap:8px;font-size:0.8rem;font-weight:800;text-transform:uppercase;border-radius:var(--radius-xl);background:var(--secondary);color:white;border:none;box-shadow:var(--shadow-secondary);transition:all 0.3s;">
                        <i class="fas fa-bolt"></i><span>Buy Now</span>
                    </button>
                    
                    <button type="button" onclick="addToWishlist({{ $product->id }})" class="pdp-wishlist-btn wishlist-btn-{{ $product->id }}" style="width:52px;height:52px;flex-shrink:0;margin:0;">
                        <i class="far fa-heart" style="font-size:1rem;"></i>
                    </button>
                </div>
            </form>

            {{-- Avail + SKU footer --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 0;border-top:1px solid var(--gray-100);margin-top:10px;">
                <div>
                    <div style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.16em;color:var(--gray-400);margin-bottom:5px;">Availability</div>
                    <div style="font-size:.76rem;font-weight:700;color:var(--success);display:flex;align-items:center;gap:6px;"><i class="fas fa-circle-check" style="font-size:.7rem;"></i> In Stock</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.16em;color:var(--gray-400);margin-bottom:5px;">SKU</div>
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
.pdp-main-grid { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; }
.pdp-info { display:flex; flex-direction:column; gap:0; }
.pdp-category { margin-bottom:4px; font-size:0.7rem; font-weight:800; color:var(--teal-primary); text-transform:uppercase; letter-spacing:0.1em; }
.pdp-title { margin-bottom:12px; font-size:clamp(1.5rem, 4vw, 2.4rem); font-weight:900; color:var(--gray-900); line-height:1.2; letter-spacing:-0.02em; }
.pdp-rating { margin-bottom:20px; display:flex; align-items:center; gap:12px; }
.pdp-price-row { margin-bottom:8px; display:flex; align-items:baseline; }
.pdp-tax-note { margin-bottom:18px; font-size:0.7rem; font-weight:600; color:var(--gray-400); }
.pdp-meta-row { margin-bottom:20px; padding:12px 0; border-top:1px solid var(--gray-50); border-bottom:1px solid var(--gray-50); display:flex; gap:24px; }
.pdp-desc { margin-bottom:24px; font-size:0.9rem; color:var(--gray-600); line-height:1.6; }
.pdp-desc p { margin-bottom:8px; }
.pdp-attr-group { margin-bottom:18px; }
.pdp-attr-label { margin-bottom:10px; font-size:0.65rem; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; color:var(--gray-400); }

/* Action buttons single line */
.pdp-actions-row { display:flex; gap:10px; align-items:center; margin-bottom:24px; }
.pdp-atc-btn { height:52px; background:var(--grad-primary); color:white; border-radius:var(--radius-xl); font-size:0.8rem; font-weight:800; border:none; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:var(--shadow-primary); transition:all 0.3s; }
.pdp-atc-btn:hover { transform:translateY(-2px); filter:brightness(1.1); box-shadow:0 12px 24px rgba(var(--primary-rgb),0.3); }
.pdp-buy-btn:hover { transform:translateY(-2px); filter:brightness(1.1); box-shadow:0 12px 24px rgba(var(--secondary-rgb),0.3); }

@media(max-width:1024px){ .pdp-main-grid{ grid-template-columns:1fr!important; gap:28px!important; } }
@media(max-width:768px){ 
    .pdp-thumbs{ flex-direction:row!important; width:100%!important; overflow-x:auto; } 
    .pdp-thumb{ width:64px!important; height:64px!important; flex-shrink:0; }
    .pdp-actions-row { flex-wrap:wrap; }
    .pdp-atc-btn, .pdp-buy-btn { width:100% !important; flex:none !important; }
}
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
        priceEl.innerText=parseFloat(match.final_price||match.price).toFixed(2);
        if(match.discount>0){
            oldPriceEl.innerText='₹' + parseFloat(match.price).toFixed(2); oldPriceEl.style.display='inline';
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
