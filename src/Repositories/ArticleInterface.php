<?php

declare(strict_types=1);

namespace AdminKit\Articles\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleInterface
{
    public function getPaginatedList(): LengthAwarePaginator;

    public function getBySlug(string $slug): Model;
}
