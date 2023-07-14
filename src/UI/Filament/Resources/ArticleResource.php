<?php

namespace AdminKit\Articles\UI\Filament\Resources;

use AdminKit\Articles\Models\Article;
use AdminKit\Articles\UI\Filament\Resources\ArticleResource\Pages;
use AdminKit\Core\Forms\Components\AdminKitCropper;
use AdminKit\Core\Forms\Components\TranslatableTabs;
use AdminKit\SEO\Forms\Components\SEOComponent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $rows = [];
        if (config('admin-kit-articles.image.enabled')) {
            $rows[] = AdminKitCropper::make('image')
                ->label(__('admin-kit-articles::articles.resource.image'))
                ->image()
                ->required()
                ->columnSpan(2)

                // image properties
                ->imageCropAspectRatio(config('admin-kit-articles.image.crop_aspect_ratio'))
                ->imageResizeTargetWidth(config('admin-kit-articles.image.resize_target_width'))
                ->imageResizeTargetHeight(config('admin-kit-articles.image.resize_target_height'))
                ->imagePreviewHeight(config('admin-kit-articles.image.preview_height'))

                // cropper properties
                ->modalHeading(__('admin-kit-articles::articles.resource.cropper_header'))
                ->modalSize('2xl')
                ->zoomable(false);
        }

        $rows[] = TranslatableTabs::make(fn ($locale) => Forms\Components\Tabs\Tab::make($locale)
            ->schema([
                Forms\Components\TextInput::make("title.$locale")
                    ->label(__('admin-kit-articles::articles.resource.title'))
                    ->required($locale === app()->getLocale())
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

                Forms\Components\RichEditor::make("content.$locale")
                    ->label(__('admin-kit-articles::articles.resource.content'))
                    ->required($locale === app()->getLocale())
                    ->columnSpan(2),

                Forms\Components\RichEditor::make("short_content.$locale")
                    ->label(__('admin-kit-articles::articles.resource.short_content'))
                    ->columnSpan(2),
            ]))->columnSpan(2)->columns();

        $rows[] = Forms\Components\Card::make([
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
