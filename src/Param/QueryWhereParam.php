<?php

namespace Linnzh\HyperfComponent\Param;

class QueryWhereParam
{
    public function __construct(
        public string $column,
        public string $operator = '=',
        public mixed $value = null,
        public string $boolean = 'and'
    ) {
    }
}
