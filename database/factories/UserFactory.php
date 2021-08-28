<?php


namespace XTrees\CMS\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use XTrees\CMS\Models\Image;
use XTrees\CMS\Models\User;

class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'role_id' => mt_rand(0, 2),
            'name' => $this->faker->userName,
            'email' => $this->faker->email(),
            'sex' => $this->faker->boolean,
            'password' => Hash::make('11223344'),
            'source' => Arr::random(['web', 'android', 'ios']),
        ];
    }
}
