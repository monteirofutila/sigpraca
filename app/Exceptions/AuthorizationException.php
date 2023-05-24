<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{

    protected $message = 'This action is unauthorized...';
    public function render()
    {
        return response()->json([
            'message' => $this->message ?? $this->getMessage()
        ], 401);
    }
}