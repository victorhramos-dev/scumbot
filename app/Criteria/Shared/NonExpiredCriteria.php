<?php

namespace App\Criteria\Shared;

use Illuminate\Support\Carbon;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class NonExpiredCriteria implements CriteriaInterface
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
        $model = $model->whereDate('expired_at', '>', Carbon::now()->format('Y-m-d'));

        return $model;
    }
}