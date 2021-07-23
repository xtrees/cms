<?php


namespace XTrees\CMS\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use XTrees\CMS\Models\Image;

class ImageFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'storage' => 'test',
            'path' => $this->faker->imageUrl(),
            'display' => true
        ];
    }
}
