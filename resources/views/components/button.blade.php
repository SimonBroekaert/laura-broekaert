@props(['theme' => 'primary'])

@php
	$element = 'button';
	if ($attributes->has('href')) {
	    $element = 'a';
	}
	$themeClasses = match ($theme) {
	    'primary' => 'after:border-primary betterhover:hover:after:border-primary-dark',
	    'secondary' => 'after:border-gray-dark betterhover:hover:after:border-black',
	};
	$themeClassesSpan = match ($theme) {
	    'primary' => 'text-black bg-primary betterhover:group-hover/button:bg-primary-dark',
	    'secondary' => 'text-white bg-gray-dark betterhover:group-hover/button:bg-black',
	};
	$attributes = $attributes->merge([
	    'class' => "{$themeClasses} relative block transition-all cursor-pointer select-none group/button after:-z-10 after:absolute after:top-10 after:left-10 after:border after:border-2 after:rounded after:w-full after:h-full",
	]);
	$attributesSpan = (new \Illuminate\View\ComponentAttributeBag([]))->merge([
	    'class' => "{$themeClassesSpan} block py-10 font-bold text-center transition-all rounded rfs:text-lg px-30 betterhover:group-hover/button:translate-x-5 betterhover:group-hover/button:translate-y-5",
	]);
@endphp

<{{ $element }} {{ $attributes }}>
	<span {{ $attributesSpan }}>
		{{ $slot }}
	</span>
	</{{ $element }}>
