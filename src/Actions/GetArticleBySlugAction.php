<?php

declare(strict_types=1);

namespace AdminKit\Articles\Actions;

use AdminKit\Articles\Repositories\ArticleRepository;
use AdminKit\Articles\UI\API\DTO\ArticleDTO;
use Spatie\LaravelData\Data;

class GetArticleBySlugAction
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    public function run(string $slug): Data
    {
        $article = $this->articleRepository->getBySlug($slug);

        return ArticleDTO::from($article);
    }
}
