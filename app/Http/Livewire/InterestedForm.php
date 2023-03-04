<?php

namespace App\Http\Livewire;

use App\Enums\ClientStatus;
use App\Enums\PredefinedPage;
use App\Jobs\SendInterestedAdminMail;
use App\Jobs\SendInterestedClientMail;
use App\Models\Client;
use App\Models\ClientBusiness;
use App\Models\Page;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class InterestedForm extends Component
{
    use UsesSpamProtection;

    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $hasBusiness = false;
    public $businessName;
    public $businessTaxNumber;
    public $businessStreet;
    public $businessStreetNumber;
    public $businessPostalCode;
    public $businessCity;
    public $gdprConsent;

    public $isSubmitted = false;
    public HoneypotData $extraFields;
    public Page|null $privacyPage;
    public ?ClientBusiness $clientBusiness = null;
    public ?Client $client = null;

    public function mount()
    {
        $this->extraFields = new HoneypotData();
        $this->privacyPage = Page::where('developer_id', PredefinedPage::PAGE_PRIVACY)
            ->first();
    }

    public function submit()
    {
        $this->protectAgainstSpam();

        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable',
            'hasBusiness' => 'nullable',
            'businessName' => 'required_if:hasBusiness,true',
            'businessTaxNumber' => 'required_if:hasBusiness,true',
            'businessStreet' => 'required_if:hasBusiness,true',
            'businessStreetNumber' => 'required_if:hasBusiness,true',
            'businessPostalCode' => 'required_if:hasBusiness,true',
            'businessCity' => 'required_if:hasBusiness,true',
            'gdprConsent' => 'required|accepted',
        ], [
            'firstName.required' => 'Vul je voornaam in',
            'lastName.required' => 'Vul je achternaam in',
            'email.required' => 'Vul je e-mailadres in',
            'email.email' => 'Vul een geldig e-mailadres in',
            'email.unique' => 'U heeft reeds interesse getoond, gelieve ons via e-mail of telefoon te contacteren',
            'businessName.required_if' => 'Vul de naam van je bedrijf in',
            'businessTaxNumber.required_if' => 'Vul je BTW-nummer in',
            'businessStreet.required_if' => 'Vul de straatnaam van je bedrijf in',
            'businessStreetNumber.required_if' => 'Vul het huisnummer van je bedrijf in',
            'businessPostalCode.required_if' => 'Vul de postcode van je bedrijf in',
            'businessCity.required_if' => 'Vul de stad van je bedrijf in',
            'gdprConsent.required' => 'Je moet akkoord gaan met de privacyverklaring',
        ]);

        $this->save();

        // Send mails
        SendInterestedAdminMail::dispatch($this->client);
        SendInterestedClientMail::dispatch($this->client);

        // Mark the form as submitted
        $this->isSubmitted = true;
    }

    public function save()
    {
        if ($this->hasBusiness) {
            $this->clientBusiness = ClientBusiness::create([
                'name' => $this->businessName,
                'tax_number' => $this->businessTaxNumber,
                'street' => $this->businessStreet,
                'street_number' => $this->businessStreetNumber,
                'postal_code' => $this->businessPostalCode,
                'city' => $this->businessCity,
            ]);
        }

        $this->client = Client::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'business_id' => $this->clientBusiness?->id,
            'status' => ClientStatus::STATUS_INTERESTED,
        ]);
    }

    public function render()
    {
        return view('livewire.interested-form');
    }
}
