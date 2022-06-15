<?php

namespace Linnzh\HyperfComponent\Param;

use Hyperf\Utils\Str;

abstract class AbstractParam
{
    public function __construct(array $params)
    {
        foreach ($params as $param => $value) {
            $param = Str::camel($param);
            $value && $this->$param = $value;
        }
    }

    public function toArray(): array
    {
        $result = [];
        $properties = (new \ReflectionClass($this))->getProperties();

        foreach ($properties as $property) {
            $name = $property->getName();
            $key = Str::snake($name);
            $result[$key] = $this->$name;
        }

        return $result;
    }
}
