@props(['level' => 1, 'styleLevel' => null])

@php
	$styleLevel ??= $level;
	$fontSizeClass = match ($styleLevel) {
	    1 => 'rfs:text-h1',
	    2 => 'rfs:text-h2',
	    3 => 'rfs:text-h3',
	    4 => 'rfs:text-h4',
	    default => 'text-base',
	};
	$attributes = $attributes->merge([
	    'class' => "{$fontSizeClass} font-bold",
	]);
@endphp

<h{{ $level }} {{ $attributes }}>{{ $slot }}</h{{ $level }}>
