@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'About Us')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative h-[60vh] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-center">
            <div class="max-w-3xl px-4">
                <h1 class="text-white text-5xl md:text-7xl font-serif font-bold mb-6 tracking-tight">Our Story</h1>
                <p class="text-gray-200 text-lg md:text-xl font-light leading-relaxed uppercase tracking-widest">
                    Crafting Elegance Since 2010
                </p>
            </div>
        </div>
    </div>

    <!-- Intro Section -->
    <div class="container mx-auto px-4 py-20">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2">
                <h2 class="text-4xl font-serif font-bold mb-8 leading-tight">We Believe in Timeless Style & Exceptional Quality</h2>
                <div class="space-y-6 text-gray-600 leading-relaxed">
                    <p>
                        Established in the heart of the fashion district, our brand was born from a passion for minimalist design and high-quality craftsmanship. We believe that fashion should be more than just trends; it should be an expression of individuality and lasting elegance.
                    </p>
                    <p>
                        Every piece in our collection is meticulously curated, ensuring that it meets our rigorous standards for material quality, ethical production, and aesthetic perfection.
                    </p>
                </div>
            </div>
            <div class="w-full md:w-1/2 grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1441984904996-e0b6c669511b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-sm">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-sm mt-8">
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h3 class="text-3xl font-serif font-bold mb-4">Our Values</h3>
                <div class="w-20 h-1 bg-red-600 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-8 bg-white shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-leaf text-2xl text-gray-800"></i>
                    </div>
                    <h4 class="font-bold uppercase tracking-widest text-sm mb-4">Sustainability</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        We are committed to reducing our environmental footprint through ethical sourcing and sustainable materials.
                    </p>
                </div>
                <div class="text-center p-8 bg-white shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-gem text-2xl text-gray-800"></i>
                    </div>
                    <h4 class="font-bold uppercase tracking-widest text-sm mb-4">Quality First</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        No compromises. Every stitch and fabric choice is made with the highest quality standards in mind.
                    </p>
                </div>
                <div class="text-center p-8 bg-white shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-users text-2xl text-gray-800"></i>
                    </div>
                    <h4 class="font-bold uppercase tracking-widest text-sm mb-4">Community</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Empowering craftsmen and building a community of fashion enthusiasts who value integrity.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="container mx-auto px-4 py-20 text-center">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <span class="block text-4xl font-serif font-bold mb-2">10+</span>
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Years of Experience</span>
            </div>
            <div>
                <span class="block text-4xl font-serif font-bold mb-2">50k+</span>
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Happy Customers</span>
            </div>
            <div>
                <span class="block text-4xl font-serif font-bold mb-2">100+</span>
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Premium Retailers</span>
            </div>
            <div>
                <span class="block text-4xl font-serif font-bold mb-2">15+</span>
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Design Awards</span>
            </div>
        </div>
    </div>
</div>
@endsection
