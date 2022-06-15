<?php

declare(strict_types=1);

namespace Linnzh\HyperfComponent;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            // 合并到  config/autoload/dependencies.php 文件
            'dependencies' => [
                \Hyperf\Database\Commands\Ast\ModelUpdateVisitor::class => \Linnzh\HyperfComponent\Visitor\ModelUpdateVisitor::class,
            ],
            'listeners' => [
                \Hyperf\ExceptionHandler\Listener\ErrorExceptionHandler::class,// 捕获内部异常信息
            ],
            'exceptions' => [
                'handler' => [
                    'http' => [
                        \Linnzh\HyperfComponent\Exception\Handler\ValidationExceptionHandler::class,
                        \Linnzh\HyperfComponent\Exception\Handler\HttpExceptionHandler::class,
                        \Linnzh\HyperfComponent\Exception\Handler\AppExceptionHandler::class,
                    ],
                ],
            ],
            'logger' => [],
            // 组件默认配置文件，即执行命令后会把 source 的对应的文件复制为 destination 对应的的文件
            'publish' => [
                //                [
                //                    'id' => 'config',
                //                    'description' => '一些常用的配置项', // 描述
                //                    // 建议默认配置放在 publish 文件夹中，文件命名和组件名称相同
                //                    'source' => __DIR__ . '/../publish/hyperf-component.php',  // 对应的配置文件路径
                //                    'destination' => BASE_PATH . '/config/autoload/hyperf-component.php', // 复制为这个路径下的该文件
                //                ],
            ],
        ];
    }
}
