<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('meta_title', 'Luxura — Premium eCommerce Store')</title>
<meta name="description" content="@yield('meta_description', 'Discover fashion, electronics, watches and more at unbeatable prices.')">
<meta name="keywords" content="@yield('meta_keyword', 'ecommerce, fashion, electronics, watches, online shopping')">
<meta name="theme-color" content="#1e40af">
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='25' fill='%231e40af'/%3E%3Cpath d='M35 25 h15 v40 h20 v10 h-35 z' fill='white'/%3E%3Cpath d='M70 25 l5 5 l-5 5 l-5 -5 z' fill='%2360a5fa'/%3E%3C/svg%3E">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}?v={{ time() }}">

@stack('styles')
