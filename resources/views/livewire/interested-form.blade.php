<div>
	@if ($isSubmitted)
		<div>
			<p class="font-bold text-center rfs:text-h4 mb-15 text-primary">
				Bedankt voor uw interesse!
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
				<x-form.checkbox key="hasBusiness" label="Ik heb een bedrijf." />
				<x-form.error key="hasBusiness" />
			</x-form.group>
			@if ($hasBusiness)
				<div class="row">
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessName" label="Bedrijfsnaam *" />
							<x-form.input id="businessName" type="text" wire:model="businessName" autocomplete="organization" />
							<x-form.error key="businessName" />
						</x-form.group>
					</div>
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessTaxNumber" label="Btw-nummer *" />
							<x-form.input id="businessTaxNumber" type="text" wire:model="businessTaxNumber" />
							<x-form.error key="businessTaxNumber" />
						</x-form.group>
					</div>
				</div>
				<div class="row">
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessStreet" label="Straat *" />
							<x-form.input id="businessStreet" type="text" wire:model="businessStreet" autocomplete="street-address" />
							<x-form.error key="businessStreet" />
						</x-form.group>
					</div>
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessStreetNumber" label="Huisnummer *" />
							<x-form.input id="businessStreetNumber" type="text" wire:model="businessStreetNumber"
								autocomplete="address-level3" />
							<x-form.error key="businessStreetNumber" />
						</x-form.group>
					</div>
				</div>
				<div class="row">
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessPostalCode" label="Postcode *" />
							<x-form.input id="businessPostalCode" type="text" wire:model="businessPostalCode"
								autocomplete="postal-code" />
							<x-form.error key="businessPostalCode" />
						</x-form.group>
					</div>
					<div class="col-12 md:col-6">
						<x-form.group>
							<x-form.label key="businessCity" label="Stad/Gemeente *" />
							<x-form.input id="businessCity" type="text" wire:model="businessCity" autocomplete="address-level2" />
							<x-form.error key="businessCity" />
						</x-form.group>
					</div>
				</div>
			@endif
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
