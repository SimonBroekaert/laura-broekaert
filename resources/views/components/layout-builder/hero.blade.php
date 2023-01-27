@props(['block'])

@php
	$attributes = $attributes->merge([]);
@endphp

<section {{ $attributes }}>
	<img src="{{ $block->getFirstMediaUrl('image') }}" alt="{{ $block->title }}">
	<h1>{{ $block->title }}</h1>
</section>
