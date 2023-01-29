@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative lg:my-100 md:my-85 my-75',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8">
				<article>
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
		</div>
	</div>
</section>
