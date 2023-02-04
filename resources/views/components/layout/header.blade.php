<header class="fixed top-0 left-0 z-50 w-screen header-gradient">
	<div class="container-fluid xl:container">
		<div class="items-center justify-between py-20 row">
			<div class="col-auto">
				<h1>
					<a href="{{ route('home') }}" class="" aria-label="Logo - {{ $brandName }}">
						<x-svg.logo class="h-45 lg:h-60 text-gray-dark" />
					</a>
					<span class="sr-only">{{ $brandName }}</span>
				</h1>
			</div>
			<div class="flex items-center col-auto">
				<div class="menu-backdrop" data-menu-toggle></div>
				<div class="menu custom-scrollbar">
					<x-layout.navigation menu-key="main" :ul-attributes="[
					    'class' => 'text-center lg:flex lg:items-center gap-20',
					]" :li-attributes="[
					    'class' =>
					        'text-gray-dark transition-all font-bold text-lg [&.is-active]:text-primary relative after:absolute after:bottom-1 after:left-1/2 after:-translate-x-1/2 after:w-0 after:bg-primary after:h-2 betterhover:hover:after:w-4/5 after:transition-all after:origin-center mb-10 lg:mb-0',
					]" :a-attributes="[
					    'class' => 'p-5',
					]" />
					@if ($contactPage)
						<x-button theme="primary" href="{{ $contactPage->url }}" class="mb-10 lg:mb-0 lg:mr-20 xl:mr-0">
							Interesse
						</x-button>
					@endif
					<x-layout.navigation menu-key="legal" class="block lg:hidden" :ul-attributes="[
					    'class' => 'text-center lg:flex lg:items-center gap-20',
					]" :li-attributes="[
					    'class' =>
					        'text-gray-dark transition-all font-bold text-lg [&.is-active]:text-primary relative after:absolute after:bottom-1 after:left-1/2 after:-translate-x-1/2 after:w-0 after:bg-primary after:h-2 betterhover:hover:after:w-4/5 after:transition-all after:origin-center mb-10 lg:mb-0',
					]"
						:a-attributes="[
						    'class' => 'p-5',
						]" />
				</div>
				<button class="p-10 transition-all rounded-sm lg:hidden bg-white/0 betterhover:hover:bg-gray-light"
					data-menu-toggle>
					<x-svg.hamburger class="w-30 h-30 text-gray-dark" />
				</button>
			</div>
		</div>
	</div>
</header>
