<?php


namespace Linnzh\HyperfComponent\Exception\Handler;



class RequestExceptionHandler extends AbstractExceptionHandler
{

    /**
     * @inheritDoc
     */
    public function isValid(\Throwable $throwable): bool
    {
        return $throwable instanceof \Hyperf\HttpMessage\Exception\BadRequestHttpException;
    }
}