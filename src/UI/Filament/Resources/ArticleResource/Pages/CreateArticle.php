<?php

namespace AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return ArticleResource::getUrl();
    }
}
