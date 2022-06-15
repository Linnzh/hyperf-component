<?php

namespace Linnzh\HyperfComponent\Util;

class Str
{
    public static function uuid(string $prefix = ''): string
    {
        $chars = md5(uniqid((string) mt_rand(), true));
        $uuid = substr($chars, 0, 8) . '-'
            . substr($chars, 8, 4) . '-'
            . substr($chars, 12, 4) . '-'
            . substr($chars, 16, 4) . '-'
            . substr($chars, 20, 12);

        return $prefix . $uuid;
    }
}
