@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative lg:my-100 md:my-85 my-75',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8" data-carousel data-aos="zoom-out">
				<div class="relative w-full overflow-hidden aspect-4/3 md:aspect-16/9">
					@foreach ($block->images as $image)
						<x-image :image="$image" format="images" data-carousel-item data-toggle-classes="invisible opacity-0"
							data-active="{{ $loop->first ? 'true' : 'false' }}" @class([
								'absolute overflow-hidden transition-all rounded shadow select-none w-full h-full bg-gray',
								'invisible opacity-0' => !$loop->first,
							]) />
					@endforeach
				</div>
				@if (count($block->images) > 1)
					<div class="flex justify-end gap-20 mt-20">
						<x-button theme="secondary" title="Vorige" data-carousel-control="previous">
							<x-svg.arrow orientation="left" />
							<span class="sr-only">Vorige</span>
						</x-button>
						<x-button theme="secondary" title="Volgende" data-carousel-control="next">
							<x-svg.arrow orientation="right" />
							<span class="sr-only">Volgende</span>
						</x-button>
					</div>
				@endif
			</div>
		</div>
	</div>
</section>
