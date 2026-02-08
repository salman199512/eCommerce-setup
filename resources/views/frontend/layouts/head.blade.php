<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('meta_title', 'The eCommerce Store')</title>
<meta name="description" content="@yield('meta_description', 'Default description')">
<meta name="keywords" content="@yield('meta_keyword', 'ecommerce, store')">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css" />
<style>
    :host, html, body { font-family: 'Poppins', sans-serif; }
    h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Poppins', sans-serif; }
</style>


@stack('styles')
