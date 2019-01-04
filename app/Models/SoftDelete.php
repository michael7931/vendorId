<?php

namespace App\Models;


trait SoftDelete{
    use SoftDeletingTrait;
    /**
     * 创建软删除对象
     *
     * @return void
     */
    public static function bootSoftDeletingTrait()
    {
        static::addGlobalScope(new SoftDeleteScope);
    }
    /**
     * 只获取软删除的记录
     *
     * @return IlluminateDatabaseEloquentBuilder|static
     */
    public static function onlyTrashed()
    {
        $instance = new static;

        $column = $instance->getQualifiedDeletedAtColumn();

        return $instance->newQueryWithoutScope(new SoftDeleteScope)->where($column,'>',new IlluminateDatabaseQueryExpression('0'));
    }
    /**
     * 获取软删除与正常一起的记录
     *
     * @return IlluminateDatabaseEloquentBuilder|static
     */
    public static function withTrashed()
    {
        return with(new static)->newQueryWithoutScope(new SoftDeleteScope);
    }
}

