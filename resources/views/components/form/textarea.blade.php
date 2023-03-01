@php
	$attributes = $attributes->merge([
	    'class' => 'py-10 px-30 rounded rfs:text-lg border border-gray w-full focus:border-primary focus:outline-primary transition-all outline-primary resize-none',
	    'rows' => '5',
	]);
@endphp

<textarea {{ $attributes }}></textarea>
