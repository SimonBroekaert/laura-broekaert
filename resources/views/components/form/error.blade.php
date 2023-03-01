@props(['key', 'label' => ''])

@php
	$attributes = $attributes->merge([
	    'class' => 'mt-5 rfs:text-sm text-danger font-bold',
	    'for' => $key,
	]);
@endphp

@error($key)
	<p {{ $attributes }}>
		{{ $message }}
	</p>
@enderror
