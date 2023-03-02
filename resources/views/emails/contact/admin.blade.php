<x-mail::message>

# Nieuw bericht vanop het contact formulier.

**{{ $entry->full_name }}** heeft een bericht gestuurd via het contact formulier.

## <u>Details van het bericht:</u>

<x-mail::panel>
### Voornaam
{{ $entry->first_name }}

### Achternaam
{{ $entry->last_name }}

### E-mail
{{ $entry->email }}

### Telefoon
@if ($entry->phone) {{ $entry->phone }} @else / @endif

### Onderwerp
{{ $entry->subject }}

### Bericht
{{ $entry->message }}
</x-mail::panel>

<x-mail::button :url="$url" target="_blank">
Bekijk in het CMS
</x-mail::button>

@include('emails.regards')
</x-mail::message>
