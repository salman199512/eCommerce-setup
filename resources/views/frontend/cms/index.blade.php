@extends('frontend.layouts.master')

@section('title', $cms_detail->title . ' - ' . config('app.name'))

@section('content')
<!-- Page Hero -->
<div class="fm-page-hero">
    <div class="hero-content">
        <span class="hero-subtitle">{{ config('app.name') }} Policy</span>
        <h1 class="hero-title">{{ $cms_detail->title }}</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">{{ $cms_detail->title }}</span>
        </div>
    </div>
</div>

<div style="background:var(--gray-50); padding: 80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: var(--radius-xl); box-shadow: var(--shadow-md);">
                    <div class="card-body p-4 p-lg-5" style="padding: 30px !important;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 32px;">
                            <span style="width: 24px; height: 2px; background: var(--primary); border-radius: 2px;"></span>
                            <span style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: var(--gray-400);">
                                Last updated: {{ $cms_detail->updated_at->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="cms-content" style="color: var(--gray-700); line-height: 1.8; font-size: 1rem;">
                            {!! $cms_detail->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .card-body.p-lg-5 {
            padding: 32px 20px !important;
        }
    }
    .cms-content h2 { font-weight: 800; color: var(--gray-900); margin: 48px 0 24px; font-size: 1.5rem; }
    .cms-content h3 { font-weight: 700; color: var(--gray-800); margin: 36px 0 18px; font-size: 1.25rem; }
    .cms-content p { margin-bottom: 24px; }
    .cms-content ul, .cms-content ol { margin-bottom: 32px; padding-left: 24px; }
    .cms-content li { margin-bottom: 12px; }
</style>
@endsection
