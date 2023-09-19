<?php

namespace tests\Unit\Adapter\Comment;

use App\Adapters\Comment\GetCommentAdapter;
use App\Bike;
use App\Comment as EloquentComment;
use App\User;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\CommentList;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class GetCommentAdapterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var GetCommentAdapter
     */
    private $getCommentAdapter;

    public function setUp(): void
    {
        parent::setUp();
        $this->getCommentAdapter = new GetCommentAdapter(new EloquentComment());

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
        for ($i = 0; $i < 3; $i++) {
            EloquentComment::factory()->create([
                'bike_id' => 2,
                'receiver_id' => 3,
                'sender_id' => 4,
                'body' => "テストコメント{$i}",
                'created_at' => now(),
                'updated_at' => null,
            ]);
        }
    }

    public function testGetCommentList()
    {
        $commentList = $this->getCommentAdapter->getCommentList(SenderId::of(4), ReceiverId::of(3), BikeId::of(2));
        $count = 0;
        $this->assertInstanceOf(CommentList::class, $commentList);
        foreach ($commentList->items() as $comment) {
            $this->assertSame("テストコメント{$count}", $comment['body']);
            $count++;
        }
    }
}
