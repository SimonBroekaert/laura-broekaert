@props(['key', 'label'])

@php
	$attributes = $attributes->merge([
	    'class' => 'flex items-center gap-15 justify-start',
	]);
@endphp

<label {{ $attributes }}>
	<div class="relative">
		<input class="absolute opacity-0 peer/gdpr -z-1" type="checkbox" id="{{ $key }}"
			wire:model="{{ $key }}" />
		<div
			class="p-10 transition-colors border rounded-sm cursor-pointer rfs:text-lg border-gray bg-white peer-checked/gdpr:border-primary text-primary [--child-opacity:0] peer-checked/gdpr:[--child-opacity:1] peer-focus/gdpr:border-primary peer-focus/gdpr:border-2">
			<x-svg.check class="opacity-[var(--child-opacity,0)]" />
		</div>
	</div>
	<p class="cursor-pointer rfs:text-base">
		{{ $label }}
	</p>
</label>
