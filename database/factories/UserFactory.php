<?php

namespace Database\Factories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => random_int(1, 50),
            'name' => Faker::create('ja_JP')->name(),
            'tel' => Faker::create('ja_JP')->phoneNumber(),
            'email' => Faker::create('ja_JP')->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
