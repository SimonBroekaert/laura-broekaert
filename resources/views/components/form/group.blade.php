@php
	$attributes = $attributes->merge([
	    'class' => 'mb-gap',
	]);
@endphp

<div {{ $attributes }}>
	{{ $slot }}
</div>
