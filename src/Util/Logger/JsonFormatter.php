<?php


namespace Linnzh\HyperfComponent\Util\Logger;


class JsonFormatter extends \Monolog\Formatter\JsonFormatter
{
    public function __construct(int $batchMode = self::BATCH_MODE_JSON, bool $appendNewline = true, bool $ignoreEmptyContextAndExtra = false, bool $includeStacktraces = false, ?string $dateFormat = null)
    {
        parent::__construct($batchMode, $appendNewline, $ignoreEmptyContextAndExtra, $includeStacktraces);
        $this->dateFormat = $dateFormat;
    }
}
