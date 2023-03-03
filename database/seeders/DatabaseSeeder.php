<?php

namespace Database\Seeders;

use App\Enums\PredefinedMenu;
use App\Enums\PredefinedPage;
use App\Models\ClientBusiness;
use App\Models\Menu;
use App\Models\Page;
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

        // Create Client Businesses
        ClientBusiness::factory()
            ->count(5)
            ->create();
    }
}
