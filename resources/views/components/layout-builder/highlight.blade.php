@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-padding',
	]);
@endphp

<section {{ $attributes }}>
	<div class="bg-gray absolute inset-0 object-cover w-full h-full -z-1">
		<x-image :image="$block->image" format="highlight" class="absolute inset-0 w-full h-full -z-1" />
	</div>
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8">
				<article class="rounded lg:p-100 md:p-65 p-50 bg-black/80" data-aos="fade-up">
					@if ($block->title)
						<x-heading :level="2" class="text-primary mb-30">
							{{ $block->title }}
						</x-heading>
					@endif
					<div class="tiptap tiptap-with-background">
						{!! $block->body !!}
					</div>
					@if ($block->first_button || $block->second_button)
						<div class="flex flex-wrap items-center justify-center gap-20 sm:justify-start mt-30">
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
		</div>
	</div>
</section>
