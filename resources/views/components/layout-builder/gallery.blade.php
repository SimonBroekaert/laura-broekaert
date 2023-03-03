@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-margin',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<x-heading :level="2" class="text-gray-dark mb-30" data-aos="fade-up">
					{{ $block->title }}
				</x-heading>
			</div>
		</div>
		<div class="row">
			@forelse ($block->images as $image)
				<div class="col-12 sm:col-6 lg:col-4 xxl:col-3">
					<div class="relative w-full aspect-4/3 mb-gap bg-gray rounded shadow overflow-hidden" data-aos="zoom-in">
						<x-image :image="$image" format="gallery" class="absolute w-full h-full transition-all select-none bg-gray" />
					</div>
				</div>
			@empty
				<div class="col-12">
					<p class="text-gray-dark">Hier zijn nog geen afbeeldingen te vinden. Neem later opnieuw een kijkje!</p>
				</div>
			@endforelse
		</div>
	</div>
</section>
