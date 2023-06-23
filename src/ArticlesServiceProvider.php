<?php

namespace AdminKit\Articles;

use AdminKit\Articles\Commands\ArticlesCommand;
use Spatie\LaravelPackageTools\Package;
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
            ->hasMigration('create_admin-kit-articles_table')
            ->hasCommand(ArticlesCommand::class);
    }
}
