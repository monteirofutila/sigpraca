<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{

    protected $message = 'Ação não autorizada. Você não tem permissão para realizar essa operação.';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 401);
    }
}