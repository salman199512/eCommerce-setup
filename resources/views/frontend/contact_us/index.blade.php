@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Contact Us — FreshMart')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')

<!-- Page Hero -->
<div class="fm-page-hero">
    <div class="hero-content">
        <span class="hero-subtitle">We'd love to hear from you</span>
        <h1 class="hero-title">Contact Us</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">Contact Us</span>
        </div>
    </div>
</div>

<!-- Contact Info Cards Row -->
<div style="background:var(--gray-50);padding:40px 0;border-bottom:1px solid var(--border-light);">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">

        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-xl);padding:24px;text-align:center;box-shadow:var(--shadow-sm);transition:box-shadow .25s;" onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:52px;height:52px;background:var(--primary-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--primary);font-size:1.2rem;">
                <i class="fas fa-location-dot"></i>
            </div>
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.14em;color:var(--gray-400);margin-bottom:8px;">Our Store</div>
            <div style="font-size:0.82rem;font-weight:600;color:var(--gray-700);line-height:1.6;">123 Market Street,<br>San Francisco, CA 94103</div>
        </div>

        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-xl);padding:24px;text-align:center;box-shadow:var(--shadow-sm);transition:box-shadow .25s;" onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:52px;height:52px;background:var(--secondary-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--secondary);font-size:1.2rem;">
                <i class="fas fa-phone-volume"></i>
            </div>
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.14em;color:var(--gray-400);margin-bottom:8px;">Phone</div>
            <div style="font-size:0.82rem;font-weight:600;color:var(--gray-700);line-height:1.6;">+1 (800) 555-MART<br>Mon–Sat, 8am–9pm</div>
        </div>

        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-xl);padding:24px;text-align:center;box-shadow:var(--shadow-sm);transition:box-shadow .25s;" onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:52px;height:52px;background:var(--teal-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--teal-primary);font-size:1.2rem;">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.14em;color:var(--gray-400);margin-bottom:8px;">Email</div>
            <div style="font-size:0.82rem;font-weight:600;color:var(--gray-700);line-height:1.6;">support@freshmart.com<br>hello@freshmart.com</div>
        </div>

        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-xl);padding:24px;text-align:center;box-shadow:var(--shadow-sm);transition:box-shadow .25s;" onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:52px;height:52px;background:var(--purple-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--purple-primary);font-size:1.2rem;">
                <i class="fas fa-clock"></i>
            </div>
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.14em;color:var(--gray-400);margin-bottom:8px;">Working Hours</div>
            <div style="font-size:0.82rem;font-weight:600;color:var(--gray-700);line-height:1.6;">Mon–Sat: 8am–9pm<br>Sun: 9am–7pm</div>
        </div>

    </div>
</div>

<!-- Main Contact Grid: Info + Form -->
<div style="max-width:1280px;margin:0 auto;padding:64px 24px;display:grid;grid-template-columns:1fr 1.4fr;gap:40px;align-items:start;">

    <!-- Info Panel -->
    <div class="contact-info-panel">
        <div style="margin-bottom:32px;">
            <div style="display:inline-flex;align-items:center;gap:6px;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--primary);margin-bottom:10px;">
                <span style="width:18px;height:2px;background:currentColor;display:inline-block;border-radius:2px;"></span> Get in Touch
            </div>
            <h2 style="font-size:2rem;font-weight:900;color:var(--gray-900);line-height:1.2;margin-bottom:16px;">We're Here to Help</h2>
            <p style="font-size:0.88rem;color:var(--gray-600);font-weight:500;line-height:1.7;">
                Whether you have questions about our fresh organic produce, delivery schedules, or anything else — our friendly team is ready to help every step of the way.
            </p>
        </div>

        <!-- Location Map Image -->
        <div style="border-radius:var(--radius-xl);overflow:hidden;position:relative;height:220px;margin-bottom:28px;border:1px solid var(--primary-light);">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80"
                 style="width:100%;height:100%;object-fit:cover;opacity:0.85;">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(5,46,22,0.7),transparent);display:flex;align-items:flex-end;padding:20px;">
                <div>
                    <div style="display:inline-flex;align-items:center;gap:6px;background:var(--primary);color:white;padding:7px 16px;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.12em;border-radius:var(--radius-full);">
                        <i class="fas fa-map-pin"></i> Visit Our Store
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div style="display:flex;flex-direction:column;gap:12px;">
            <a href="{{ route('products') }}" style="display:flex;align-items:center;gap:12px;padding:14px 18px;background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);font-size:0.8rem;font-weight:700;color:var(--gray-700);text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='var(--primary)';this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border-light)';this.style.color='var(--gray-700)'">
                <i class="fas fa-store" style="color:var(--primary);width:18px;"></i> Browse Our Store
                <i class="fas fa-arrow-right" style="margin-left:auto;font-size:0.65rem;opacity:.4;"></i>
            </a>
            <a href="{{ route('my-orders') }}" style="display:flex;align-items:center;gap:12px;padding:14px 18px;background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);font-size:0.8rem;font-weight:700;color:var(--gray-700);text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='var(--primary)';this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border-light)';this.style.color='var(--gray-700)'">
                <i class="fas fa-box-open" style="color:var(--secondary);width:18px;"></i> Track My Order
                <i class="fas fa-arrow-right" style="margin-left:auto;font-size:0.65rem;opacity:.4;"></i>
            </a>
        </div>
    </div>

    <!-- Contact Form Panel -->
    <div class="contact-form-panel">
        <div style="margin-bottom:32px;">
            <div style="display:inline-flex;align-items:center;gap:6px;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--secondary);margin-bottom:10px;">
                <span style="width:18px;height:2px;background:currentColor;display:inline-block;border-radius:2px;"></span> Message Us
            </div>
            <h3 style="font-size:1.6rem;font-weight:900;color:var(--gray-900);">Send a Message</h3>
            <p style="font-size:0.8rem;color:var(--gray-400);margin-top:6px;font-weight:500;">We'll get back to you within 24 hours.</p>
        </div>

        <form action="{{ route('save-inquiry') }}" method="POST" id="contact-form" style="display:flex;flex-direction:column;gap:20px;">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="fm-group" style="margin-bottom:0;">
                    <label class="fm-label">Your Name <span style="color:var(--red-primary);">*</span></label>
                    <input type="text" name="name" required class="fm-input" placeholder="John Smith">
                </div>
                <div class="fm-group" style="margin-bottom:0;">
                    <label class="fm-label">Email Address <span style="color:var(--red-primary);">*</span></label>
                    <input type="email" name="email" required class="fm-input" placeholder="john@example.com">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="fm-group" style="margin-bottom:0;">
                    <label class="fm-label">Phone Number <span style="color:var(--red-primary);">*</span></label>
                    <input type="text" name="phone" required class="fm-input" placeholder="+1 (x) xxx-xxxx">
                </div>
                <div class="fm-group" style="margin-bottom:0;">
                    <label class="fm-label">Subject <span style="color:var(--red-primary);">*</span></label>
                    <input type="text" name="subject" required class="fm-input" placeholder="How can we help?">
                </div>
            </div>

            <div class="fm-group" style="margin-bottom:0;">
                <label class="fm-label">Message <span style="color:var(--red-primary);">*</span></label>
                <textarea name="message" rows="5" required class="fm-input" style="height:auto;resize:vertical;padding-top:14px;" placeholder="Tell us more about your inquiry..."></textarea>
            </div>

            <div style="display:flex;align-items:center;gap:10px;padding:14px 18px;background:var(--primary-soft);border:1px solid var(--primary-light);border-radius:var(--radius-md);">
                <i class="fas fa-shield-halved" style="color:var(--primary);font-size:1rem;flex-shrink:0;"></i>
                <span style="font-size:0.72rem;color:var(--primary-dark);font-weight:600;">Your information is safe with us. We never share your data with third parties.</span>
            </div>

            <div>
                <button type="submit" class="fm-btn-vibrant" style="display:flex;justify-content:center;align-items:center;gap:10px;padding:16px 32px;font-size:0.78rem;width:auto;">
                    Send Message <i class="fas fa-paper-plane" style="font-size:0.75rem;"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
@media (max-width: 900px) {
    .contact-main-grid { grid-template-columns: 1fr !important; }
    .contact-info-cards { grid-template-columns: 1fr 1fr !important; }
}
@media (max-width: 560px) {
    .contact-info-cards { grid-template-columns: 1fr !important; }
}
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const btn = form.find('button[type="submit"]');
            const originalHtml = btn.html();
            btn.prop('disabled', true).html('Sending... <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    toastr.success(response.message || 'Thank you! Your message has been sent.');
                    form[0].reset();
                },
                error: function(xhr) {
                    const message = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong. Please try again.';
                    toastr.error(message);
                },
                complete: function() {
                    btn.prop('disabled', false).html(originalHtml);
                }
            });
        });
    });
</script>
@endpush
