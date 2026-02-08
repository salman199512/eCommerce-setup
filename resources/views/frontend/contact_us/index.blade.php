@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Contact Us')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="bg-white">
    <!-- Breadcrumb/Header -->
    <div class="bg-gray-100 py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-serif font-bold mb-4">Contact Us</h1>
            <div class="flex justify-center items-center space-x-2 text-sm text-gray-500 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
                <i class="fa fa-angle-right text-xs"></i>
                <span class="text-black font-bold">Contact Us</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-3xl font-serif font-bold mb-6">Get in Touch</h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        We'd love to hear from you. Whether you have a question about our collections, shipping, or anything else, our team is ready to answer all your questions.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-4 border-b-2 border-red-600 inline-block">Location</h4>
                        <p class="text-gray-600 text-sm">
                            123 Fashion Street,<br>
                            Design District,<br>
                            New York, NY 10001
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-4 border-b-2 border-red-600 inline-block">Contact</h4>
                        <p class="text-gray-600 text-sm">
                            Phone: +1 123 456 7890<br>
                            Email: support@fashion.com<br>
                            Work Hours: Mon - Sat, 9am - 6pm
                        </p>
                    </div>
                </div>

                <!-- Map Placeholder -->
                <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative group overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                         class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition duration-1000">
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                         <div class="bg-black text-white px-6 py-2 font-bold uppercase text-xs tracking-widest">Store Location</div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 md:p-12">
                <h3 class="text-2xl font-serif font-bold mb-8">Send a Message</h3>
                
                <form action="{{ route('save-inquiry') }}" method="POST" id="contact-form" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Name</label>
                            <input type="text" name="name" required class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-black transition duration-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-black transition duration-300">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Phone</label>
                            <input type="text" name="phone" required class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-black transition duration-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Subject</label>
                            <input type="text" name="subject" required class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-black transition duration-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Message</label>
                        <textarea name="message" rows="5" required class="w-full border-b-2 border-gray-200 bg-transparent py-3 focus:outline-none focus:border-black transition duration-300 resize-none"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-black text-white px-8 py-4 font-bold uppercase tracking-widest hover:bg-red-600 transition duration-300 flex items-center justify-center gap-3">
                            Send Message <i class="fa fa-paper-plane text-xs"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const btn = form.find('button[type="submit"]');
            const originalText = btn.html();

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
                    btn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
</script>
@endpush
