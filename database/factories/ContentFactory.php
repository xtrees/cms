<?php


namespace XTrees\CMS\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use XTrees\CMS\Models\Content;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        return [
            'category_id' => mt_rand(1, 3),
            'type' => \Arr::random(Content::TYPE_KEYS),
            'slug' => $this->faker->slug(5),
            'title' => $this->faker->sentence,
            'keywords' => $this->faker->words(5, true),
            'summary' => $this->faker->sentences(2, true),
            'body' => $this->faker->paragraphs(4, true),
            'views' => mt_rand(0, 100000),
            'favorites' => mt_rand(0, 100000),
            'permission' => mt_rand(0, 10),
            'coins' => mt_rand(0, 10),
            'published_at' => $this->faker->dateTime(),
            'display' => $this->faker->boolean,
        ];
    }
}
