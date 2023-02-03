@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'relative lg:my-100 md:my-85 my-75',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="items-center justify-between row">
			<article class="col-12 md:col-6 xl:col-5 mb-gap md:mb-0">
				<x-heading :level="2" :style-level="1" class="text-gray-dark" data-aos="fade">
					{{ $block->title }}
				</x-heading>
				@if ($block->first_button || $block->second_button)
					<div class="flex gap-20 mt-30" data-aos="fade">
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
			<div class="mt-40 col-12 md:col-6 md:mt-0">
				<div class="row">
					<div class="order-1 col-6 sm:col-4 md:col-6 xl:col-4">
						<div class="mb-20 overflow-hidden transition-all rounded shadow select-none betterhover:hover:shadow-lg bg-gray"
							data-aos="zoom-in" data-aos-delay="200">
							<x-image :image="$block->images->first()" format="home-hero-portrait" class="aspect-3/4 md:aspect-9/16" />
						</div>
						<div class="overflow-hidden transition-all rounded shadow select-none betterhover:hover:shadow-lg bg-gray"
							data-aos="zoom-in" data-aos-delay="400">
							<x-image :image="$block->images->skip(1)->first()" format="home-hero-landscape" class="aspect-4/3 md:aspect-16/9" />
						</div>
					</div>
					<div
						class="order-3 hidden sm:block md:hidden xl:block col-12 sm:col-4 md:col-6 xl:col-4 sm:order-2 md:order-3 xl:order-2 mt-90">
						<div class="overflow-hidden transition-all rounded shadow select-none betterhover:hover:shadow-lg bg-gray"
							data-aos="zoom-in" data-aos-delay="600">
							<x-image :image="$block->images->skip(2)->first()" format="home-hero-portrait" class="aspect-3/4 md:aspect-9/16" />
						</div>
					</div>
					<div class="order-2 mt-40 col-6 sm:col-4 md:col-6 xl:col-4 sm:order-3 md:order-2 xl:order-3">
						<div class="mb-20 overflow-hidden transition-all rounded shadow select-none betterhover:hover:shadow-lg bg-gray"
							data-aos="zoom-in" data-aos-delay="800">
							<x-image :image="$block->images->skip(3)->first()" format="home-hero-landscape" class="aspect-4/3 md:aspect-16/9" />
						</div>
						<div class="overflow-hidden transition-all rounded shadow select-none betterhover:hover:shadow-lg bg-gray"
							data-aos="zoom-in" data-aos-delay="1000">
							<x-image :image="$block->images->skip(4)->first()" format="home-hero-portrait" class="aspect-3/4 md:aspect-9/16" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
