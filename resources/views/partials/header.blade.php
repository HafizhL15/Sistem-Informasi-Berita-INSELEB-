<!--header-->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}" itemprop="description">
<meta name="keywords" content="{{ $keywords }}" itemprop="keywords">
<meta content="{{ $description }}" itemprop="keywords" />

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8; IE=edge; Chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="base" content="{{ Request::root() }}" />
<link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $icon) }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $icon) }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/' . $icon) }}">
<link rel="alternate" href="{{ url()->current() }}" hreflang="id" />
<link rel="canonical" href="{{ url()->full() }}" />
<meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1" />
<meta name="googlebot-news" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1" />
<meta name="googlebot" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1" />
<meta name="language" content="id" />
<meta name="geo.country" content="id" />
<meta http-equiv="content-language" content="In-Id" />
<meta name="geo.placename" content="Indonesia" />
<meta name="copyright" content="{{ $domain }}, All Rights Reserved" />
<meta name="author" content="{{ $domain }}" itemprop="name">
<meta name="theme-creator" content="{{ $domain }}">

@yield('meta_tags')

{!! $meta_header !!}


<link rel="alternate" type="application/atom+xml" title="{{ Request::root() }}" href="/feed">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<!-- Font CSS -->
<link rel="stylesheet" href="{{ asset('css') }}/mystyle.css" />
<!-- Nav CSS -->
<link rel="stylesheet" href="{{ asset('css') }}/scrollmenu.css" />
<!-- Img CSS -->
<link rel="stylesheet" href="{{ asset('css') }}/img.css" />
<!-- Carousel Caption CSS -->
<link rel="stylesheet" href="{{ asset('css') }}/carouselcaption.css" />
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
<!-- JS Socials -->
<link href="{{ asset('assets') }}/plugins/jssocials/jssocials.css" rel="stylesheet">
<link href="{{ asset('assets') }}/plugins/jssocials/jssocials-theme-classic.css" rel="stylesheet">
<!-- Codesample -->
<link rel="stylesheet" href="{{ asset('vendor/prism.css') }}">
<!--header end-->
