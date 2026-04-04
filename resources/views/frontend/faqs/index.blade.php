@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Frequently Asked Questions - ' . config('app.name'))
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')

<!-- Page Hero -->
<div class="fm-page-hero">
    <div class="hero-content">
        <span class="hero-subtitle">How can we help you?</span>
        <h1 class="hero-title">Frequently Asked Questions</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">FAQs</span>
        </div>
    </div>
</div>

<div style="background:var(--gray-50); padding: 80px 0;">
    <div class="container overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div style="margin-bottom: 50px; text-align: center;">
                    <div style="display:inline-flex; align-items:center; gap:8px; font-size:0.65rem; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; color:var(--primary); margin-bottom:12px;">
                        <span style="width:20px; height:2px; background:var(--primary); display:inline-block; border-radius:2px;"></span>
                        Got Questions?
                    </div>
                    <h2 style="font-size:2.2rem; font-weight:900; color:var(--gray-900); line-height:1.2;">Everything You Need To Know</h2>
                    <p style="font-size:0.95rem; color:var(--gray-500); margin-top:15px; max-width:550px; margin-left:auto; margin-right:auto; font-weight:500;">
                        Can't find what you're looking for? Check our most common queries below or <a href="{{ route('contact-us') }}" style="color:var(--primary); font-weight:700;">contact our support team</a>.
                    </p>
                </div>

                <!-- FAQ Accordion -->
                <div class="faq-accordion" x-data="{ active: null }">
                    @forelse($faqs as $index => $faq)
                        <div class="faq-item" :class="active === {{ $index }} ? 'active' : ''"
                             style="background:white; border-radius:var(--radius-xl); margin-bottom:16px; border:1px solid var(--border-light); transition:all .3s ease; box-shadow:var(--shadow-sm);">
                            <div class="faq-header" @click="active === {{ $index }} ? active = null : active = {{ $index }}"
                                 style="padding:24px 30px; cursor:pointer; display:flex; align-items:center; justify-content:space-between;">
                                <h4 style="font-size:1.05rem; font-weight:750; color:var(--gray-800); margin:0;">
                                    {{ $faq->question_english }}
                                </h4>
                                <div class="faq-icon" style="flex-shrink:0; width:28px; height:28px; background:var(--gray-50); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--gray-400); transition:all .3s ease;">
                                    <template x-if="active === {{ $index }}">
                                        <i class="fas fa-minus" style="font-size:0.75rem;"></i>
                                    </template>
                                    <template x-if="active !== {{ $index }}">
                                        <i class="fas fa-plus" style="font-size:0.75rem;"></i>
                                    </template>
                                </div>
                            </div>
                            <div class="faq-body" x-show="active === {{ $index }}" x-collapse
                                 style="padding:0 30px 30px; color:var(--gray-600); line-height:1.8; font-size:0.95rem; font-weight:500;">
                                {!! nl2br($faq->answer_english) !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-question-circle fa-3x" style="color:var(--gray-200); margin-bottom:20px;"></i>
                            <h4 style="color:var(--gray-400);">No FAQs available yet.</h4>
                        </div>
                    @endforelse
                </div>

                <!-- CTA -->
                <div style="background:var(--primary); border-radius:var(--radius-2xl); padding:40px; margin-top:60px; display:flex; align-items:center; gap:24px; color:white; position:relative; overflow:hidden; box-shadow:var(--shadow-green);">
                    <!-- Decoration Pattern -->
                    <div style="position:absolute; top:-20px; right:-20px; width:120px; height:120px; background:rgba(255,255,255,.05); border-radius:50%;"></div>

                    <div style="width:64px; height:64px; background:rgba(255,255,255,.15); backdrop-filter:blur(10px); border-radius:var(--radius-lg); display:flex; align-items:center; justify-content:center; font-size:1.5rem;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div style="flex:1;">
                        <h4 style="font-weight:900; margin-bottom:4px; font-size:1.25rem;">Still have questions?</h4>
                        <p style="margin:0; font-size:0.85rem; color:rgba(255,255,255,.8); font-weight:500;">Our expert fashion consultants are available 24/7 to assist you with any query.</p>
                    </div>
                    <a href="{{ route('contact-us') }}" class="btn btn-secondary" style="font-weight:800; padding:12px 28px; border-radius:var(--radius-lg); font-size:0.8rem;">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .faq-item.active { border-color: var(--primary) !important; box-shadow: var(--shadow-md) !important; }
    .faq-item.active .faq-icon { background: var(--primary) !important; color: white !important; }
    .faq-item:hover:not(.active) { border-color: var(--primary-light) !important; transform: translateY(-2px); }
</style>
@endsection
