<?php

namespace App\Repositories\Business;

use App\Repositories\Contracts\DroneRepository as DroneRepositoryInterface;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class EloquentDroneRepository extends BaseRepository implements DroneRepositoryInterface
{
    /**
     * Searchable Fields
     *
     * @var  array
     */
    protected $fieldSearchable = [
        'name'     => 'like',
        'steam_id' => 'like',
        'hwid'     => 'like',
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
    public function model()
    {
        return "App\\Models\\Drone";
    }

    /**
     * Find by hwid
     *
     * @param         $uuid
     * @param  array  $columns
     *
     * @return  mixed
     */
    public function getByHwid($hwid)
    {
        $results = $this->findByField('hwid', $hwid, ['*']);

        if ($results->count()) {
            return $results->first();
        }
    }
}
