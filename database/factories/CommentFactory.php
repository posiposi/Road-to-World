<?php

namespace Database\Factories;

use App\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'bike_id' => random_int(1, 1),
            'receiver_id' => random_int(2, 2),
            'sender_id' => random_int(3, 3),
            'body' => Faker::create('ja_JP')->realText(),
            'created_at' => now(),
        ];
    }
}
