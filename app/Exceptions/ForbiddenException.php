<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Access denied. You do not have permission to access this resource...';
    public function render()
    {
        return response()->json([
            'message' => $this->message
        ], 403);
    }
}