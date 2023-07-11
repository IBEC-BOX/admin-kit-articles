<?php

namespace AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Articles\UI\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
