<?php

namespace Linnzh\HyperfComponent\Exception;

use Hyperf\Server\Exception\ServerException;

abstract class AbstractException extends ServerException
{
    /**
     *
     * @param int             $code     错误码
     * @param string|null     $message  错误提示
     * @param \Throwable|null $previous
     */
    public function __construct(int $code = 0, ?string $message = null, ?\Throwable $previous = null)
    {
        if (null === $message) {
            $message = trans($this->getCodeMessage($code));
        }

        parent::__construct($message, $code, $previous);
    }

    protected function getCodeMessage(int $code): string
    {
        return 'error';
    }
}
