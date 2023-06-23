<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    //
    protected $message = 'O recurso solicitado não foi encontrado.';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 404);
    }

}