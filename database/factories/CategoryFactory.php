<?php

namespace XTrees\Database\Factories;

use XTrees\CMS\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->title(),
            'slug' => $this->faker->slug(2),
            'title' => $this->faker->domainName,
            'keywords' => $this->faker->words(5, true),
            'summary' => $this->faker->sentence,
            'total' => $this->faker->randomDigit,
            'display' => $this->faker->boolean
        ];
    }
}
