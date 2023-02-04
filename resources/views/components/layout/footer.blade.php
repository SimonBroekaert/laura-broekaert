<footer class="bg-black">
	<div class="container py-30">
		<div class="items-center justify-center md:justify-between row">
			<div class="col-auto text-center basis-full md:basis-auto">
				<a href="{{ route('home') }}" class="inline-block" aria-label="Logo - {{ $brandName }}">
					<x-svg.logo class="text-gray-light h-60" :on-dark-background=true />
					<span class="sr-only">{{ $brandName }}</span>
				</a>
			</div>
			<div class="col-auto basis-full md:basis-auto mt-30 md:mt-0">
				<ul class="flex items-center justify-center gap-30">
					@if ($email)
						<li>
							<a class="p-5 text-gray-light betterhover:hover:text-primary" href="mailto:{{ $email }}">
								<x-svg.email class="w-20 h-20 transition-all" />
								<span class="sr-only">E-mail</span>
							</a>
						</li>
					@endif
					@if ($phone)
						<li>
							<a class="p-5 text-gray-light betterhover:hover:text-primary" href="tel:{{ $phone }}">
								<x-svg.phone class="w-20 h-20 transition-all" />
								<span class="sr-only">Telefoon</span>
							</a>
						</li>
					@endif
					@foreach ($socials as $social => $url)
						<li>
							<a class="p-5 text-gray-light betterhover:hover:text-primary" href="{{ $url }}" target="_blank"
								rel="noopener noreferrer">
								<x-dynamic-component :component="'svg.' . $social" class="w-20 h-20 transition-all" />
								<span class="sr-only">{{ ucfirst($social) }}</span>
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="items-center justify-center md:justify-between row mt-30">
			<div class="order-2 col-auto basis-full md:basis-auto md:order-1 mt-30 md:mt-0">
				<p class="rfs:text-sm text-center text-gray-light">&copy; {{ now()->year }} {{ $brandName }}</p>
			</div>
			<div class="order-1 col-auto basis-full md:basis-auto md:order-2">
				<x-layout.navigation menu-key="main" :ul-attributes="[
				    'class' => 'text-center lg:flex lg:items-center gap-20 lg:justify-end',
				]" :li-attributes="[
				    'class' =>
				        'text-gray-light transition-all font-bold rfs:text-sm [&.is-active]:text-primary [&.is-active]:after:bg-primary relative after:absolute after:bottom-1 after:left-1/2 after:-translate-x-1/2 after:w-0 after:bg-gray-light after:h-2 betterhover:hover:after:w-4/5 after:transition-all after:origin-center mb-10 lg:mb-0',
				]" :a-attributes="[
				    'class' => 'block p-5',
				]" />
				<x-layout.navigation menu-key="legal" :ul-attributes="[
				    'class' => 'text-center lg:flex lg:items-center gap-20 lg:justify-end',
				]" :li-attributes="[
				    'class' =>
				        'text-gray-light transition-all font-bold rfs:text-sm [&.is-active]:text-primary [&.is-active]:after:bg-primary relative after:absolute after:bottom-1 after:left-1/2 after:-translate-x-1/2 after:w-0 after:bg-gray-light after:h-2 betterhover:hover:after:w-4/5 after:transition-all after:origin-center mb-10 lg:mb-0',
				]" :a-attributes="[
				    'class' => 'block p-5',
				]" />
			</div>
		</div>
	</div>
</footer>
