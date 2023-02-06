@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-margin',
	]);
@endphp

@if ($planTypes->isNotEmpty())
	<section {{ $attributes }}>
		<div class="container">
			<div class="row">
				@if ($block->title)
					<div class="col-12">
						<x-heading :level="2" class="text-gray-dark mb-30">
							{{ $block->title }}
						</x-heading>
					</div>
				@endif
				<div class="col-12">
					<ul class="items-stretch pb-20 overflow-hidden flex-nowrap row" data-scroll-list="{{ $block->key() }}">
						@php
							$liClasses = 'col-12 lg:col-6 2xl:col-4';
						@endphp
						@foreach ($planTypes as $planType)
							<li class="{{ $liClasses }}" data-scroll-list-item>
								<a href="#"
									class="block h-full p-20 transition-all bg-white border rounded shadow border-gray betterhover:hover:shadow-lg">
									<x-heading :level="3" class="mb-10 text-primary">
										{{ $planType->name }}
									</x-heading>
									<ul>
										@foreach ($planType->plans as $plan)
											<li class="mb-10">
												<div class="flex items-center justify-between">
													<x-heading :level="4" class="mb-5 font-bold text-gray-dark">
														{{ $plan->name }}
													</x-heading>
													<strong class="ml-5 font-bold text-gray-dark">
														€ {{ $plan->total_price }}
													</strong>
												</div>
												<div class="tiptap tiptap-compact">
													{!! $plan->description !!}
												</div>
											</li>
										@endforeach
									</ul>
								</a>
							</li>
						@endforeach
						@if ($block->show_custom)
							<li class="{{ $liClasses }}" data-scroll-list-item>
								<a href="#"
									class="block h-full p-20 transition-all bg-white border rounded shadow border-gray betterhover:hover:shadow-lg">
									<x-heading :level="3" class="mb-10 text-primary">
										Plan op maat
									</x-heading>
									<div class="tiptap">
										<p>Bent u niet zeker welk plan het beste bij u past?</p>
										<p>Wil u een plan op maat voor uw organisatie/bedrijf?</p>
										<p class="font-bold underline text-primary">Neem contact op met Laura</p>
									</div>
								</a>
							</li>
						@endif
					</ul>
				</div>
				<div class="col-12 mt-30">
					<div class="items-center justify-between row">
						<div class="col-12 md:col-auto">
							@if ($block->note)
								<div class="tiptap tiptap-compact">
									{!! $block->note !!}
								</div>
							@endif
						</div>
						<div class="col-12 lg:col-auto mt-30 lg:mt-0">
							<div class="flex justify-end gap-20">
								<x-button theme="secondary" title="Scroll naar links" data-carousel-control="previous"
									data-scroll-list-control="{{ $block->key() }}" data-direction="left" data-disabled-class="opacity-20">
									<x-svg.arrow orientation="left" />
									<span class="sr-only">Scroll naar links</span>
								</x-button>
								<x-button theme="secondary" title="Scroll naar rechts" data-carousel-control="next"
									data-scroll-list-control="{{ $block->key() }}" data-direction="right" data-disabled-class="opacity-20">
									<x-svg.arrow orientation="right" />
									<span class="sr-only">Scroll naar rechts</span>
								</x-button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endif
