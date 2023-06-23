<?php

namespace App\Exceptions;

use Exception;

class ServerException extends Exception
{
    protected $message = 'Desculpe, ocorreu um erro no servidor. Por favor, tente novamente mais tarde.';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 500);
    }
}