@props([
    'orientation' => 'up',
])

@php
	$orientationClass = match ($orientation) {
	    'up' => 'rotate-0',
	    'down' => 'rotate-180',
	    'left' => '-rotate-90',
	    'right' => 'rotate-90',
	};
	$attributes = $attributes->merge([
	    'xmlns' => 'http://www.w3.org/2000/svg',
	    'viewBox' => '0 0 24 24',
	    'class' => "{$orientationClass} block fill-current",
	    'stroke-width' => '4',
	    'stroke-linecap' => 'round',
	    'stroke-linejoin' => 'round',
	    'stroke' => 'currentColor',
	    'width' => '1em',
	    'height' => '1em',
	]);
@endphp

<svg {{ $attributes }}>
	<line x1="12" y1="19" x2="12" y2="5"></line>
	<polyline points="5 12 12 5 19 12"></polyline>
</svg>
