@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative lg:my-100 md:my-85 my-75',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div @class([
			'items-center justify-between row',
			'md:flex-row-reverse' => isEven($block->data_type_index),
		])>
			<div class="col-12 md:col-6">
				<article data-aos="fade-up">
					@if ($block->title)
						<x-heading :level="2" class="text-gray-dark mb-30">
							{{ $block->title }}
						</x-heading>
					@endif
					<div class="tiptap">
						{!! $block->body !!}
					</div>
					@if ($block->first_button || $block->second_button)
						<div class="flex gap-20 mt-30">
							@if ($block->first_button)
								<x-button :href="$block->first_button->link" :target="$block->first_button->target">
									{{ $block->first_button->label }}
								</x-button>
							@endif
							@if ($block->second_button)
								<x-button :href="$block->second_button->link" :target="$block->second_button->target" theme="secondary">
									{{ $block->second_button->label }}
								</x-button>
							@endif
						</div>
					@endif
				</article>
			</div>
			<div class="mt-40 col-12 md:col-6 xl:col-5" data-carousel
				data-aos="{{ isEven($block->data_type_index) ? 'fade-left' : 'fade-right' }}">
				<div class="relative w-full aspect-4/3">
					@foreach ($block->images as $image)
						<x-image :image="$image" format="article-with-media" data-carousel-item
							data-toggle-classes="invisible opacity-0" data-active="{{ $loop->first ? 'true' : 'false' }}"
							@class([
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
