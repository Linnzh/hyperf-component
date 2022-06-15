<?php

namespace Linnzh\HyperfComponent\Param;

class QueryOrderParam
{
    public function __construct(
        public string $column = 'id',
        public string $order = 'ASC'
    ) {
    }
}
