<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\UseCase\GetComment;
use Core\src\User\Domain\Models\UserId;

class GetMessagesController extends Controller
{
    private $useCase;

    public function __construct(GetComment $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        int $loginUserId,
        int $anotherUserId,
        int $bikeId
    ) {
        $loginUserId = UserId::of($loginUserId);
        $anotherUserId = Userid::of($anotherUserId);
        $bikeId = BikeId::of($bikeId);
        $usersComments = $this->useCase->execute($loginUserId, $anotherUserId, $bikeId);
        return response()->json(
            [
                $loginUserComments = [
                    'bikeId' => $usersComments[0]->bikeId()->toInt(),
                    'senderId' => $usersComments[0]->senderId()->toInt(),
                    'receiverId' => $usersComments[0]->receiverId()->toInt(),
                    'body' => $usersComments[0]->commentBody()->toString()
                ],
                $anotherUserComments = [
                    'bikeId' => $usersComments[1]->bikeId()->toInt(),
                    'senderId' => $usersComments[1]->senderId()->toInt(),
                    'receiverId' => $usersComments[1]->receiverId()->toInt(),
                    'body' => $usersComments[1]->commentBody()->toString()
                ]
            ]
        );

        // $senderId = Auth::id();
        // $bikeId = 9;
        // $receiverId = 2;
        // $query = DB::table('comments')
        //     ->where('bike_id', $bikeId)
        //     ->where('receiver_id', $receiverId)
        //     ->where('sender_id', $senderId)
        //     ->get();
        // return $query;
    }
}
