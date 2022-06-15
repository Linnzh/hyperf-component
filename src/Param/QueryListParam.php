<?php

namespace Linnzh\HyperfComponent\Param;

class QueryListParam
{
    public function __construct(
        /**
         * @var QueryWhereParam[]
         */
        public array $where = [],

        /**
         * @var array|string[]
         */
        public array $with = [],

        /**
         * @var array|string[]
         */
        public array $withCount = [],

        /**
         * @var QueryOrderParam[]
         */
        public array $order = [],

        /**
         * @var null|QueryOptionParam
         */
        public ?QueryOptionParam $option = null,
    ) {
    }

    /**
     * @param array $where
     */
    public function setWhere(array $where): void
    {
        $this->where = $where;
    }

    /**
     * @param array $with
     */
    public function setWith(array $with): void
    {
        $this->with = $with;
    }

    /**
     * @param array $withCount
     */
    public function setWithCount(array $withCount): void
    {
        $this->withCount = $withCount;
    }
}
