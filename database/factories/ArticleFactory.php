<?php

namespace AdminKit\Articles\Database\Factories;

use AdminKit\Articles\Models\Article;
use AdminKit\Core\Facades\AdminKit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        $title = $content = $shortContent = [];
        foreach (AdminKit::locales() as $locale) {
            $title[$locale] = fake()->word()."_$locale";
            $content[$locale] = fake()->randomHtml();
            $shortContent[$locale] = fake()->text(20);
        }

        return [
            'title' => $title,
            'slug' => fake()->slug(),
            'content' => $content,
            'short_content' => $shortContent,
            'pinned' => fake()->boolean(10),

            'published_at' => fake()->boolean(90) ? fake()->dateTimeThisYear() : null,
        ];
    }
}
