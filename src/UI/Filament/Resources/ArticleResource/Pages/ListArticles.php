<?php

namespace AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
