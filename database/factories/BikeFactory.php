<?php

namespace Database\Factories;

use App\Bike;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class BikeFactory extends Factory
{
    protected $model = Bike::class;

    public function definition(): array
    {
        return [
            'id' => random_int(1, 100),
            'user_id' => random_int(1, 50),
            'name' => Faker::create()->name(),
            'brand' => Faker::create()->sentence(8),
            'status' => Faker::create()->word(),
            'bike_address' => Faker::create()->address(),
            'created_at' => now(),
            'price' => 100,
        ];
    }
}
