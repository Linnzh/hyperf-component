<?php

namespace Linnzh\HyperfComponent\Exception\Handler;

use Hyperf\Validation\ValidationException;

class ValidationExceptionHandler extends AbstractExceptionHandler
{
    public function isValid(\Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
