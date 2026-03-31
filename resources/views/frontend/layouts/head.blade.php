<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('meta_title', 'FreshMart — Premium Grocery Store')</title>
<meta name="description" content="@yield('meta_description', 'Shop fresh, organic, and quality groceries online with fast delivery.')">
<meta name="keywords" content="@yield('meta_keyword', 'grocery, fresh produce, organic, online store, supermarket')">
<meta name="theme-color" content="#16a34a">

<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Swiper.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Custom Design System (no Bootstrap, no Tailwind dependency) -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

@stack('styles')
