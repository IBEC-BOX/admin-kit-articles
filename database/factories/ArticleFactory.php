<?php

namespace AdminKit\Articles\Database\Factories;

use AdminKit\Articles\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\ImageFactory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'slug' => $this->faker->slug,
            'content' => $this->faker->randomHtml(),
            'short_content' => $this->faker->randomHtml(),
            'pinned' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
