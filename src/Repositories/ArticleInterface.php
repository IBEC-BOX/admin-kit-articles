<?php

declare(strict_types=1);

namespace AdminKit\Articles\Repositories;

use AdminKit\Core\Abstracts\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleInterface extends RepositoryInterface
{
    public function getPaginatedList(): LengthAwarePaginator;

    public function getBySlug(string $slug): Model;
}
