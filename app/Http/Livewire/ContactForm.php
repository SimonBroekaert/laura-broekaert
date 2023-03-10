<?php

namespace App\Http\Livewire;

use App\Enums\PredefinedPage;
use App\Jobs\SendContactAdminMail;
use App\Jobs\SendContactClientMail;
use App\Models\ContactFormEntry;
use App\Models\Page;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class ContactForm extends Component
{
    use UsesSpamProtection;

    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $gdprConsent;

    public $isSubmitted = false;
    public HoneypotData $extraFields;
    public Page|null $privacyPage;
    public ?ContactFormEntry $entry = null;

    public function mount()
    {
        $this->extraFields = new HoneypotData();
        $this->privacyPage = Page::online()
            ->where('developer_id', PredefinedPage::PAGE_PRIVACY)
            ->first();
        $this->subject = request()->get('subject');
    }

    public function submit()
    {
        $this->protectAgainstSpam();

        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'subject' => 'required',
            'message' => 'required',
            'gdprConsent' => 'required|accepted',
        ], [
            'firstName.required' => 'Vul je voornaam in',
            'lastName.required' => 'Vul je achternaam in',
            'email.required' => 'Vul je e-mailadres in',
            'email.email' => 'Vul een geldig e-mailadres in',
            'subject.required' => 'Onderwerp is verplicht in te vullen',
            'message.required' => 'Bericht is verplicht in te vullen',
            'gdprConsent.required' => 'Je moet akkoord gaan met de privacyverklaring',
        ]);

        $this->save();

        // Send mails
        SendContactAdminMail::dispatch($this->entry);
        SendContactClientMail::dispatch($this->entry);

        // Mark the form as submitted
        $this->isSubmitted = true;
    }

    public function save()
    {
        $this->entry = ContactFormEntry::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
