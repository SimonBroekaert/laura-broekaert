@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-padding',
	]);
@endphp

<section {{ $attributes }}>
	<x-image :image="$block->image" format="quote" class="absolute inset-0 w-full h-full -z-1" />
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8">
				<article class="rounded lg:p-100 md:p-65 p-50 bg-black/80" data-aos="fade-up">
					<x-heading :level="2" :style-level="3" class="text-primary">
						{{ $block->quote }}
					</x-heading>
					@if ($block->author)
						<div class="flex justify-end mt-30">
							<p class="font-bold text-white text-h4">
								- {{ $block->author }}
							</p>
						</div>
					@endif
				</article>
			</div>
		</div>
	</div>
</section>
