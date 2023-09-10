<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\GetUserNickname\GetUserNickname;

class GetUserNicknameController extends Controller
{
    private $useCase;

    public function __construct(GetUserNickname $getUserNickname)
    {
        $this->useCase = $getUserNickname;
    }

    public function __invoke(int $bikeId, int $loginUserId)
    {
        $userNickname = $this->useCase->execute(UserId::of($loginUserId));
        return response()->json(['userNickname' => $userNickname->toString()]);
    }
}
