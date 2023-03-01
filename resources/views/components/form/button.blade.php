@php
	$theme = 'primary';
	// Check if html attribute 'type' is set and if it is set to 'button'
	if ($attributes->has('type') && $attributes->get('type') === 'button') {
	    $theme = 'secondary';
	}
	$attributes = $attributes->merge([
	    'class' => '',
	    'theme' => $theme,
	]);
@endphp

<x-button {{ $attributes }}>
	{{ $label ?? $slot }}
</x-button>
