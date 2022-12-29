<?php

namespace App\Criteria\LoggedAuth;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

use Illuminate\Support\Facades\Auth;

class RelatedCriteria implements CriteriaInterface
{
    /**
     * Constructor Method
     *
     * @param  string  $guardName     Auth guard name
     * @param  string  $relatedTable  Related table
     * @param  string  $relatedKey    Related table foregin key
     * @param  string  $foreginKey    Customer foregin key
     */
    public function __construct($guardName, $relatedTable, $relatedKey, $foreginKey = 'player_id')
    {
        $this->guardName = $guardName;

        $this->relatedTable = $relatedTable;

        $this->relatedKey = $relatedKey;

        $this->foreginKey = $foreginKey;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $relatedTable = $this->relatedTable;

        $relatedKey = $this->relatedKey;

        $foreginKey = $this->foreginKey;

        $ownerId = Auth::guard($this->guardName)->user()->id;

        $model = $model->whereIn($relatedKey, function($query) use($relatedTable, $foreginKey, $ownerId) {
            $query
                ->select('id')
                ->from($relatedTable)
                ->where($foreginKey, $ownerId);
        });

        return $model;
    }
}
