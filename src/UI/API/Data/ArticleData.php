<?php

declare(strict_types=1);

namespace AdminKit\Articles\UI\API\Data;

use AdminKit\Articles\Models\Article;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ArticleData extends Data
{
    public function __construct(
        public Lazy|int $id,
        public Lazy|string $slug,
        public Lazy|string $title,
        public Lazy|string $image,
        public Lazy|string $content,
        public Lazy|string|null $short_content,
        public Lazy|bool $pinned,
        public Lazy|Carbon $published_at,
        public Lazy|Carbon $created_at,
        public Lazy|Carbon $updated_at,
        public array $seo,
    ) {}

    public static function fromModel(Article $article): self
    {
        return new self(
            Lazy::when(fn () => isset($article->id), fn () => $article->id),
            Lazy::when(fn () => isset($article->slug), fn () => $article->slug),
            Lazy::when(fn () => isset($article->title), fn () => $article->title),
            Lazy::when(fn () => isset($article->image), fn () => $article->image),
            Lazy::when(fn () => isset($article->content), fn () => $article->content),
            Lazy::when(fn () => isset($article->short_content), fn () => $article->short_content),
            Lazy::when(fn () => isset($article->pinned), fn () => $article->pinned),
            Lazy::when(fn () => isset($article->published_at), fn () => $article->published_at),
            Lazy::when(fn () => isset($article->created_at), fn () => $article->created_at),
            Lazy::when(fn () => isset($article->updated_at), fn () => $article->updated_at),
            [
                'title' => $article->seo?->title,
                'description' => $article->seo?->description,
                'keywords' => $article->seo?->keywords,
                'og' => [
                    'url' => $article->seo?->og_url,
                    'title' => $article->seo?->og_title,
                    'description' => $article->seo?->og_description,
                    'image' => $article->seo?->getFirstMediaUrl(),
                ],
            ]
        );
    }
}
