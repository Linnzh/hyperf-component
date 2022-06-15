<?php

namespace Linnzh\HyperfComponent\Exception\Handler;

use Hyperf\HttpMessage\Exception\HttpException;

class HttpExceptionHandler extends AbstractExceptionHandler
{
    public function isValid(\Throwable $throwable): bool
    {
        return $throwable instanceof HttpException;
    }
}
