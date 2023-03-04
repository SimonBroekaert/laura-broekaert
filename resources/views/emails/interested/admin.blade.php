<x-mail::message>

# Nieuw persoon met ineteresse.

**{{ $client->full_name }}** heeft interesse getoond via het formulier.

## <u>Details van de persoon:</u>

<x-mail::panel>
### Voornaam
{{ $client->first_name }}

### Achternaam
{{ $client->last_name }}

### E-mail
{{ $client->email }}

### Telefoon
@if ($client->phone) {{ $client->phone }} @else / @endif

### Bedrijf
@if ($client->has_business)
{{ $client->business->name }}
@else
*Geen bedrijf*
@endif
@if ($client->has_business)
### Btw-nummer
{{ $client->business->tax_number }}

### Adres
{{ $client->business->address->full }}
@endif
</x-mail::panel>

<x-mail::button :url="$url" target="_blank">
Bekijk in het CMS
</x-mail::button>

@include('emails.regards')
</x-mail::message>
