<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Acesso negado. Você não tem permissão para acessar este recurso.';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 403);
    }
}