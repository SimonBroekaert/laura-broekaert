<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="Simon Broekaert - https://simonbroekaert.be">

	@php
		$defaultTitle = 'Personal Training | Laura Broekaert';
		$title = collect([$page->seo_title ?? ($page->title ?? null), $defaultTitle])
		    ->filter()
		    ->join(' | ');
	@endphp

	<title>{{ $title }}</title>

	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">

	{{-- SEO --}}
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:image" content="{{ $page->getFirstMedia('seo_image')?->getFullUrl() ?? asset('logo/logo.svg') }}">
	<meta property="og:title" content="{{ $title }}">
	<meta property="og:description" content="{{ $page->seo_description }}">
	<meta name="title" content="{{ $title }}">
	<meta name="description" content="{{ $page->seo_description }}">

	{{-- Canonical --}}
	<link rel="canonical" href="{{ url()->current() }}" />

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

<body class="bg-gray-light">
	<x-layout-builder :blocks="$page->body" />
</body>

</html>
