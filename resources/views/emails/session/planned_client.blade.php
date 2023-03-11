<x-mail::message>

# Laura heeft een nieuwe sessie ingepland.

Beste {{ $client->full_name }},

Laura heeft een nieuwe sessie met {{ $session->plan->clients()->count() > 1 ? 'jullie' : 'u' }} ingepland.

Indien deze sessie niet past voor u, kan u deze tot 48u voor de sessie annuleren.
Dit kan door op onderstaande knop te klikken.

@if ($session->plan->clients()->count() > 1)
**Let op:** indien u deze sessie annuleert, annulleert u deze ook voor de andere personen in deze sessie.
@endif

<x-mail::button :url="$url" target="_blank">
Sessie annuleren
</x-mail::button>

Indien u verdere vragen heeft, aarzel dan niet om ons te contacteren.

## <u>Details van de sessie:</u>

<x-mail::panel>
### Ingepland op
{{ formatDateTime($session->datetime) }}

### Met volgende personen:
@foreach($session->plan->clients as $client)
- {{ $client->full_name }}
@endforeach
</x-mail::panel>

@include('emails.regards')
</x-mail::message>
