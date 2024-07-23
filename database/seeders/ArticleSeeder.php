<?php

namespace AdminKit\Articles\Database\Seeders;

use AdminKit\Articles\Models\Article;
use AdminKit\SEO\Models\SEO;
use Illuminate\Database\Seeder;
use Illuminate\Http\Testing\File;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory(10)
            ->has(SEO::factory())
            ->create()
            ->each(function (Article $model) {
                $model->addMedia(File::image($model->id.'_'.str()->random(10).'.jpg'))->toMediaCollection();
                $model->seo->addMedia(File::image($model->id.'_'.str()->random(10).'.jpg'))->toMediaCollection();
            });
    }
}
