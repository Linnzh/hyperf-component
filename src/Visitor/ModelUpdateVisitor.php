<?php

namespace Linnzh\HyperfComponent\Visitor;

use Carbon\Carbon;
use Hyperf\Utils\Str;

class ModelUpdateVisitor extends \Hyperf\Database\Commands\Ast\ModelUpdateVisitor
{
    protected function rewriteCasts(\PhpParser\Node\Stmt\PropertyProperty $node): \PhpParser\Node\Stmt\PropertyProperty
    {
        $items = [];
        $keys = [];

        if ($node->default instanceof \PhpParser\Node\Expr\Array_) {
            $items = $node->default->items;
        }

        if ($this->option->isForceCasts()) {
            $items = [];
            $casts = $this->class->getCasts();

            foreach ($node->default->items as $item) {
                $caster = $casts[$item->key->value] ?? null;

                if ($caster && $this->isCaster($caster)) {
                    $items[] = $item;
                }
            }
        }

        foreach ($items as $item) {
            $keys[] = $item->key->value;
        }

        foreach ($this->columns as $column) {
            $name = $column['column_name'];
            $type = $column['cast'] ?? null;

            if (in_array($name, $keys, true)) {
                continue;
            }

            if ($column['column_type'] === 'tinyint(1)') {
                $column['data_type'] = 'boolean';
            }

            if ($type || $type = $this->formatDatabaseType($column['data_type'])) {
                $items[] = new \PhpParser\Node\Expr\ArrayItem(
                    new \PhpParser\Node\Scalar\String_($type),
                    new \PhpParser\Node\Scalar\String_($name)
                );
            }
        }

        $node->default = new \PhpParser\Node\Expr\Array_($items, [
            'kind' => \PhpParser\Node\Expr\Array_::KIND_SHORT,
        ]);

        return $node;
    }

    protected function formatDatabaseType(string $type): ?string
    {
        return match ($type) {
            'tinyint', 'smallint', 'mediumint', 'int', 'bigint' => 'integer',
            'decimal', 'float', 'double', 'real' => 'float',
            'bool', 'boolean' => 'boolean',
            default => null,
        };
    }

    protected function getProperty($column): array
    {
        $name = $this->option->isCamelCase() ? Str::camel($column['column_name']) : $column['column_name'];

        if ($column['column_type'] === 'tinyint(1)') {
            $column['data_type'] = 'boolean';
        }
        $type = $this->formatPropertyType($column['data_type'], $column['cast'] ?? null);

        $comment = $this->option->isWithComments() ? $column['column_comment'] ?? '' : '';

        return [$name, $type, $comment];
    }

    protected function formatPropertyType(string $type, ?string $cast): ?string
    {
        if (!isset($cast)) {
            $cast = $this->formatDatabaseType($type) ?? 'string';
        }

        switch ($cast) {
            case 'integer':
                return 'int';
            case 'boolean':
                return 'boolean';
            case 'date':
            case 'datetime':
                return '\\' . Carbon::class;
            case 'json':
                return 'array';
        }

        if (Str::startsWith($cast, 'decimal')) {
            // 如果 cast 为 decimal，则 @property 改为 float
            return 'float';
        }

        return $cast;
    }
}
