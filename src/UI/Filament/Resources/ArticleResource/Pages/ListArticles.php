<?php

namespace AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
