{{-- ══════════════════════════════════
     Luxura Professional Footer
══════════════════════════════════ --}}

<!-- Newsletter Banner -->
<section style="padding:0 0 64px;">
    <div class="container">
        <div class="newsletter-section">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;position:relative;z-index:1;">
                <div>
                    <div class="section-eyebrow newsletter-eyebrow"><i class="fas fa-envelope"></i> Newsletter</div>
                    <h2 class="newsletter-title">Get Style Updates<br>In Your Inbox</h2>
                    <p class="newsletter-sub">Subscribe and get 10% off your first order. Exclusive deals, new collections, and more.</p>
                    <div style="display:flex;gap:6px;align-items:center;color:rgba(255,255,255,.6);font-size:.72rem;font-weight:600;">
                        <i class="fas fa-shield-halved" style="color:var(--yellow-light);"></i>
                        We never share your email. Unsubscribe anytime.
                    </div>
                </div>
                <div>
                    <form action="{{ route('save.newsletter') }}" method="POST">
                        @csrf
                        <div class="newsletter-form">
                            <input type="email" name="email" class="newsletter-input" placeholder="Enter your email address…" required>
                            <button type="submit" class="btn btn-secondary btn-lg">
                                <i class="fas fa-paper-plane"></i> Subscribe
                            </button>
                        </div>
                        <div style="margin-top:10px;color:rgba(255,255,255,.45);font-size:.68rem;">
                            🎁 Get instant 10% off coupon on subscription
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-top">

            <!-- Brand Column -->
            <div>
                <a href="{{ route('home') }}" class="site-logo" style="display:flex; gap:12px; align-items:center;">
                    <div class="logo-icon" style="background: white; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #1e40af; font-size: 1.4rem;">
                        <i class="fas fa-l" style="font-weight: 900; position: relative;">
                            <i class="fas fa-leaf" style="font-size: 0.6rem; position: absolute; top: -2px; right: -4px; transform: rotate(15deg); opacity: 0.9;"></i>
                        </i>
                    </div>
                    <div>
                        <div class="logo-text-top" style="color: white; font-weight: 900; font-size: 1.5rem; letter-spacing: -0.02em;">Lux<span>ura</span></div>
                        <div class="logo-text-bottom" style="color:rgba(255,255,255,.35); font-weight:700; letter-spacing: 0.1em; font-size: 0.55rem;">Premium Fashion Store</div>
                    </div>
                </a>
                <p class="footer-desc">Your trusted destination for the latest fashion trends, high-quality apparel, and designer lifestyle accessories delivered to your doorstep since 2019.</p>

                <!-- App Badges -->
                <div style="display:flex;gap:10px;margin-bottom:24px;flex-wrap:wrap;">
                    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:8px 14px;">
                        <i class="fab fa-apple" style="font-size:1.3rem;color:rgba(255,255,255,.7);"></i>
                        <div style="line-height:1.2;">
                            <div style="font-size:.55rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.08em;">Download on</div>
                            <div style="font-size:.78rem;font-weight:700;color:rgba(255,255,255,.8);">App Store</div>
                        </div>
                    </div>
                    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:8px 14px;">
                        <i class="fab fa-google-play" style="font-size:1.1rem;color:rgba(255,255,255,.7);"></i>
                        <div style="line-height:1.2;">
                            <div style="font-size:.55rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.08em;">Get it on</div>
                            <div style="font-size:.78rem;font-weight:700;color:rgba(255,255,255,.8);">Google Play</div>
                        </div>
                    </div>
                </div>

                <div class="footer-socials">
                    <a href="#" class="footer-social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social-btn" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="footer-social-btn" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="footer-social-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <div class="footer-col-title">Quick Links</div>
                <div class="footer-links">
                    <a href="{{ route('home') }}"><i class="fas fa-house" style="width:14px;"></i> Home</a>
                    <a href="{{ route('products') }}"><i class="fas fa-store" style="width:14px;"></i> Shop Now</a>
                    <a href="{{ route('about-us') }}"><i class="fas fa-circle-info" style="width:14px;"></i> About Us</a>
                    <a href="{{ route('contact-us') }}"><i class="fas fa-headset" style="width:14px;"></i> Support</a>
                    <a href="{{ route('my-orders') }}"><i class="fas fa-box" style="width:14px;"></i> Track Order</a>
                    <a href="{{ route('wishlist') }}"><i class="fas fa-heart" style="width:14px;"></i> Wishlist</a>
                </div>
            </div>

            <!-- Categories -->
            <div>
                <div class="footer-col-title">Categories</div>
                <div class="footer-links">
                    @php $cats = $sharedCategories ?? collect(); @endphp
                    @foreach($cats->take(7) as $cat)
                    <a href="{{ route('products', ['category' => $cat->slug]) }}">
                        <i class="fas fa-angle-right" style="width:14px;font-size:.6rem;color:var(--primary);"></i>
                        {{ $cat->title }}
                    </a>
                    @endforeach
                    @if($cats->count() > 7)
                    <a href="{{ route('products') }}" style="color:var(--primary);font-weight:800;font-size:.72rem;">View All →</a>
                    @endif
                </div>
            </div>

            <!-- Contact & Info -->
            <div>
                <div class="footer-col-title">Contact Us</div>
                <div style="margin-bottom:24px;">
                    <div class="footer-contact-item">
                        <div class="footer-contact-item" style="margin-bottom:0;">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <div>
                            <div class="footer-contact-label">Address</div>
                            <div class="footer-contact-value">123 Market Street, Fresh District<br>San Francisco, CA 94103</div>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-item" style="margin-bottom:0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div class="footer-contact-label">Phone</div>
                            <div class="footer-contact-value">+1 (800) 555-MART</div>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-item" style="margin-bottom:0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <div class="footer-contact-label">Email</div>
                            <div class="footer-contact-value">support@luxura.com</div>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-item" style="margin-bottom:0;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="footer-contact-label">Hours</div>
                            <div class="footer-contact-value">Mon–Sat: 8am – 9pm<br>Sun: 9am – 7pm</div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <div style="display:flex;align-items:center;gap:8px;font-size:.72rem;color:rgba(255,255,255,.5);font-weight:600;">
                        <i class="fas fa-shield-halved" style="color:#22c55e;"></i> SSL Secure Checkout
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;font-size:.72rem;color:rgba(255,255,255,.5);font-weight:600;">
                        <i class="fas fa-rotate-left" style="color:#f59e0b;"></i> 7-Day Money Back Guarantee
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;font-size:.72rem;color:rgba(255,255,255,.5);font-weight:600;">
                        <i class="fas fa-truck-fast" style="color:#38bdf8;"></i> Free delivery on orders over ₹49
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="footer-copy">&copy; {{ date('Y') }} Luxura. All rights reserved. Made with <span style="color:#ef4444;">❤</span> for style trendsetters.</p>
            <div class="footer-payment">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-apple-pay"></i>
                <i class="fab fa-google-pay"></i>
            </div>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top -->
<button id="scroll-top-btn" onclick="window.scrollTo({top:0,behavior:'smooth'})"
    style="position:fixed;bottom:28px;right:28px;width:46px;height:46px;background:var(--grad-green);color:white;border:none;border-radius:50%;box-shadow:var(--shadow-green);display:none;align-items:center;justify-content:center;font-size:1rem;z-index:9999;cursor:pointer;transition:all .3s;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
const scrollTopBtn = document.getElementById('scroll-top-btn');
window.addEventListener('scroll', () => {
    if (window.scrollY > 400) { scrollTopBtn.style.display = 'flex'; }
    else { scrollTopBtn.style.display = 'none'; }
});
</script>
