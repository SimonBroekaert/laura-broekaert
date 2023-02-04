@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block bg-gradient-to-t from-black/50',
	]);
@endphp

<section {{ $attributes }}>
	<x-image :image="$block->image" format="hero" class="absolute inset-0 object-cover w-full h-full -z-1" />
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="layout-block-margin" data-aos="zoom-out">
					<x-heading :level="2" :style-level="1" class="text-center text-white">
						{{ $block->title }}
					</x-heading>
				</div>
			</div>
		</div>
	</div>
</section>
