@php
	$attributes = $attributes->merge([
	    'class' => '',
	]);
@endphp

<form {{ $attributes }}>
	@csrf
	<x-honeypot livewire-model="extraFields" />
	{{ $slot }}
</form>
