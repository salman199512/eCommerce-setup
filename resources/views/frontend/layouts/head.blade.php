<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('meta_title', 'The eCommerce Store')</title>
<meta name="description" content="@yield('meta_description', 'Default description')">
<meta name="keywords" content="@yield('meta_keyword', 'ecommerce, store')">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Google Fonts: Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Swiper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- AOS (Animate on Scroll) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-black: #111111;
        --secondary-black: #333333;
        --accent-red: #DC2626;
        --text-gray: #666666;
        --meta-gray: #999999;
        --bg-light: #F9FAFB;

        /* Font Sizes */
        --text-xs: 0.75rem;     /* 12px */
        --text-sm: 0.875rem;    /* 14px */
        --text-base: 1rem;      /* 16px */
        --text-lg: 1.125rem;    /* 18px */
        --text-xl: 1.25rem;     /* 20px */
        --text-2xl: 1.5rem;     /* 24px */
    }

    body, h1, h2, h3, h4, h5, h6, span, a, p, input, select, button, textarea {
        font-family: 'Poppins', sans-serif !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    body {
        color: var(--secondary-black);
        background-color: #fff;
        line-height: 1.6;
        font-size: var(--text-base);
    }

    h1, h2, h3, h4, h5, h6 {
        color: var(--primary-black);
        font-weight: 700;
        line-height: 1.2;
    }

    a { color: inherit; text-decoration: none; transition: color 0.3s ease; }

    /* Custom tracking for labels */
    .tracking-premium { letter-spacing: 0.15em !important; }
    .tracking-cinematic { letter-spacing: 0.3em !important; }

    /* Utilities */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Premium Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f9f9f9; }
    ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #aaa; }
</style>


@stack('styles')
