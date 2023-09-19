<?php

namespace core\tests\Comment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Core\src\Comment\Domain\Models\CommentList;

class CommentListTest extends TestCase
{
    use RefreshDatabase;

    private $commentListValues;

    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 10; $i++) {
            $this->commentListValues[] =
                [
                    'id' => $i,
                    'bike_id' => 2 + $i,
                    'receiver_id' => 3 + $i,
                    'sender_id' => 4 + $i,
                    'body' => "テストコメント{$i}",
                    'created_at' => now(),
                    'updated_at' => null,
                ];
        }
    }

    public function testItems()
    {
        $commentListItems = CommentList::fromArray($this->commentListValues)->items();
        $targetNumber = random_int(0, 9);

        $this->assertCount(10, $commentListItems);
        $this->assertSame($targetNumber, $commentListItems[$targetNumber]['id']);
        $this->assertContains("テストコメント{$targetNumber}", $commentListItems[$targetNumber]);
    }

    public function testFromArray()
    {
        $this->assertInstanceOf(CommentList::class, CommentList::fromArray($this->commentListValues));
    }
}
