<?php

namespace App\Exceptions;

use Exception;

class ServerException extends Exception
{
    protected $message = 'Server error...';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 500);
    }
}