<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	{{-- General meta --}}
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="Simon Broekaert - https://simonbroekaert.be">
	{{-- Title --}}
	<title>{{ $layout->title }}</title>
	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">
	{{-- SEO --}}
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ $layout->seo->url }}">
	<meta property="og:image" content="{{ $layout->seo->image }}">
	<meta property="og:title" content="{{ $layout->seo->title }}">
	@if ($layout->seo->description)
		<meta property="og:description" content="{{ $layout->seo->description }}">
	@endif
	<meta name="title" content="{{ $layout->seo->title }}">
	@if ($layout->seo->description)
		<meta name="description" content="{{ $layout->seo->description }}">
	@endif
	{{-- Canonical --}}
	<link rel="canonical" href="{{ $layout->canonical }}" />
	{{-- Favicon --}}
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
	<link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg" color="#ff9f43') }}">
	<link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
	<meta name="msapplication-TileColor" content="#f1f5f9">
	<meta name="msapplication-config" content="{{ asset('favicon/browserconfig.xml') }}">
	<meta name="theme-color" content="#f1f5f9">
	{{-- Assets --}}
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
	{{ $attributes->merge([
	    'class' => 'bg-gray-light body group/body custom-scrollbar',
	    'data-menu-state' => 'closed',
	]) }}>
	<x-layout.header />
	<div class="flex flex-col min-h-screen">
		<main class="flex-grow">
			{{ $slot }}
		</main>
		<x-layout.footer />
	</div>
</body>

</html>
