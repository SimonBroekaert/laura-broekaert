@props(['key', 'label' => ''])

@php
	$attributes = $attributes->merge([
	    'class' => 'block mb-10 cursor-pointer rfs:text-base',
	    'for' => $key,
	]);
@endphp

<label {{ $attributes }}>
	{{ $label ?? $slot }}
</label>
