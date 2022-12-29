<?php

namespace App\Repositories\System;

use App\Repositories\Contracts\AdministratorRepository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class EloquentAdministratorRepository extends BaseRepository implements AdministratorRepository
{
    /**
     * Searchable Fields
     *
     * @var  array
     */
    protected $fieldSearchable = [
        'name' => 'like'
    ];

    /**
     * Set operations at repository boot
     *
     * @return  void
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\System\\Management\\Administrator";
    }
}
