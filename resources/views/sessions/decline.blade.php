<x-layout title="Sessie annuleren">
	<section class="absolute inset-0 flex items-center w-full h-full">
		<div class="container">
			<div class="justify-center row">
				<div class="col-12 md:col-10 xl:col-8">
					@if ($session && $plan && $client)
						<x-heading :level="2" class="text-gray-dark mb-30">
							U heeft de sessie van {{ formatDateTime($session->datetime) }} geannuleerd.
						</x-heading>
						<div class="tiptap">
							<p>Laura werd bij deze ook op de hoogte gebracht en zal trachten een nieuwe sessie in te plannen.</p>
							<p>
								Indien u nog vragen heeft, neem dan contact op met Laura.
							</p>
						</div>
					@else
						<x-heading :level="2" class="text-gray-dark mb-30">
							Deze link is niet meer geldig.
						</x-heading>
						<div class="tiptap">
							<p>
								Dit door één van volgende redenen:
							</p>
							<ul>
								<li>De sessie is reeds geannuleerd.</li>
								<li>De sessie is reeds verlopen.</li>
								<li>U hoort deze pagina niet te zien.</li>
							</ul>
							<p>
								Indien u denkt dat dit een fout is, neem dan contact op met Laura.
							</p>
						</div>
					@endif
					@if ($email || $phone)
						<div class="flex items-center justify-end gap-20 mt-40">
							@if ($email)
								<x-button :href="route('contact')" theme="primary">
									Mail
								</x-button>
							@endif
							@if ($phone)
								<x-button :href="route('contact')" theme="primary">
									Telefoon
								</x-button>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>
</x-layout>
