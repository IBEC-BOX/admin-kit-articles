<?php

namespace AdminKit\Articles\Models;

use AdminKit\Articles\Database\Factories\ArticleFactory;
use AdminKit\Core\Abstracts\Models\AbstractModel;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string $short_content
 * @property bool $pinned
 * @property Carbon|null $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Article extends AbstractModel implements HasMedia
{
    use HasFactory, SoftDeletes;
    use HasTranslations;
    use InteractsWithMedia;
    use Sluggable;

    protected $table = 'admin_kit_articles';

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'slug',
        'pinned',
        'published_at',
    ];

    protected $translatable = [
        'title',
        'content',
        'short_content',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(160)
            ->height(90)
            ->sharpen(10);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeIsTitleNotNull(Builder $query): Builder
    {
        return $query->whereNotNull('title->'.app()->getLocale());
    }

    public function scopeTitle(Builder $query, $search): Builder
    {
        return $query->where('title->'.app()->getLocale(), 'ILIKE', "%$search%");
    }

    public function scopeContent(Builder $query, $search): Builder
    {
        return $query->where('content->'.app()->getLocale(), 'ILIKE', "%$search%");
    }

    public function scopeShortContent(Builder $query, $search): Builder
    {
        return $query->where('short_content->'.app()->getLocale(), 'ILIKE', "%$search%");
    }

    protected static function newFactory(): ArticleFactory
    {
        return new ArticleFactory();
    }
}
