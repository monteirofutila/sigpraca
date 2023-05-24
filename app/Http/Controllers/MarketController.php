<?php

namespace App\Http\Controllers;

use App\DTO\Markets\MarketDTO;
use App\Http\Requests\UpdateMarketRequest;
use App\Http\Resources\MarketResource;
use App\Services\MarketService;

class MarketController extends Controller
{
    public function __construct(
        protected MarketService $service
    ) {
    }

    public function show()
    {
        $response = $this->service->getFirst();
        return new MarketResource($response);
    }

    public function update(UpdateMarketRequest $request)
    {
        $dto = MarketDTO::makeFromRequest($request);
        $response = $this->service->update($dto);
        return new MarketResource($response);
    }

}