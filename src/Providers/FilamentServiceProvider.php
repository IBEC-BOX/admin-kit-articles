<?php

declare(strict_types=1);

namespace AdminKit\Articles\Providers;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\PluginServiceProvider;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'article';

    protected array $resources = [
        ArticleResource::class,
    ];
}
