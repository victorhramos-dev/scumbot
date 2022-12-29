<?php

namespace App\Criteria\Player;

use App\Traits\Criteria\SearchableDate;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

use Illuminate\Http\Request;

class ComposedSearchCriteria implements CriteriaInterface
{
    use SearchableDate;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        // Search by name
        $name = $this->request->get('search_name');

        if ($name) {
            $model = $model->whereLike('name', $name);
        }

        // Search by email
        $email = $this->request->get('search_email');

        if ($email) {
            $model = $model->whereLike('email', $email);
        }

        // Search by Created At
        $createdAtMin = $this->request->get('search_created_at_min');
        $createdAtMax = $this->request->get('search_created_at_max');

        if ($this->getSearchableDate($createdAtMin)) {
            $model = $model->whereDate('created_at', '>=', $this->getSearchableDate($createdAtMin));
        }

        if ($this->getSearchableDate($createdAtMax)) {
            $model = $model->whereDate('created_at', '<=', $this->getSearchableDate($createdAtMax));
        }

        // Search by Created At
        $birthdateMin = $this->request->get('search_birthdate_min');
        $birthdateMax = $this->request->get('search_birthdate_max');

        if ($this->getSearchableDate($birthdateMin)) {
            $model = $model->whereDate('birthdate', '>=', $this->getSearchableDate($birthdateMin));
        }

        if ($this->getSearchableDate($birthdateMax)) {
            $model = $model->whereDate('birthdate', '<=', $this->getSearchableDate($birthdateMax));
        }

        // Search by document
        $document = $this->request->get('search_document');

        if ($document) {
            $model = $model->where('document', preg_replace('/\D/', '', $document));
        }

        // Search by phone
        $phone = $this->request->get('search_phone');

        if ($phone) {
            $model = $model->where('phone', preg_replace('/\D/', '', $phone));
        }

        // Search by mobile
        $mobile = $this->request->get('search_mobile');

        if ($mobile) {
            $model = $model->where('mobile', preg_replace('/\D/', '', $mobile));
        }

        return $model;
    }
}