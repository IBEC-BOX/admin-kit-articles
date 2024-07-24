<?php

namespace AdminKit\Articles\UI\Filament\Resources;

use AdminKit\Articles\Models\Article;
use AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;
use AdminKit\Core\Forms\Components\TranslatableTabs;
use AdminKit\SEO\Forms\Components\SEOComponent;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        $rows = [];
        if (config('admin-kit-articles.image.enabled')) {
            $rows[] = Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                ->label(__('admin-kit-articles::articles.resource.image'))
                ->image()
                ->required()
                ->columnSpan(2)

                // image properties
                ->imageCropAspectRatio(config('admin-kit-articles.image.crop_aspect_ratio'))
                ->imageResizeTargetWidth(config('admin-kit-articles.image.resize_target_width'))
                ->imageResizeTargetHeight(config('admin-kit-articles.image.resize_target_height'))
                ->imagePreviewHeight(config('admin-kit-articles.image.preview_height'))

                // cropper
                ->imageEditor();
        }

        $rows[] = Forms\Components\Grid::make(1)
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->label(__('admin-kit-articles::articles.resource.slug'))
                    ->disabled(fn (Get $get) => ! $get('slug-editable'))
                    ->required()
                    ->unique(Article::class, 'slug', ignoreRecord: true)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('slug-edit')
                            ->icon(fn (Get $get) => $get('slug-editable') ? 'heroicon-o-lock-closed' : 'heroicon-s-pencil-square')
                            ->action(function (Set $set, Get $get) {
                                $set('slug-editable', ! $get('slug-editable'));
                            })),
                Forms\Components\Checkbox::make('slug-editable')
                    ->default(false)
                    ->hidden(),
            ]);

        $rows[] = TranslatableTabs::make(fn ($locale) => [
            Forms\Components\TextInput::make("title.$locale")
                ->label(__('admin-kit-articles::articles.resource.title'))
                ->required($locale === app()->getLocale())
                ->lazy()
                ->afterStateUpdated(
                    function (string $context, string $state, Set $set, Get $get) use ($locale) {
                        if ($context === 'create' && ! $get('slug-editable') && $locale === app()->getLocale()) {
                            $set('slug', Str::slug($state));
                        }
                    })
                ->columnSpan(2),

            Forms\Components\RichEditor::make("content.$locale")
                ->label(__('admin-kit-articles::articles.resource.content'))
                ->required($locale === app()->getLocale())
                ->columnSpan(2),

            Forms\Components\RichEditor::make("short_content.$locale")
                ->label(__('admin-kit-articles::articles.resource.short_content'))
                ->columnSpan(2),
        ])
            ->columnSpan(2)
            ->columns();

        $rows[] = Forms\Components\Section::make([
            Forms\Components\DateTimePicker::make('published_at')
                ->label(__('admin-kit-articles::articles.resource.published_date'))
                ->columnSpan(2),

            Forms\Components\Toggle::make('pinned')
                ->label(__('admin-kit-articles::articles.resource.pinned'))
                ->columnSpan(2),
        ]);

        if (config('admin-kit-articles.seo.enabled')) {
            $rows[] = SEOComponent::make();
        }

        return $form->schema($rows);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-articles::articles.resource.id'))
                    ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('admin-kit-articles::articles.resource.image'))
                    ->height(90)
                    ->width(160)
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin-kit-articles::articles.resource.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('admin-kit-articles::articles.resource.published_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin-kit-articles::articles.resource.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
