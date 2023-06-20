<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MessagingService;
use App\Http\Resources\MessagingResource;
use App\Http\Requests\StoreMessagingRequest;
use App\DTO\Messaging\CreateMessagingDTO;

class MessagingController extends Controller
{
    public function __construct(
        protected MessagingService $service
    ) {
    }
    public function sendMessage(StoreMessagingRequest $request)
    {
        //$dto = CreateMessagingDTO::makeFromRequest($request);
        $response = $this->service->sendMessage($request->number,$request->body);
        return $response;

    }
}
