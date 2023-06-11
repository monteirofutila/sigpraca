<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{

    protected $message = 'This action is unauthorized...';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 401);
    }
}