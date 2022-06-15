<?php

namespace Linnzh\HyperfComponent\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Linnzh\HyperfComponent\Param\QueryListParam;
use Linnzh\HyperfComponent\Param\QueryOptionParam;
use Linnzh\HyperfComponent\Param\QueryOrderParam;
use Linnzh\HyperfComponent\Util\Response\JsonResponse;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @Inject
     *
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @Inject
     *
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @Inject
     *
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * 获取验证过的 Body 参数
     *
     * @param \Hyperf\Validation\Request\FormRequest|null $request
     *
     * @return array
     */
    public function getData(?\Hyperf\Validation\Request\FormRequest $request = null): array
    {
        if ($request) {
            $data = $request->validated();
        } else {
            $data = $this->request->post();
        }

        return $data;
    }

    /**
     * 获取查询列表时的字段映射关系
     *
     * @return array
     */
    public function getWhereMapping(): array
    {
        return ['id' => ['=']];
    }

    /**
     * 获取默认排序
     *
     * @return string[]
     */
    public function getSortFields(): array
    {
        return ['id' => 'DESC'];
    }

    /**
     * 获取查询列表时的附加表信息
     *
     * @return array
     */
    public function getWith(): array
    {
        return [];
    }

    /**
     * 获取查询列表时的附加表计数列表
     *
     * @return array
     */
    public function getWithCount(): array
    {
        return [];
    }

    /**
     * 构建列表查询条件
     *
     * @return QueryListParam
     */
    public function buildListQuery(): QueryListParam
    {
        $params = array_filter($this->request->query());
        $option = null;

        if (isset($params['page'], $params['limit'])) {
            $option = new QueryOptionParam(page: (int) $params['page'], pageSize: (int) $params['limit']);
            unset($params['page'], $params['limit']);
        }
        $orders = [];

        if (isset($params['sort'])) {
            $sorts = explode(',', $params['sort']);

            foreach ($sorts as $order) {
                $order = explode('_', $order);
                $order = array_pop($order);
                $column = implode('_', $order);
                $orders[] = new QueryOrderParam(column: $column, order: $order);
            }
            unset($params['sort']);
        }

        foreach ($this->getSortFields() as $column => $order) {
            $orders[] = new QueryOrderParam(column: $column, order: $order);
        }

        $where = [];

        foreach ($this->getWhereMapping() as $column => $item) {
            if (isset($params[$column])) {
                $condition = [$column, $item[0], $params[$column]];
            } elseif (isset($item[1])) {
                $condition = [$column, $item[0], $item[1]];
            } else {
                continue;
            }
            unset($params[$column]);

            if ('LIKE' == $item[0]) {
                $condition[2] = "%{$condition[2]}%";
            }
            $where[] = $condition;
        }

        foreach ($params as $column => $param) {
            $where[] = [$column, '=', $item];
            unset($params[$column]);
        }

        return new QueryListParam(
            where: $where,
            with: $this->getWith(),
            withCount: $this->getWithCount(),
            order: $orders,
            option: $option
        );
    }

    public function returnArray(mixed $data): array
    {
        return (new JsonResponse($data))->toArray();
    }

    public function returnJson(mixed $data): string
    {
        return (new JsonResponse($data))->toJson();
    }
}
