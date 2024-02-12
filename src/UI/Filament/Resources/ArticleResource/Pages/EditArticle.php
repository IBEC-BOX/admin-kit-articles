<?php

namespace AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return ArticleResource::getUrl();
    }
}
