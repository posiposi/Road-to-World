<?php

namespace tests\Unit\Adapter\Comment;

use App\Adapters\Comment\SaveCommentAdapter;
use App\Bike;
use App\Comment as EloquentComment;
use App\User;
use Carbon\Carbon;
use Core\src\Comment\Domain\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SaveCommentAdapterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var SaveCommentAdapter
     */
    private $saveCommentAdapter;
    /** 
     * @var Comment
     */
    private $comment;

    private $commentValue;

    public function setUp(): void
    {
        parent::setUp();
        $this->saveCommentAdapter = new SaveCommentAdapter(new EloquentComment());

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

        $this->commentValue = [
            'sender_id' => 4,
            'receiver_id' => 3,
            'bike_id' => 2,
            'body' => 'テストコメント1',
            'sendDateTime' => Carbon::parse('2023-10-28 12:00:00')
        ];
        $this->comment = Comment::fromArray($this->commentValue);
    }

    public function testSaveComment()
    {
        $this->saveCommentAdapter->saveComment($this->comment);
        $this->assertDatabaseHas('comments', [
            'sender_id' => 4,
            'receiver_id' => 3,
            'bike_id' => 2,
            'body' => 'テストコメント1',
            'created_at' => Carbon::parse('2023-10-28 12:00:00')
        ]);
    }
}
