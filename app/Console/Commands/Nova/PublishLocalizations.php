<?php

namespace App\Console\Commands\Nova;

use Illuminate\Console\Command;

class PublishLocalizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-nova:publish-localizations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the localizations for Nova.';

    /**
     * The locales that should be published.
     *
     * @var array
     */
    protected $locales = [
        'en',
        'nl',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Create the lang/vendor/nova directory if it doesn't exist.
        if (! is_dir('./lang/vendor/nova')) {
            mkdir('./lang/vendor/nova', 0776, true);
        }

        foreach ($this->locales as $locale) {
            // Copy the json translation file.
            copy('https://raw.githubusercontent.com/franzdumfart/laravel-nova-localizations/master/lang/' . $locale . '.json', './lang/vendor/nova/' . $locale . '.json');
            // Create the lang/vendor/nova+{$locale} directory if it doesn't exist.
            if (! is_dir('./lang/vendor/nova/' . $locale)) {
                mkdir('./lang/vendor/nova/' . $locale, 0776, true);
            }
            // Copy the validation translation file.
            copy('https://raw.githubusercontent.com/franzdumfart/laravel-nova-localizations/master/lang/' . $locale . '/validation.php', './lang/vendor/nova/' . $locale . '/validation.php');
        }

        return Command::SUCCESS;
    }
}
