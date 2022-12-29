<?php

namespace App\Criteria\LoggedAuth;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

use Illuminate\Support\Facades\Auth;

class MorphedCriteria implements CriteriaInterface
{
    /**
     * Constructor Method
     *
     * @param  string  $guardName    Auth guard name
     * @param  string  $foreginKey   Related record foregin key
     */
    public function __construct($guardName, $foreginType, $foreginKey)
    {
        $this->guardName = $guardName;

        $this->foreginType = $foreginType;

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
        $owner = Auth::guard($this->guardName)->user();

        $ownerType = get_class($owner);

        $ownerId = $owner->getKey();

        $model = $model
                    ->where($this->foreginType, $ownerType)
                    ->where($this->foreginKey, $ownerId);

        return $model;
    }
}
