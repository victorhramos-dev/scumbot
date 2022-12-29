<?php

namespace App\Criteria\Shared;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class StatusActivatedCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                       $model
     * @param  RepositoryInterface  $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status', 'active');

        return $model;
    }
}