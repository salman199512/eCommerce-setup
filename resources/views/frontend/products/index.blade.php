@extends('frontend.layouts.master')

@section('meta_title', 'Shop Fresh Groceries | FreshMart')

@section('content')

<!-- Shop Header -->
<div class="shop-header">
    <div class="container">
        <div class="shop-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span><i class="fas fa-chevron-right" style="font-size:.55rem;"></i></span>
            <a href="{{ route('products') }}">Shop</a>
            @if(request('category'))
            <span><i class="fas fa-chevron-right" style="font-size:.55rem;"></i></span>
            <span>{{ request('category') }}</span>
            @endif
        </div>
        <h1 style="font-size:clamp(1.5rem,3vw,2.2rem);font-weight:900;color:var(--gray-900);margin-bottom:8px;">
            Fresh Groceries
            @if(request('search'))
            <span style="color:var(--primary);">&ndash; "{{ request('search') }}"</span>
            @endif
        </h1>
        <p style="color:var(--gray-500);font-size:.85rem;font-weight:500;">
            {{ $products->total() }} products found
            @if(request('category')) in <strong style="color:var(--primary);">{{ request('category') }}</strong>@endif
        </p>
    </div>
</div>

<div class="container" style="padding-top:32px;padding-bottom:64px;">
    <div style="display:flex;gap:28px;align-items:flex-start;">

        <!-- ── Filter Sidebar ── -->
        <aside style="width:260px;flex-shrink:0;display:block;" id="filter-sidebar">
            <form action="{{ route('products') }}" method="GET" id="filter-form">
                <input type="hidden" name="sort" id="sort-input" value="{{ request('sort', 'latest') }}">
                <input type="hidden" name="view" value="{{ request('view', 'grid') }}">

                <!-- Active Filters -->
                @if(request()->anyFilled(['category','sub_category','attributes','min_price','max_price','search']))
                <div style="background:var(--secondary-soft);border:1px solid var(--secondary-light);border-radius:var(--radius-md);padding:12px 16px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:.72rem;font-weight:800;color:var(--secondary);text-transform:uppercase;letter-spacing:.08em;">Filters Active</span>
                    <a href="{{ route('products') }}" style="font-size:.68rem;font-weight:800;color:var(--secondary);text-transform:uppercase;letter-spacing:.06em;text-decoration:underline;">Clear All</a>
                </div>
                @endif

                <!-- Categories -->
                <div class="filter-block" style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);padding:20px;margin-bottom:16px;">
                    <div class="filter-title"><i class="fas fa-th-large"></i> Categories</div>
                    @foreach($categories as $cat)
                    <div>
                        <div class="cat-filter-item {{ request('category') == $cat->slug ? 'active' : '' }}"
                             onclick="window.location='{{ route('products', ['category' => $cat->slug]) }}'">
                            <span class="cat-filter-name">{{ $cat->title }}</span>
                            <span class="cat-filter-count">{{ $cat->subCategories->count() }}</span>
                        </div>
                        @if(request('category') == $cat->slug && $cat->subCategories->isNotEmpty())
                        <div style="margin-left:12px;margin-bottom:8px;">
                            @foreach($cat->subCategories as $sub)
                            <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}"
                               style="display:flex;align-items:center;gap:6px;padding:6px 10px;font-size:.75rem;font-weight:600;color:{{ request('sub_category') == $sub->slug ? 'var(--primary)' : 'var(--gray-500)' }};border-radius:var(--radius-sm);transition:all .15s;"
                               onmouseover="this.style.background='var(--primary-soft)'" onmouseout="this.style.background=''">
                                <i class="fas fa-circle" style="font-size:.3rem;color:var(--primary);opacity:{{ request('sub_category') == $sub->slug ? '1' : '.4' }};"></i>
                                {{ $sub->title }}
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                <!-- Attributes -->
                @foreach($attributeGroups as $group)
                <div class="filter-block" style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);padding:20px;margin-bottom:16px;">
                    <div class="filter-title"><i class="fas fa-sliders"></i> {{ $group->title }}</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach($group->attributes as $attr)
                        <label class="fm-checkbox-wrap" style="width:calc(50% - 4px);">
                            <input type="checkbox" class="fm-checkbox" name="attributes[]" value="{{ $attr->id }}"
                                   {{ is_array(request('attributes')) && in_array($attr->id, request('attributes')) ? 'checked' : '' }}
                                   onchange="document.getElementById('filter-form').submit()">
                            <span style="font-size:.75rem;font-weight:600;color:var(--gray-600);">{{ $attr->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <!-- Price Range -->
                <div class="filter-block" style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);padding:20px;margin-bottom:16px;">
                    <div class="filter-title"><i class="fas fa-tag"></i> Price Range</div>
                    <div class="price-range-inputs">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min ₹"
                               class="fm-input" style="padding:8px 12px;font-size:.78rem;">
                        <span class="price-separator">—</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max ₹"
                               class="fm-input" style="padding:8px 12px;font-size:.78rem;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;margin-top:12px;justify-content:center;">
                        <i class="fas fa-filter"></i> Apply Filter
                    </button>
                </div>
            </form>
        </aside>

        <!-- ── Main Content ── -->
        <main style="flex:1;min-width:0;">
            <!-- Sort Bar -->
            <div class="sort-bar">
                <div class="sort-bar-left">
                    <p class="results-count">
                        Showing <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> results
                    </p>
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <div class="view-toggles">
                        <button onclick="setView('grid')" class="view-toggle-btn {{ !request('view') || request('view') == 'grid' ? 'active' : '' }}" title="Grid View">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button onclick="setView('list')" class="view-toggle-btn {{ request('view') == 'list' ? 'active' : '' }}" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                    <div style="height:24px;width:1px;background:var(--gray-200);margin:0 4px;"></div>
                    <span style="font-size:.72rem;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:.06em;">Sort:</span>
                    <select class="sort-select fm-select" onchange="updateSort(this.value)">
                        <option value="latest"     {{ request('sort') == 'latest'     ? 'selected' : '' }}>Newest First</option>
                        <option value="price_low"  {{ request('sort') == 'price_low'  ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular"    {{ request('sort') == 'popular'    ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div id="product-container"
                 style="display:{{ request('view') == 'list' ? 'flex' : 'grid' }};
                        {{ request('view') == 'list' ? 'flex-direction:column;gap:16px;' : 'grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;' }}">
                @forelse($products as $product)
                    @if(request('view') == 'list')
                        <div style="display:flex;gap:20px;background:white;border:1px solid var(--border-light);border-radius:var(--radius-xl);padding:20px;box-shadow:var(--shadow-sm);transition:box-shadow .25s;"
                             onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">
                            <div style="width:130px;height:130px;border-radius:var(--radius-lg);overflow:hidden;flex-shrink:0;background:var(--gray-100);">
                                <img src="{{ $product->avatar_url }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            <div style="flex:1;display:flex;flex-direction:column;justify-content:space-between;min-width:0;">
                                <div>
                                    <span style="font-size:.64rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:var(--teal-primary);">{{ $product->category->title ?? '' }}</span>
                                    <h3 style="font-size:.95rem;font-weight:800;color:var(--gray-900);margin:4px 0 8px;line-height:1.3;">{{ $product->title }}</h3>
                                    <p style="font-size:.78rem;color:var(--gray-500);line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ strip_tags($product->description) }}</p>
                                </div>
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:12px;">
                                    @php $fv = $product->variants->first(); $dp = $fv->final_price ?? $fv->price ?? 0; @endphp
                                    <span style="font-size:1.2rem;font-weight:900;color:var(--primary);">₹{{ number_format($dp, 2) }}</span>
                                    <div style="display:flex;gap:8px;">
                                        <button onclick="addToCart({{ $product->id }})" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                        <a href="{{ route('products.single', $product->slug) }}" class="btn btn-secondary btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @include('frontend.components.product-card', ['product' => $product])
                    @endif
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:80px 20px;">
                        <i class="fas fa-box-open" style="font-size:3rem;color:var(--gray-200);margin-bottom:16px;display:block;"></i>
                        <h3 style="font-size:1.1rem;font-weight:800;color:var(--gray-700);margin-bottom:8px;">No products found</h3>
                        <p style="color:var(--gray-400);font-size:.85rem;margin-bottom:20px;">Try adjusting your filters or search query</p>
                        <a href="{{ route('products') }}" class="btn btn-primary">Browse All Products</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div style="margin-top:40px;">
                {{ $products->links('vendor.pagination.simple-premium') }}
            </div>
        </main>
    </div>
</div>

@endsection

@push('scripts')
<script>
function updateSort(val) {
    document.getElementById('sort-input').value = val;
    document.getElementById('filter-form').submit();
}
function setView(view) {
    const url = new URL(window.location.href);
    url.searchParams.set('view', view);
    window.location.href = url.href;
}
function addToCart(id) {
    $.post("{{ route('cart.add') }}", { product_id: id, _token: "{{ csrf_token() }}" }, function(r) {
        if (r.success) {
            toastr.success(r.message || 'Added to cart!');
            document.querySelectorAll('.cart-count-global').forEach(el => el.textContent = r.totalQty);
        }
    });
}
function toggleWishlist(id, btn) {
    @guest toastr.info('Please login first.'); return; @endguest
    $.post("{{ route('wishlist.add') }}", { product_id: id, _token: "{{ csrf_token() }}" }, function(r) {
        if (r.success) {
            toastr.success(r.message);
            btn.classList.toggle('active');
            const icon = btn.querySelector('i');
            icon.className = btn.classList.contains('active') ? 'fas fa-heart' : 'far fa-heart';
        }
    });
}
</script>
@endpush
