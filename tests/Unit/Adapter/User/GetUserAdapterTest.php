<?php

namespace tests\Unit\Adapter\User;

use App\Adapters\User\GetUserAdapter;
use App\User as EloquentUser;
use Core\src\User\Domain\Exceptions\NotFoundException;
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
     * @dataProvider findByUserIdDataProvider
     */
    public function testFindByUserId($userId, $expectedInstance, $exceptionInstance, $exceptionMessage)
    {
        // expectExpectionMessage()では完全一致確認ができないため、try catchでテスト実装
        try {
            $result = $this->getUserAdapter->findByUserId($userId);
            $this->assertInstanceOf($expectedInstance, $result);
        } catch (NotFoundException $error) {
            $this->assertInstanceOf($exceptionInstance, $error);
            $this->assertSame($exceptionMessage, $error->getMessage());
        }
    }

    public function findByUserIdDataProvider()
    {
        return [
            '正常系' => [
                'userId' => UserId::of(1),
                'expectedInstance' => User::class,
                'exceptionInstance' => null,
                'exceptionMessage' => null,
            ],
            '異常系' => [
                'userId' => Userid::of(99),
                'expectedInstance' => NotFoundException::class,
                'exceptionInstance' => NotFoundException::class,
                'exceptionMessage' => 'ユーザーが見つかりません。',
            ]
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
