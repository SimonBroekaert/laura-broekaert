@props(['image', 'format'])

@php
	$attributes = $attributes->merge([
	    'class' => 'object-cover object-center',
	    'src' => $image->getUrl($format),
	    'alt' => $image->getCustomProperty('alt'),
	    'title' => $image->getCustomProperty('alt'),
	]);
@endphp

<picture>
	{{-- Generate all responsive image urls for the given format-webp as a source element --}}
	<source srcset="{{ $image->getSrcset($format . '-webp') }}" type="image/webp">
	{{-- Generate all responsive image urls for the given format as a source element --}}
	<source srcset="{{ $image->getSrcset($format) }}" type="{{ $image->mime_type }}">
	{{-- Generate the image url for the given format as a img element --}}
	<img {{ $attributes }}>
</picture>
