<?php

namespace Linnzh\HyperfComponent\Concern\Model;

use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\ModelNotFoundException;
use Hyperf\ModelCache\CacheableInterface;
use Hyperf\ModelCache\EagerLoad\EagerLoader;
use Hyperf\Utils\ApplicationContext;
use Linnzh\HyperfComponent\Param\QueryListParam;

/**
 * @method static findFromCache($id): ?Model
 * @method static find($id, $columns = [])
 * @method static with($relations)
 * @method        fill(array $attributes)
 */
trait Crud
{
    use Paginator;

    /**
     * 根据 ID 获取模型实例
     *
     * @param int   $id
     * @param array $with
     *
     * @return mixed
     *
     * @throws
     */
    public static function get(int $id, array $with = [])
    {
        $result = (new Collection());
        $calledClass = make(static::class);

        if (!($calledClass instanceof CacheableInterface)) {
            !empty($with) && static::with($with);
            $model = static::find($id);
            $model && $result->push($model);
        } else {
            $model = static::findFromCache($id);
            $model && $result->push($model);

            if (!empty($with)) {
                $loader = ApplicationContext::getContainer()->get(EagerLoader::class);
                $loader->load($result, $with);
            }
        }

        return $result->first() ?? throw new ModelNotFoundException(static::getNotFoundErrorMessage());
    }

    /**
     * 更新当前模型信息
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function edit(array $attributes): bool
    {
        return $this->fill($attributes)->save();
    }

    /**
     * 获取模型未找到等错误提示
     *
     * @return string
     */
    public static function getNotFoundErrorMessage(): string
    {
        return static::class . ' is not found!';
    }

    /**
     * @param \Linnzh\HyperfComponent\Param\QueryListParam $param
     *
     * @return array
     *
     * @example
     * new QueryListParam(
     *         where: ['name' => 'test'],
     *         with: ['risk'],
     *         withCount: ['models'],
     *         order: [
     *             new QueryOrderParam(column: 'sort', order: 'asc'),
     *             new QueryOrderParam(column: 'id', order: 'asc'),
     *         ],
     *         option: (new QueryOptionParam(page: 1,pageSize: 10))
     * )
     */
    public static function list(QueryListParam $param)
    {
        return static::paginator(make(get_called_class()), $param);
    }
}
