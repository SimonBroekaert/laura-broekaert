@php
	$attributes = $attributes->merge([]);
@endphp

<nav {{ $attributes }}>
	<ul {{ $ulAttributesBag }}>
		@foreach ($menu->onlineItems as $item)
			<li {{ $liAttributesBag->merge([
			    'class' => $isActive($item) ? 'is-active' : null,
			]) }}>
				<a {{ $aAttributesBag->merge([
				    'href' => $item->url,
				    'target' => $item->target,
				]) }}>
					{{ $item->label }}
				</a>
			</li>
		@endforeach
	</ul>
</nav>
