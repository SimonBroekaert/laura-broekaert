<x-mail::message>

# Bedankt voor uw interesse.

Beste {{ $client->full_name }},

Wij zijn blij dat u interesse hebt in onze diensten! We zullen zo spoedig mogelijk contact met u opnemen.

Indien u verdere vragen heeft, aarzel dan niet om ons te contacteren.

## <u>Uw details:</u>

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

@include('emails.regards')
</x-mail::message>
