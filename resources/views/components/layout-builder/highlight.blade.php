@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative lg:py-100 md:py-85 py-75',
	]);
@endphp

<section {{ $attributes }}>
	<x-image :image="$block->image" format="highlight" class="absolute inset-0 w-full h-full -z-10" />
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8">
				<article class="rounded lg:p-100 md:p-65 p-50 bg-black/80">
					@if ($block->title)
						<x-heading :level="2" class="text-primary mb-30">
							{{ $block->title }}
						</x-heading>
					@endif
					<div class="tiptap tiptap-with-background">
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
		</div>
	</div>
</section>
