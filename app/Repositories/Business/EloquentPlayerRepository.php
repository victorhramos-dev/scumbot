<?php

namespace App\Repositories\Business;

use App\Repositories\Contracts\PlayerRepository as PlayerRepositoryInterface;

use Prettus\Repository\Eloquent\BaseRepository;

class EloquentPlayerRepository extends BaseRepository implements PlayerRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Models\\Player";
    }

    /**
     * Find by email
     *
     * @param         $uuid
     * @param  array  $columns
     *
     * @return  mixed
     */
    public function getByEmail($email)
    {
        $results = $this->findByField('email', $email, ['*']);

        if ($results->count()) {
            return $results->first();
        }
    }
}
