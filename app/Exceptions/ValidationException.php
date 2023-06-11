<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $message = 'Validation failed....';
    public function render()
    {
        return response()->json([
            'message' => $this->getMessage() ?? $this->message
        ], 403);
    }
}