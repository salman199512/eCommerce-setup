@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'About Us')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')

<div class="bg-white">
    <!-- Hero Section -->
    <div style="position:relative;height:60vh;overflow:hidden;">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1950&q=80" 
             style="width:100%;height:100%;object-fit:cover;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;text-align:center;">
            <div style="max-width:800px;padding:0 24px;">
                <h1 style="color:white;font-size:3.5rem;font-weight:900;margin-bottom:24px;text-transform:uppercase;letter-spacing:-0.05em;line-height:1;">Our Story</h1>
                <p style="color:rgba(255,255,255,0.8);font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.3em;">
                    Nurturing Freshness Since 2019
                </p>
            </div>
        </div>
    </div>

    <!-- Intro Section -->
    <div style="max-width:1400px;margin:0 auto;padding:100px 24px;">
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:64px;">
            <div style="flex:1;min-width:300px;">
                <h2 style="font-size:2.5rem;font-weight:900;margin-bottom:32px;line-height:1.1;text-transform:uppercase;letter-spacing:-0.03em;color:var(--gray-900);">Fresh From Farm &<br>Delivered With Care</h2>
                <div style="color:var(--gray-500);font-weight:600;line-height:1.7;font-size:1.05rem;">
                    <p style="margin-bottom:24px;">
                        Established in the heart of the community, FreshMart was born from a passion for organic farming and sustainable living. We believe that everyone deserves access to the freshest produce, free from harmful chemicals.
                    </p>
                    <p>
                        Every item in our store is meticulously selected from local farmers, ensuring that it meets our rigorous standards for taste, nutrition, and environmental responsibility.
                    </p>
                </div>
            </div>
            <div style="flex:1;min-width:300px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=600&q=80" style="width:100%;height:250px;object-fit:cover;border-radius:var(--radius-2xl);box-shadow:var(--shadow-lg);">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80" style="width:100%;height:250px;object-fit:cover;border-radius:var(--radius-2xl);margin-top:32px;box-shadow:var(--shadow-lg);">
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div style="background:var(--gray-50);padding:100px 0;">
        <div style="max-width:1400px;margin:0 auto;padding:0 24px;">
            <div style="text-align:center;max-width:700px;margin:0 auto 64px;">
                <span style="color:var(--primary);font-size:0.75rem;font-weight:900;text-transform:uppercase;letter-spacing:0.3em;display:block;margin-bottom:12px;">Foundations</span>
                <h3 style="font-size:2.5rem;font-weight:900;margin-bottom:16px;text-transform:uppercase;letter-spacing:-0.02em;">Our Ethos</h3>
                <div style="width:48px;height:4px;background:var(--primary);margin:0 auto;border-radius:var(--radius-full);"></div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));gap:48px;">
                <div style="text-align:center;padding:48px;background:white;border-radius:var(--radius-3xl);border:1px solid var(--gray-100);transition:var(--trans-base);box-shadow:var(--shadow-sm);">
                    <div style="width:64px;height:64px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                        <i class="fa fa-leaf" style="font-size:1.5rem;color:var(--primary);"></i>
                    </div>
                    <h4 style="font-size:0.75rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:16px;">Sustainability</h4>
                    <p style="color:var(--gray-500);font-size:0.9rem;line-height:1.6;font-weight:600;">
                        We are committed to reducing our environmental footprint through ethical sourcing and sustainable materials.
                    </p>
                </div>
                <div style="text-align:center;padding:48px;background:white;border-radius:var(--radius-3xl);border:1px solid var(--gray-100);transition:var(--trans-base);box-shadow:var(--shadow-sm);">
                    <div style="width:64px;height:64px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                        <i class="fa fa-gem" style="font-size:1.5rem;color:var(--primary);"></i>
                    </div>
                    <h4 style="font-size:0.75rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:16px;">Quality First</h4>
                    <p style="color:var(--gray-500);font-size:0.9rem;line-height:1.6;font-weight:600;">
                        No compromises. Every harvest and product choice is made with the highest quality standards in mind.
                    </p>
                </div>
                <div style="text-align:center;padding:48px;background:white;border-radius:var(--radius-3xl);border:1px solid var(--gray-100);transition:var(--trans-base);box-shadow:var(--shadow-sm);">
                    <div style="width:64px;height:64px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin-0 auto 24px;margin-bottom:24px;margin-left:auto;margin-right:auto;">
                        <i class="fa fa-users" style="font-size:1.5rem;color:var(--primary);"></i>
                    </div>
                    <h4 style="font-size:0.75rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:16px;">Community</h4>
                    <p style="color:var(--gray-500);font-size:0.9rem;line-height:1.6;font-weight:600;">
                        Empowering local farmers and building a community of organic lovers who value integrity.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div style="max-width:1400px;margin:0 auto;padding:100px 24px;text-align:center;">
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:64px;">
            <div>
                <span style="display:block;font-size:3.5rem;font-weight:900;margin-bottom:8px;letter-spacing:-0.05em;line-height:1;">10+</span>
                <span style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);font-weight:900;">Years Experience</span>
            </div>
            <div>
                <span style="display:block;font-size:3.5rem;font-weight:900;margin-bottom:8px;letter-spacing:-0.05em;line-height:1;">50k+</span>
                <span style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);font-weight:900;">Happy Clients</span>
            </div>
            <div>
                <span style="display:block;font-size:3.5rem;font-weight:900;margin-bottom:8px;letter-spacing:-0.05em;line-height:1;">100+</span>
                <span style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);font-weight:900;">Retail Partners</span>
            </div>
            <div>
                <span style="display:block;font-size:3.5rem;font-weight:900;margin-bottom:8px;letter-spacing:-0.05em;line-height:1;">15+</span>
                <span style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);font-weight:900;">Global Awards</span>
            </div>
        </div>
    </div>
</div>
@endsection
