@props(['block'])

@php
	$attributes = $attributes->merge([
	    'class' => 'layout-block layout-block-margin',
	]);
@endphp

<section {{ $attributes }}>
	<div class="container">
		<div class="justify-center row">
			<div class="col-12 lg:col-10 xl:col-8">
				<div class="w-full h-full overflow-hidden transition-all rounded shadow select-none bg-gray" data-aos="zoom-out">
					<iframe class="w-full h-full aspect-16/9" src="https://www.youtube.com/embed/{{ $block->video_id }}" frameborder="0"
						width="640" height="360"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
						title="https://www.youtube.com/embed/{{ $block->video_id }}">
					</iframe>
				</div>
			</div>
		</div>
	</div>
</section>
