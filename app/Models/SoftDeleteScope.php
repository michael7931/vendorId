<?php

namespace App\Models;


class SoftDeleteScope extends IlluminateDatabaseEloquentSoftDeletingScope{
    /**
     * 只获取正常数据
     *
     * @param  IlluminateDatabaseEloquentBuilder  $builder
     * @return void
     */
    public function apply(IlluminateDatabaseEloquentBuilder $builder)
    {
        $model = $builder->getModel();

        $builder->where($model->getQualifiedDeletedAtColumn(),'=',new IlluminateDatabaseQueryExpression('0'));

        $this->extend($builder);
    }
    /**
     * 只获取软删除数据
     *
     * @param  IlluminateDatabaseEloquentBuilder  $builder
     * @return void
     */
    protected function addOnlyTrashed(IlluminateDatabaseEloquentBuilder $builder)
    {
        $builder->macro('onlyTrashed', function(IlluminateDatabaseEloquentBuilder $builder)
        {
            $this->remove($builder);

            $builder->getQuery()->where($builder->getModel()->getQualifiedDeletedAtColumn(),'>',new IlluminateDatabaseQueryExpression('0'));

            return $builder;
        });
    }
    /**
     * 去掉软删除条件
     *
     * @param  array   $where
     * @param  string  $column
     * @return bool
     */
    protected function isSoftDeleteConstraint(array $where, $column)
    {
        return $where['type'] == 'Basic' && $where['operator']=='=' && $where['value']=='0' && $where['column'] == $column;
    }
}