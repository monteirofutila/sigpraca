<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $message = 'Desculpe, alguns dados não atendem aos critérios de validação.';
    public function render()
    {
        return response()->json([
            'message' => $this->getMessage() ?? $this->message
        ], 403);
    }
}