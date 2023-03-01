@php
	$attributes = $attributes->merge([
	    'class' => '',
	]);
@endphp

<form {{ $attributes }}>
	@csrf
	{{ $slot }}
</form>
