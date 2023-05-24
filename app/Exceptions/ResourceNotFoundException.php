<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    //
    protected $message = 'Resource not found...';
    public function render()
    {
        return response()->json([
            'message' => $this->message ?? $this->getMessage()
        ], 404);
    }

}