<?php

declare(strict_types=1);

namespace AdminKit\Articles\Actions;

use AdminKit\Articles\Repositories\ArticleRepository;
use AdminKit\Articles\UI\API\DTO\ArticleDTO;
use Spatie\LaravelData\PaginatedDataCollection;

class GetArticleListAction
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    public function run(): PaginatedDataCollection
    {
        $articles = $this->articleRepository->getPaginatedList();

        return ArticleDTO::collection($articles)->except('content');
    }
}
