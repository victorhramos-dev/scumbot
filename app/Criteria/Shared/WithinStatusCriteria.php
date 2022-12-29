<?php

namespace App\Criteria\Shared;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WithinStatusCriteria implements CriteriaInterface
{
    /**
     * Constructor
     *
     * @param  mixed  $statuses
     */
    public function __construct($statuses)
    {
        $this->statuses = (array) $statuses;
    }

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
        $model = $model->whereIn('status', $this->statuses);

        return $model;
    }
}