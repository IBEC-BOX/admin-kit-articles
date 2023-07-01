<?php

namespace AdminKit\Articles\UI\Filament\Resources;

use AdminKit\Articles\Models\Article;
use AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $imageComponent = [];
        if (config('admin-kit-articles.image.enabled')) {
            $imageComponent[] = Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                ->label(__('admin-kit-articles::articles.resource.image'))
                ->image()
                ->required()
                ->imageResizeMode(config('admin-kit-articles.image.resize_mode'))
                ->imageCropAspectRatio(config('admin-kit-articles.image.crop_aspect_ratio'))
                ->imageResizeTargetWidth(config('admin-kit-articles.image.resize_target_width'))
                ->imageResizeTargetHeight(config('admin-kit-articles.image.resize_target_height'))
                ->imagePreviewHeight(config('admin-kit-articles.image.preview_height'))
                ->columnSpan(2);
        }

        return $form->schema(
            array_merge($imageComponent, [
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('title')
                        ->label(__('admin-kit-articles::articles.resource.title'))
                        ->required()
                        ->lazy()
                        ->afterStateUpdated(
                            function (string $context, $state, callable $set) {
                                if ($context === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->label(__('admin-kit-articles::articles.resource.slug'))
                        ->disabled()
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    Forms\Components\RichEditor::make('content')
                        ->label(__('admin-kit-articles::articles.resource.content'))
                        ->required()
                        ->columnSpan(2),
                ])->columns(),

                Forms\Components\Section::make(__('admin-kit-articles::articles.resource.properties'))
                    ->schema([
                        Forms\Components\RichEditor::make('short_content')->columnSpan(16)
                            ->label(__('admin-kit-articles::articles.resource.short_content')),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label(__('admin-kit-articles::articles.resource.published_date')),

                        Forms\Components\Toggle::make('pinned')
                            ->label(__('admin-kit-articles::articles.resource.pinned')),
                    ])
                    ->collapsible(),
            ])
        )->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-articles::articles.resource.id')),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('admin-kit-articles::articles.resource.image'))
                    ->height(90)
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin-kit-articles::articles.resource.title')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin-kit-articles::articles.resource.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin-kit-articles::articles.resource.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin-kit-articles::articles.resource.plural_label');
    }

    public static function getTranslatableLocales(): array
    {
        return config('admin-kit.locales');
    }
}
