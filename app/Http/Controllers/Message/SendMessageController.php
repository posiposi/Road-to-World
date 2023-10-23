<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\SendRequest;
use Carbon\Carbon;
use Core\src\Comment\UseCase\SendComment;

class SendMessageController extends Controller
{
    /**
     * @var SendComment
     */
    private $useCase;

    /**
     * @var string
     */
    private $message;

    public function __construct(SendComment $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(SendRequest $request, int $loginUserId, int $anotherUserId, int $bikeId)
    {
        $this->message = $request->message();
        $values = [
            'sender_id' => $loginUserId,
            'receiver_id' => $anotherUserId,
            'bike_id' => $bikeId,
            'body' => $this->message,
            'sendDateTime' => Carbon::now(),
        ];

        $this->useCase->execute($values);
    }
}
