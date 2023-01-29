@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative bg-gradient-to-t from-black/50',
	]);
@endphp

<section {{ $attributes }}>
	<x-image :image="$block->image" format="hero" class="absolute inset-0 object-cover w-full h-full -z-10" />
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="lg:my-100 md:my-85 my-75">
					<x-heading :level="2" :style-level="1" class="text-center text-white">
						{{ $block->title }}
					</x-heading>
				</div>
			</div>
		</div>
	</div>
</section>
