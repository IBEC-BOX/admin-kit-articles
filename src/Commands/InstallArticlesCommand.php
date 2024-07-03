<?php

namespace AdminKit\Articles\Commands;

use AdminKit\Articles\ArticlesServiceProvider;
use AdminKit\SEO\SEOServiceProvider;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

class InstallArticlesCommand extends Command
{
    public $signature = 'admin-kit:install-articles';

    public $description = 'Install AdminKit Articles package';

    public function handle(): int
    {
        if ($this->confirm('Publishing migrations?', true)) {
            $this->call('vendor:publish', [
                '--provider' => MediaLibraryServiceProvider::class,
                '--tag' => 'medialibrary-migrations',
            ]);
            $this->call('vendor:publish', [
                '--provider' => ArticlesServiceProvider::class,
                '--tag' => 'admin-kit-articles-migrations',
            ]);
            $this->call('vendor:publish', [
                '--provider' => SEOServiceProvider::class,
                '--tag' => 'admin-kit-seo-migrations',
            ]);
        }

        if ($this->confirm('Migrate the database tables?', true)) {
            $this->call('migrate');
        }

        return self::SUCCESS;
    }
}
