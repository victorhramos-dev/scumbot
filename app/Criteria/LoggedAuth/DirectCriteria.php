<?php

namespace App\Criteria\LoggedAuth;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

use Illuminate\Support\Facades\Auth;

class DirectCriteria implements CriteriaInterface
{
    /**
     * Constructor Method
     *
     * @param  string  $guardName   Auth guard name
     * @param  string  $foreginKey  Related record foregin key
     */
    public function __construct($guardName, $foreginKey)
    {
        $this->guardName = $guardName;

        $this->foreginKey = $foreginKey;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                       $model
     * @param  RepositoryInterface  $repository
     *
     * @return  mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $ownerId = Auth::guard($this->guardName)->user()->getKey();

        $model = $model->where($this->foreginKey, $ownerId);

        return $model;
    }
}
