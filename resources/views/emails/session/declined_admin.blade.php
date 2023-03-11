<x-mail::message>

# {{ $client->full_name }} heeft een ingeplande sessie geannuleerd.

## <u>Details van de sessie:</u>

<x-mail::panel>
### Was ingepland op:
{{ formatDateTime($session->datetime) }}

### Met volgende klanten:
@foreach($session->plan->clients as $client)
- {{ $client->full_name }}
@endforeach
</x-mail::panel>

<x-mail::button :url="$url" target="_blank">
Bekijk in het CMS
</x-mail::button>

@include('emails.regards')
</x-mail::message>
