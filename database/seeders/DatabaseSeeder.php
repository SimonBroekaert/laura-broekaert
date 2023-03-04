<?php

namespace Database\Seeders;

use App\Enums\PredefinedMenu;
use App\Enums\PredefinedPage;
use App\Models\Client;
use App\Models\ClientBusiness;
use App\Models\ContactFormEntry;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Plan;
use App\Models\PredefinedPlan;
use App\Models\User;
use App\Nova\Flexible\Presets\DefaultPreset;
use App\Nova\Flexible\Presets\HomePreset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create developer user
        $simon = User::factory()
            ->developer()
            ->create([
                'name' => 'Simon Broekaert',
                'email' => 'info@simonbroekaert.be',
            ]);

        // Create admin user
        $laura = User::factory()
            ->admin()
            ->create([
                'name' => 'Laura Broekaert',
                'email' => 'laurabroekaert@gmail.com',
            ]);

        // Create Predefined Plans
        $predefinedPlans = PredefinedPlan::factory()
            ->count(5)
            ->create();

        // Create Pages from Predefined pages
        $predefinedPages = collect(PredefinedPage::values())
            ->map(function ($case) {
                return Page::factory()
                    ->create([
                        'title' => Str::headline($case),
                        'slug' => Str::slug($case),
                        'developer_id' => $case,
                        'body' => $case === 'home' ? HomePreset::fake() : DefaultPreset::fake(),
                    ]);
            });

        // Create Menu's from Predefined menus
        $predefinedMenus = collect(PredefinedMenu::values())
            ->map(function ($case) {
                return Menu::factory()
                    ->hasItems(random_int(1, 5))
                    ->create([
                        'name' => Str::headline($case),
                        'developer_id' => $case,
                    ]);
            });

        // Create Contact Form Entries
        $contactFormEntries = ContactFormEntry::factory()
            ->count(10)
            ->create();

        // Create Clients
        $clients = Client::factory()
            ->hasPlans(1)
            ->count((10))
            ->create();

        // Link some Clients to Client Businesses
        $clients->shuffle()->take(2)->each(function (Client $client) {
            $client->client_business_id = ClientBusiness::factory()->create()->id;
            $client->save();
        });

        // Link some Clients to Predefined Plans
        $clients->shuffle()->take(count($clients) / 3 * 2)->each(function (Client $client) use ($predefinedPlans) {
            $client->predefined_plan_id = $predefinedPlans->random()->id;
            $client->save();
        });

        // Add clients to plans with more than 1 client
        Plan::get()->each(function (Plan $plan) {
            $planClientCount = $plan->clients()->count();
            $planMaxClients = $plan->amount_of_persons;

            $clientsToAdd = max(0, $planMaxClients - $planClientCount);

            if ($clientsToAdd === 0) {
                return;
            }

            $plan->clients()->saveMany(Client::factory()->count($clientsToAdd)->create());
        });
    }
}
