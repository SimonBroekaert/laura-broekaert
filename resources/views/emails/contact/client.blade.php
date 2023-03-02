<x-mail::message>

# Bedankt voor uw bericht.

Beste {{ $entry->full_name }},

Wij hebben uw bericht ontvangen en zullen zo spoedig mogelijk contact met u opnemen.

Indien u verdere vragen heeft, aarzel dan niet om ons te contacteren.

## <u>Details van uw bericht:</u>

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

@include('emails.regards')
</x-mail::message>
