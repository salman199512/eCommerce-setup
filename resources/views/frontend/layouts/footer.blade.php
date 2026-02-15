
<footer class="bg-black text-white pt-24 mt-12 relative overflow-hidden">
    <!-- Subtle Background Element -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-600 to-transparent opacity-50"></div>

    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 pb-20">
            <!-- Brand Column -->
            <div class="lg:col-span-4">
                <a href="{{ route('home') }}" class="inline-block mb-8">
                    <span class="text-3xl font-bold tracking-tighter uppercase">Fashion<span class="text-red-600">.</span></span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed mb-10 max-w-sm font-medium">
                    Redefining modern elegance since 2014. We curate the finest collections for those who appreciate the art of style and quality.
                </p>
                <div class="flex space-x-5">
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-black hover:border-white transition-all duration-300"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-black hover:border-white transition-all duration-300"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-black hover:border-white transition-all duration-300"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-black hover:border-white transition-all duration-300"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <!-- Links Columns -->
            <div class="lg:col-span-2">
                <h4 class="text-xs font-bold uppercase tracking-premium text-gray-400 mb-8">Collections</h4>
                <ul class="space-y-4 text-xs font-bold uppercase tracking-premium text-gray-500">
                    <li><a href="#" class="hover:text-white transition-colors inline-block">Men's Edit</a></li>
                    <li><a href="#" class="hover:text-white transition-colors inline-block">Women's Edit</a></li>
                    <li><a href="#" class="hover:text-white transition-colors inline-block">Accessories</a></li>
                    <li><a href="#" class="hover:text-white transition-colors inline-block">New Arrivals</a></li>
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h4 class="text-xs font-bold uppercase tracking-premium text-gray-400 mb-8">Company</h4>
                <ul class="space-y-4 text-xs font-bold uppercase tracking-premium text-gray-500">
                    <li><a href="{{ route('about-us') }}" class="hover:text-white transition-colors inline-block">The House</a></li>
                    <li><a href="#" class="hover:text-white transition-colors inline-block">Sustainability</a></li>
                    <li><a href="#" class="hover:text-white transition-colors inline-block">Privacy</a></li>
                    <li><a href="{{ route('contact-us') }}" class="hover:text-white transition-colors inline-block">Contact</a></li>
                </ul>
            </div>

            <!-- Contact/Newsletter Column -->
            <div class="lg:col-span-4">
                <h4 class="text-xs font-bold uppercase tracking-premium text-gray-400 mb-8">Newsletter</h4>
                <p class="text-xs text-gray-500 mb-6 font-medium">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form action="{{ route('save.newsletter') }}" method="POST" class="relative">
                    @csrf
                    <input type="email" name="email" placeholder="Email Address"
                           class="w-full bg-transparent border-b border-gray-800 py-3 text-sm focus:outline-none focus:border-white transition-colors placeholder:text-gray-700">
                    <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-[10px] font-bold uppercase tracking-premium hover:text-red-600 transition-colors">
                        Join
                    </button>
                </form>
                <div class="mt-10 flex items-center space-x-6 text-gray-600">
                    <div class="flex flex-col">
                        <span class="text-[9px] uppercase tracking-premium font-bold mb-1">Call Us</span>
                        <span class="text-xs font-bold text-gray-400">+1 800 555 0123</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[9px] uppercase tracking-premium font-bold mb-1">Email Us</span>
                        <span class="text-xs font-bold text-gray-400">concierge@fashion.com</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-900 py-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-[9px] font-bold uppercase tracking-premium text-gray-600">
                &copy; {{ date('Y') }} Fashion Global. All rights reserved.
            </p>
            <div class="flex items-center space-x-8 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                <i class="fab fa-cc-visa text-2xl"></i>
                <i class="fab fa-cc-mastercard text-2xl"></i>
                <i class="fab fa-cc-amex text-2xl"></i>
                <i class="fab fa-cc-paypal text-2xl"></i>
            </div>
        </div>
    </div>
</footer>
