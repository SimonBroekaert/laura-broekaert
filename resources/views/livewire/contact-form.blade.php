<div>
	@if ($isSubmitted)
		<div>
			<p class="font-bold text-center rfs:text-h4 mb-15 text-primary">
				Bedankt voor uw bericht!
			</p>
			<p class="text-center rfs:text-base">
				We nemen zo spoedig mogelijk contact met u op.
			</p>
		</div>
	@else
		<x-form wire:submit.prevent="submit">
			<div class="row">
				<div class="col-12 md:col-6">
					<x-form.group>
						<x-form.label key="firstName" label="Voornaam *" />
						<x-form.input id="firstName" type="text" wire:model="firstName" autocomplete="given-name" />
						<x-form.error key="firstName" />
					</x-form.group>
				</div>
				<div class="col-12 md:col-6">
					<x-form.group>
						<x-form.label key="lastName" label="Achternaam *" />
						<x-form.input id="lastName" type="text" wire:model="lastName" autocomplete="family-name" />
						<x-form.error key="lastName" />
					</x-form.group>
				</div>
			</div>
			<div class="row">
				<div class="col-12 md:col-6">
					<x-form.group>
						<x-form.label key="email" label="E-mail *" />
						<x-form.input id="email" type="email" wire:model="email" autocomplete="email" />
						<x-form.error key="email" />
					</x-form.group>
				</div>
				<div class="col-12 md:col-6">
					<x-form.group>
						<x-form.label key="phone" label="Telefoon" />
						<x-form.input id="phone" type="phone" wire:model="phone" autocomplete="tel" />
						<x-form.error key="phone" />
					</x-form.group>
				</div>
			</div>
			<x-form.group>
				<x-form.label key="subject" label="Onderwerp *" />
				<x-form.input id="subject" type="text" wire:model="subject" autocomplete="off" />
				<x-form.error key="subject" />
			</x-form.group>
			<x-form.group>
				<x-form.label key="message" label="Bericht *" />
				<x-form.textarea id="message" wire:model="message" autocomplete="off" />
				<x-form.error key="message" />
			</x-form.group>
			<x-form.group>
				<x-form.gdpr key="gdprConsent" :privacy-page="$privacyPage" />
				<x-form.error key="gdprConsent" />
			</x-form.group>
			<x-form.group class="flex items-center justify-end gap-gap">
				<x-form.button type="submit" label="Verzenden" />
			</x-form.group>
		</x-form>
	@endif
</div>
