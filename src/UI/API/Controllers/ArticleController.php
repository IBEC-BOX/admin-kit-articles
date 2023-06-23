<?php

declare(strict_types=1);

namespace AdminKit\Articles\UI\API\Controllers;

use AdminKit\Articles\Actions\GetArticleBySlugAction;
use AdminKit\Articles\Actions\GetArticleListAction;

class ArticleController extends Controller
{
    public function index()
    {
        return app(GetArticleListAction::class)->run();
    }

    public function showBySlug(string $slug)
    {
        return app(GetArticleBySlugAction::class)->run($slug);
    }
}
