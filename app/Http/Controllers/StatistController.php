<?php

namespace App\Http\Controllers;

use App\Services\StatistService;
use Illuminate\Http\Request;

class StatistController extends Controller
{
    //
    public function __construct(
        protected StatistService $service
    ) {
    }
    public function stast()
    {
        return response()->json([
            'data' => $this->service->stast(),
        ]);
    }
}