<?php

namespace Linnzh\HyperfComponent\Constants;

abstract class AbstractConstants extends \Hyperf\Constants\AbstractConstants
{
    public static function toArray(): array
    {
        $r = new \ReflectionClass(static::class);
        $list = $r->getConstants();

        $class = make(static::class);

        $result = [];

        foreach ($list as $item) {
            $name = $class::getMessage($item);
            $result[] = [
                'id' => $item,
                'name' => static::translate($name),
            ];
        }

        return $result;
    }
}
