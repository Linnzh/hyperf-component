<?php

namespace Linnzh\HyperfComponent\Param;

class QueryOptionParam
{
    public function __construct(
        public ?int $page,
        public ?int $pageSize
    ) {
    }
}
