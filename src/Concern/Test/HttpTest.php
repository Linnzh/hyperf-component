<?php

namespace Linnzh\HyperfComponent\Concern\Test;


use Hyperf\HttpMessage\Exception\MethodNotAllowedHttpException;

/**
 * Trait HttpTestCase
 *
 * 检查路由可用/存在性：option
 *
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 * @method request($method, $path, $options = [])
 */
trait HttpTest
{
    public function assertExists(string $uri, bool $exists = true)
    {
        $response = $this->client->request('OPTIONS', $uri);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function assertAllowMethod(string $uri, string $method = 'GET')
    {
        $response = $this->client->request($method, $uri);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function assertForbiddenAllowMethod(string $uri, string $method = 'GET')
    {
        try {
            $response = $this->client->request($method, $uri);
        } catch (\Throwable $e) {
            var_dump($e::class);
        }
        $this->expectException(\Hyperf\HttpMessage\Exception\MethodNotAllowedHttpException::class);
        if ($method === 'POST') {
            $this->expectException(\Hyperf\Validation\ValidationException::class);
        }
    }
}