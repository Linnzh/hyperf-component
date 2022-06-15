<?php

namespace Linnzh\HyperfComponent\Concern\Model;

use Hyperf\Utils\Collection;
use Linnzh\HyperfComponent\Param\QueryListParam;

trait Paginator
{
    public static function paginator(mixed $model, QueryListParam $param): array
    {
        if (!($model instanceof \Hyperf\Database\Model\Model)) {
            throw new \RuntimeException('模型无法构建查询语句或不存在！');
        }
        $query = $model::query()->where($param->where);

        if (!empty($param->with)) {
            $query->with($param->with);
        }

        if (!empty($param->withCount)) {
            $query->withCount($param->withCount);
        }

        if (!empty($param->order)) {
            foreach ($param->order as $order) {
                $query->orderBy($order->column, $order->order);
            }
        }

        if ($param->option && $param->option->page && $param->option->pageSize) {
            $items = ($total = $query->toBase()->getCountForPagination())
                ? $query->forPage($param->option->page, $param->option->pageSize)->get()
                : (new Collection());
        } else {
            $total = $query->count();
            $items = $query->get();
        }

        return [
            'total' => $total ?? 0,
            'items' => $items ?? [],
        ];
    }
}
