@extends('frontend.layouts.master')

@section('meta_title')
    {{ $seo['meta_title'] ?? '' }}
@endsection
@section('meta_description')
    {{ $seo['meta_description'] ?? 'GTalk' }}
@endsection
@section('meta_keyword')
    {{ $seo['meta_keyword'] ?? 'GTalk' }}
@endsection

@section('content')
    <section class="hero">
        <div class="container">
            <h1>Manage Customer Relationships<br>Like Never Before</h1>
            <p>ProfileCRM helps you build stronger customer relationships, streamline your sales process, and grow your business with intelligent insights.</p>
            <div class="hero-buttons">
                <a href="#" class="cta-button">Start Free Trial</a>
                <a href="#" class="secondary-button">Watch Demo</a>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container">
            <h2>Powerful Features for Modern Teams</h2>
            <div class="feature-grid">
                @if(isset($Our_Vision) && !empty($Our_Vision))
                    @foreach($Our_Vision as $row)
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>{{ $row->heading }}</h3>
                   <p>
                       <div>{!! $row->description !!}</div>
                   </p>
                    </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section id="stats" class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>50K+</h3>
                    <p>Active Users</p>
                </div>
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Customer Satisfaction</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Support Available</p>
                </div>
                <div class="stat-item">
                    <h3>150+</h3>
                    <p>Countries Served</p>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('stackedScripts')
@endpush
