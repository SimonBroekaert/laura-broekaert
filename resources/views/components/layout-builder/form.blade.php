@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-margin',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="row">
			@if ($block->title)
				<div class="col-12">
					<x-heading :level="2" class="text-gray-dark">
						{{ $block->title }}
					</x-heading>
				</div>
			@endif
			@if ($block->intro)
				<div class="col-12 mt-30">
					<div class="tiptap">
						{!! $block->intro !!}
					</div>
				</div>
			@endif
		</div>
		<div class="justify-center row mt-50">
			<div class="col-12 md:col-10 xl:col-8">
				@switch($block->form)
					@case(\App\Enums\PredefinedForm::FORM_CONTACT->value)
						<livewire:contact-form />
					@break

					@case(\App\Enums\PredefinedForm::FORM_INTERESTED->value)
						<livewire:interested-form />
					@break
				@endswitch
			</div>
		</div>
	</div>
</section>
