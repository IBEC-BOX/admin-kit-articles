<?php

namespace AdminKit\Articles\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AdminKit\Articles\Articles
 */
class Articles extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AdminKit\Articles\Articles::class;
    }
}
