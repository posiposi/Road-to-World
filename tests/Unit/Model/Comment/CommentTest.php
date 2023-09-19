<?php

namespace core\tests\Comment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Comment as EloquentComment;
use App\User;
use App\Bike;
use Core\src\Comment\Domain\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // 送信・受信で各1名ずつが必要なのでループ処理
        for ($i = 0; $i < 2; $i++) {
            User::factory()->create([
                'id' => 3 + $i
            ]);
        }
        Bike::factory()->create([
            'id' => 2,
            'user_id' => 3,
        ]);
        EloquentComment::factory()->create([
            'id' => 1,
            'bike_id' => 2,
            'receiver_id' => 3,
            'sender_id' => 4,
            'body' => 'テストコメント',
            'created_at' => now(),
            'updated_at' => null,
        ]);
    }

    public function testFromArray()
    {
        $comment = Comment::fromArray([
            'id' => 1,
            'bike_id' => 2,
            'receiver_id' => 3,
            'sender_id' => 4,
            'body' => 'テストコメント',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $this->assertInstanceOf(Comment::class, $comment);
    }
}
