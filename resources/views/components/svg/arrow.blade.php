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
	    'viewBox' => '0 0 384 512',
	    'class' => "{$orientationClass} block",
	    'width' => '1em',
	    'height' => '1em',
	]);
@endphp

<svg {{ $attributes }}>
	<path fill="currentColor"
		d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
</svg>
