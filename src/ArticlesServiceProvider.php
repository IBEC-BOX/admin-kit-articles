<?php

namespace AdminKit\Articles;

use Spatie\LaravelPackageTools\Package;
use AdminKit\Articles\Commands\ArticlesCommand;
use AdminKit\Articles\Providers\RouteServiceProvider;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ArticlesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('admin-kit-articles')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_admin_kit_articles_table')
            ->hasTranslations()
            ->hasCommand(ArticlesCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
