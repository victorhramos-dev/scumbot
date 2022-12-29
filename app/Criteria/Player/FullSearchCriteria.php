<?php

namespace App\Criteria\Player;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

use Illuminate\Http\Request;

class FullSearchCriteria implements CriteriaInterface
{
    /**
     * Constructor
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        $searchParam = $this->request->get(config('repository.criteria.params.search', 'search'), null);
        $searchParam = trim($searchParam);

        if ($searchParam) {

            // Search by text
            $model = $model->where(function($query) use($searchParam) {
                $query->whereLike('name', $searchParam);

                $query->orWhere('email', $searchParam);

                if ($this->onlyDigit($searchParam)) {
                    $query->orWhereDigit('phone', $searchParam);
                }

                if ($this->onlyDigit($searchParam)) {
                    $query->orWhereDigit('mobile', $searchParam);
                }

                if ($this->onlyDigit($searchParam)) {
                    $query->orWhereDigit('document', $searchParam);
                }
            });

            return $model;
        }

        return $model;
    }

    /**
     * Get only digit search param
     *
     * @param   string  $searchParam
     *
     * @return  string
     */
    private function onlyDigit($searchParam)
    {
        return preg_replace('/\D/', '', $searchParam);
    }
}