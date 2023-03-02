@props(['key', 'privacyPage' => null])

@php
	$attributes = $attributes->merge([
	    'class' => 'flex items-center gap-15 justify-start',
	]);
@endphp

<label {{ $attributes }}>
	<input class="absolute invisible peer/gdpr -z-1" type="checkbox" id="{{ $key }}"
		wire:model="{{ $key }}" />
	<div
		class="p-10 transition-all border rounded-sm cursor-pointer rfs:text-lg border-gray bg-white peer-checked/gdpr:border-primary text-primary [--child-opacity:0] peer-checked/gdpr:[--child-opacity:1]">
		<x-svg.check class="opacity-[var(--child-opacity,0)]" />
	</div>
	<p class="cursor-pointer rfs:text-base">
		@if ($privacyPage)
			Ik ga akkoord met de <a href="{{ $privacyPage->url }}" class="font-bold underline text-primary" target="_blank">privacy
				voorwaarden</a>.
		@else
			Ik ga akkoord met de privacy voorwaarden.
		@endif
	</p>
</label>
