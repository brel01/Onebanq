<?php
// app/Exceptions/CustomExceptionHandler.php

namespace App\Exceptions\V1;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \App\Exceptions\V1\CustomException) {
            return response()->json([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ], 400);
        }

        return parent::render($request, $exception);
    }
}
?>