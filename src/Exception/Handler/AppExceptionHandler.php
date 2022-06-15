<?php

namespace Linnzh\HyperfComponent\Exception\Handler;

class AppExceptionHandler extends AbstractExceptionHandler
{
    public function isValid(\Throwable $throwable): bool
    {
        return true;
    }
}
