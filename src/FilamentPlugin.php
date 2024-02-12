<?php

namespace AdminKit\Articles;

use Filament\Panel;
use Filament\Contracts\Plugin;
use AdminKit\Articles\UI\Filament\Resources\ArticleResource;

class FilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-plugin-admin-kit-articles';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            ArticleResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
