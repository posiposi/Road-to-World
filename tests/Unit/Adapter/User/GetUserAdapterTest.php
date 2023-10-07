<?php

namespace tests\Unit\Adapter\User;

use App\Adapters\User\GetUserAdapter;
use App\User as EloquentUser;
use Core\src\User\Domain\Models\User;
use Core\src\User\Domain\Models\UserId;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class GetUserAdapterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var GetUserAdapter
     */
    private $getUserAdapter;

    public function setUp(): void
    {
        parent::setUp();
        $this->getUserAdapter = new GetUserAdapter(new EloquentUser());
        $this->createUser();
    }

    /** 
     * @dataProvider findByUserDataProvider
     */
    public function testFindByUser($userId, $expected)
    {
        $user = $this->getUserAdapter->findByUserId($userId);
        $this->assertInstanceOf($expected, $user);
    }

    public function findByUserDataProvider()
    {
        return [
            '正常系' => [
                'userId' => UserId::of(1),
                'expected' => User::class,
            ]
            // TODO 異常系テスト追加 Adapterの例外処理を追加後
        ];
    }

    private function createUser()
    {
        EloquentUser::factory()->create([
            'id' => 1,
            'name' => 'テストユーザー1',
            'tel' => '09012345678',
            'email' => 'xxxx@yyyy.zzzz',
            'password' => 'password'
        ]);
    }
}
