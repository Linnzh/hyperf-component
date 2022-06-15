<?php

namespace Linnzh\HyperfComponent\Util\Logger;

final class Config
{
    public static function build(string $groupName = 'error', int $level = \Monolog\Logger::NOTICE): array
    {
        return [
            'handlers' => [
                [
                    'class' => \Monolog\Handler\RotatingFileHandler::class,
                    'constructor' => [
                        'filename' => BASE_PATH . "/runtime/logs/{$groupName}.log",
                        'level' => $level,
                    ],
                    'formatter' => [
                        'class' => JsonFormatter::class,
                        'constructor' => [
                            'batchMode' => \Monolog\Formatter\JsonFormatter::BATCH_MODE_JSON,
                            'appendNewline' => true,
                            'dateFormat' => 'Y-m-d H:i:s',
                        ],
                    ],
                ]
            ],
            'formatter' => [
                'class' => \Monolog\Formatter\LineFormatter::class,
                'constructor' => [
                    'format' => null,
                    'dateFormat' => 'Y-m-d H:i:s',
                    'allowInlineLineBreaks' => true,
                    'includeStacktraces' => true,
                ],
            ]
        ];
    }
}
