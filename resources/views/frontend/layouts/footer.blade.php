
<footer class="bg-black text-white pt-16 mt-24 border-t-4 border-red-600">
    <!-- Main Footer Links -->
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-gray-800">
        <!-- Brand / Contact -->
        <div>
            <h4 class="font-serif font-bold text-2xl mb-6 tracking-tight">FASHION<span class="text-red-600">.</span></h4>
            <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                We are a global fashion destination. Discover the latest trends and exclusive collections tailored for the modern individual.
            </p>
            <ul class="space-y-4 text-sm text-gray-300">
                <li class="flex items-start"><i class="fa fa-map-marker-alt mt-1 mr-3 text-red-500"></i> 123 Fashion Blvd, New York, NY 10001</li>
                <li class="flex items-center"><i class="fa fa-phone mr-3 text-red-500"></i> +1 212 555 1234</li>
                <li class="flex items-center"><i class="fa fa-envelope mr-3 text-red-500"></i> support@fashion.com</li>
            </ul>
        </div>

        <!-- Information -->
        <div>
            <h4 class="font-bold text-sm uppercase tracking-widest mb-6">Information</h4>
            <ul class="space-y-3 text-sm text-gray-400">
                <li><a href="{{ route('about-us') }}" class="hover:text-red-500 transition duration-300">About Us</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Delivery Information</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Terms & Conditions</a></li>
                <li><a href="{{ route('contact-us') }}" class="hover:text-red-500 transition duration-300">Contact Us</a></li>
            </ul>
        </div>

        <!-- My Account -->
        <div>
            <h4 class="font-bold text-sm uppercase tracking-widest mb-6">My Account</h4>
            <ul class="space-y-3 text-sm text-gray-400">
                <li><a href="#" class="hover:text-red-500 transition duration-300">My Account</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Order History</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Wishlist</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Newsletter</a></li>
                <li><a href="#" class="hover:text-red-500 transition duration-300">Returns</a></li>
            </ul>
        </div>

        <!-- App & Social -->
        <div>
            <h4 class="font-bold text-sm uppercase tracking-widest mb-6">Download App</h4>
            <p class="text-gray-400 text-sm mb-6">Save $3 with App & New User only</p>
            <div class="flex space-x-4 mb-8">
                <a href="#" class="block w-32 bg-gray-800 rounded p-2 hover:bg-gray-700 transition border border-gray-700">
                    <div class="text-xs text-gray-400 text-center">Get it on</div>
                    <div class="font-bold text-sm text-center">Google Play</div>
                </a>
                <a href="#" class="block w-32 bg-gray-800 rounded p-2 hover:bg-gray-700 transition border border-gray-700">
                    <div class="text-xs text-gray-400 text-center">Download on</div>
                    <div class="font-bold text-sm text-center">App Store</div>
                </a>
            </div>
            
            <h4 class="font-bold text-sm uppercase tracking-widest mb-4">Follow Us</h4>
            <div class="flex space-x-4">
                <a href="#" class="w-10 h-10 rounded-full border border-gray-700 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="w-10 h-10 rounded-full border border-gray-700 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-full border border-gray-700 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 rounded-full border border-gray-700 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition text-gray-400 hover:text-white"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright & Payment -->
    <div class="bg-gray-900 py-6">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-xs mb-4 md:mb-0">
                &copy; {{ date('Y') }} FASHION. All Rights Reserved. Designed by Antigravity.
            </p>
            <div class="flex space-x-3 text-gray-400 text-2xl">
                 <i class="fab fa-cc-visa hover:text-white transition"></i>
                 <i class="fab fa-cc-mastercard hover:text-white transition"></i>
                 <i class="fab fa-cc-paypal hover:text-white transition"></i>
                 <i class="fab fa-cc-amex hover:text-white transition"></i>
            </div>
        </div>
    </div>
</footer>
